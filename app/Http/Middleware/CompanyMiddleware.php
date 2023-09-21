<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Services\ApiService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
            $data = [
                'company' => $company,
                'config' => $company->configs->first(),
                'events' => $company->events()->orderBy('date', 'asc')->get(),
            ];
            $request->attributes->set('data', $data);

            return true;
        }

        return false;
    }
}