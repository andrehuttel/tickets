<?php

namespace App\Services;

use App\Models\Banner;
use App\Models\Company;
use App\Models\CompanyConfig;
use App\Models\Event;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class UserService
{
    public function postData($data, $param)
    {
        $apiService = new ApiService();
        $apiData = $apiService->postData(env('API_URL').$param, env('API_USERNAME'), env('API_PASSWORD'), $data);

        dd($apiData);
    }
}
