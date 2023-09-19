<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiService
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    public function getCompanyData($apiUrl)
    {
        try {
            $response = $this->httpClient->get($apiUrl);
            
            $apiData = json_decode($response->getBody(), true);

            // Verifique se os dados são válidos antes de retorná-los
            if ($apiData /*&& isset($apiData['company']) && isset($apiData['config']) && isset($apiData['events'])*/) {
                // Insere dados no banco de dados do company, config e events
                return $apiData;
            }
        } catch (GuzzleException $e) {
            // Trate qualquer erro na chamada à API de acordo com as suas necessidades
            return 'Erro ao chamar a API: ' . $e->getMessage();
        }

        return null;
    }
}
