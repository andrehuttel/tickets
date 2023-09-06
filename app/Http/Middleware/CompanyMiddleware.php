<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Http\Request;
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
            $companyData = [
                'company' => $company,
                'config' => $company->configs->first(),
            ];

            $request->attributes->set('company', $companyData);

            return true;
        }

        return false;
    }
}