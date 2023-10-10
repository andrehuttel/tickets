<?php

namespace App\Http\Controllers;

use App\Services\CompanyService;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    private $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }
    
    public function getPlace(Request $request)
    {
        $host = $request->getHost();
        return $this->companyService->getCompany($host);
    }

    public function getConfigById($id)
    {
        return $this->companyService->getConfig($id);
    }
}
