<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class ApiService
{
    public function getData($apiUrl, $username, $password, $param = null)
    {
        try {
            if($param){
                $apiUrl = $apiUrl . '/' . $param;
            }
            $ch = curl_init($apiUrl);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

            $response = curl_exec($ch);

            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if ($httpCode === 200) {
                $apiData = json_decode($response, true);

                if ($apiData) {
                    return $apiData;
                }
            } else {
                Log::error('Erro na chamada da API: Código de status ' . $httpCode);
                return 'Erro na chamada da API: Código de status ' . $httpCode;
            }

            curl_close($ch);
        } catch (\Exception $e) {
            Log::error('Erro ao chamar a API: ' . $e->getMessage());
            return 'Erro ao chamar a API: ' . $e->getMessage();
        }

        return null;
    }
}
