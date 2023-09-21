<?php

namespace App\Http\Controllers;

use App\Services\CompanyService;

class ApiController extends Controller
{
    private $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }
    
    public function getPlace()
    {
        return $this->companyService->getCompany();
    }

    public function getConfigById($id)
    {
        return $this->companyService->getConfig($id);
    }
}
