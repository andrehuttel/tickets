<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Models\CompanyConfig;
use App\Models\Event;
use Closure;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class CompanyMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        
        if ($this->isValidCompany($host, $request)) {
            return $next($request);
        }

        return abort(403, 'Acesso não autorizado.');
    }

    protected function isValidCompany($host, $request)
    {
        $cachePattern = 'company_' . $host;
        $keys = Cache::store('memcached')->getStore()->getMemcached()->getAllKeys();
        $matchingKeys = false;
        if ($keys) {
            $matchingKeys = preg_grep('/' . $cachePattern . '/', $keys);
        }
        if ($matchingKeys) {
            $company = Cache::get('company_'.$host);
            $fl_use_cache = $company['company']['fl_use_cache'];
            $host = $company['company']['host'];
        } else {
            $companyDb = Company::where('host', $host)->orWhere('host_generated', $host)->first();
            if($companyDb) {
                $fl_use_cache = $companyDb->fl_use_cache;
                $host = $companyDb->host;
            } else {
                $fl_use_cache = false;
                $host = $host;
            }
        }

        if ($fl_use_cache == '1') {
            if(!isset($company)){
                $company = $companyDb;
            }
            $cachedData = Cache::remember('company_' . $host, 3600, function () use ($company) {
                $faviconUrl = $company->configs->where('key', 'STORE_TPL_LOGO')->first();
                $categories = Event::where('company_id', $company->id)
                    ->select('category_id', 'category_name', 'category_uri')
                    ->orderBy('category_name', 'asc')
                    ->distinct()
                    ->get();

                $data = [
                    'company' => $company,
                    'config' => $company->configs->all(),
                    'banners' => $company->banners->all(),
                    'all_events' => $company->events()->whereDate('date', '>=', now())->orderBy('date', 'asc')->get(),
                    'events' => $company->events()->where('fl_featured', false)->whereDate('date', '>=', now())->orderBy('date', 'asc')->get(),
                    'events_featured' => $company->events()->where('fl_featured', true)->whereDate('date', '>=', now())->orderBy('date', 'asc')->get(),
                    'faviconUrl' => $faviconUrl,
                    'categories' => $categories,
                ];

                return $data;
            });

            $request->attributes->set('data', $cachedData);
            if(!is_null($cachedData['faviconUrl'])){
                Inertia::share('faviconUrl', $cachedData['faviconUrl']['value']);
            }

            return true;
        } else {
            if(!isset($company)){
                $company = $companyDb;
            }
            $faviconUrl = $company->configs->where('key', 'STORE_TPL_LOGO')->first();
            $categories = Event::where('company_id', $company->id)
                ->select('category_id', 'category_name', 'category_uri')
                ->orderBy('category_name', 'asc')
                ->distinct()
                ->get();

            $data = [
                'company' => $company,
                'config' => $company->configs->all(),
                'banners' => $company->banners->all(),
                'all_events' => $company->events()->whereDate('date', '>=', now())->orderBy('date', 'asc')->get(),
                'events' => $company->events()->where('fl_featured', false)->whereDate('date', '>=', now())->orderBy('date', 'asc')->get(),
                'events_featured' => $company->events()->where('fl_featured', true)->whereDate('date', '>=', now())->orderBy('date', 'asc')->get(),
                'faviconUrl' => $faviconUrl,
                'categories' => $categories,
            ];

            $request->attributes->set('data', $data);
            Inertia::share('faviconUrl', $data['faviconUrl']['value']);

            return true;
        }

        return false;
    }
}