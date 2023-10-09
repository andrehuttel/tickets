<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Models\CompanyConfig;
use App\Models\Event;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class CompanyMiddleware
{
    public function handle($request, Closure $next): Response
    {
        $host = $request->getHost();

        if ($this->isValidCompany($host, $request)) {
            return $next($request);
        }

        return abort(403, 'Acesso não autorizado.');
    }

    protected function isValidCompany($host, $request)
    {
        $company = Company::where('host', $host)->orWhere('host_generated', $host)->first();
       
        if ($company) {
            if($company->fl_use_cache == '1'){
                $cachedData = Cache::rememberForever('company_' . $company->id, function () use ($company) {
                    $faviconUrl = $company->configs->where('key', 'STORE_TPL_LOGO')->first();
                    $categories = Event::where('company_id', $company->id)
                        ->select('category_name', 'category_uri')
                        ->orderBy('category_name', 'asc')
                        ->distinct()
                        ->get();

                    $data = [
                        'company' => $company,
                        'config' => $company->configs->all(),
                        'banners' => $company->banners->all(),
                        'events' => $company->events()->where('fl_featured', false)->whereDate('date', '>=', now())->orderBy('date', 'asc')->get(),
                        'events_featured' => $company->events()->where('fl_featured', true)->whereDate('date', '>=', now())->orderBy('date', 'asc')->get(),
                        'faviconUrl' => $faviconUrl,
                        'categories' => $categories,
                    ];

                    return $data;
                });

                $request->attributes->set('data', $cachedData);
                Inertia::share('faviconUrl', $cachedData['faviconUrl']['value']);
            } else {
                $faviconUrl = $company->configs->where('key', 'STORE_TPL_LOGO')->first();
                $categories = Event::where('company_id', $company->id)
                    ->select('category_name', 'category_uri')
                    ->orderBy('category_name', 'asc')
                    ->distinct()
                    ->get();

                $data = [
                    'company' => $company,
                    'config' => $company->configs->all(),
                    'banners' => $company->banners->all(),
                    'events' => $company->events()->where('fl_featured', false)->whereDate('date', '>=', now())->orderBy('date', 'asc')->get(),
                    'events_featured' => $company->events()->where('fl_featured', true)->whereDate('date', '>=', now())->orderBy('date', 'asc')->get(),
                    'faviconUrl' => $faviconUrl,
                    'categories' => $categories,
                ];

                return $data;

                $request->attributes->set('data', $data);
                Inertia::share('faviconUrl', $data['faviconUrl']['value']);
            }

            return true;
        }

        return false;
    }
}