<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Models\CompanyConfig;
use App\Models\Event;
use App\Services\ApiService;
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
            $categories = Event::where('company_id', $company->id)
            ->select('category_name')
            ->distinct()
            ->pluck('category_name');
            $data = [
                'company' => $company,
                'config' => $company->configs->all(),
                'banners' => $company->banners->all(),
                'events' => $company->events()->where('fl_featured', false)->orderBy('date', 'asc')->get(),
                'events_featured' => $company->events()->where('fl_featured', true)->orderBy('date', 'asc')->get(),
                'categories' => $categories,
            ];
            $request->attributes->set('data', $data);

            return true;
        }

        return false;
    }
}