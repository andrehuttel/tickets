<?php

namespace App\Services;

use App\Models\Banner;
use App\Models\Company;
use App\Models\CompanyConfig;
use App\Models\Event;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class UserService
{
    public function postCustomer($data, $param)
    {
        $apiService = new UserService();
        $apiData = $apiService->postData(env('API_URL').$param, env('API_USERNAME'), env('API_PASSWORD'), $data);
        $apiData = $userService->postData($data, '/customer');

        dd($apiData);

        // $data = $request->validate([
        //     'email_address' => 'required|email',
        //     'name' => 'required|max:50',
        //     'phone_number' => 'min:14|max:15',
        //     'country' => 'required|max:500',
        //     'cpf' => 'required|max:500',
        //     'foreigner_document' => 'max:500',
        //     'password' => 'required|max:500',
        // ]);
        
        // array de exemplo dos dados do formulario
        $data = [
            'place_id' => 'euaqpe8smdzl26k275zx',
            'email_address' => 'pedro@gmail.com',
            'name' => 'Pedro',
            'surname' => 'da Silva',
            'phone_number' => '5547996221155',
            'country' => 'Brasil',
            'cpf' => '252525252',
            'foreigner_document' => '',
            'password' => 'abacaxi',
        ];

        if ($data) {
            //$data['place_id'] = $request->get('data')['company']['id'];
            //dd($data);
            $apiData = $this->userService->postData($data, '/customer');

            dd($apiData);
            if ($apiData) {
                //Registra o usuario, salva em sessão.
                return response()->json(['message' => 'Usuário criado com sucesso!'], 200);
            } elseif ($apiData === '409') {
                return response()->json(['error' => 'Email ou cpf já cadastrados'], 409);
            } else {
                return response()->json(['error' => 'Não foi possível criar o usuário.'], 422);
            }
        } else {
            return response()->json(['errors' => $request->errors()], 422);
        }

        return response()->json(['message' => 'Dados da config atualizados com sucesso'], 200);
        return $apiData;
    }
}
