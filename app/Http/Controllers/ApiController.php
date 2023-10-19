<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use App\Services\CompanyService;
use App\Services\UserService;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    private $companyService;
    private $userService;

    public function __construct(CompanyService $companyService, UserService $userService)
    {
        $this->companyService = $companyService;
        $this->userService = $userService;
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

    public function login(Request $request)
    {
        // $data = $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required|password',
        // ]);

        $data = [
            'place_id' => 'euaqpe8smdzl26k275zx',
            'customer_email_address' => 'pedro@gmail.com',
            'customer_password' => 'pera',
        ];

        if ($data) {
            $apiService = new ApiService();
            $apiData = $apiService->postData(env('API_URL').'/customer-auth', env('API_USERNAME'), env('API_PASSWORD'), $data);
            if ($apiData === 200) {
                //Efetua o Login
                return response()->json(['message' => 'Cliente autenticado com sucesso!'], 200, [], JSON_UNESCAPED_UNICODE);
            } else if ($apiData === 401) {
                return response()->json(['error' => 'Credenciais inválidas'], 401, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(['error' => 'Não foi possível efetuar o login.'], 422, [], JSON_UNESCAPED_UNICODE);
            }
        } else {
            return response()->json(['errors' => $request->errors()], 422);
        }
    }

    public function customer(Request $request)
    {
        // $data = $request->validate([
        //     'email_address' => 'required|email',
        //     'name' => 'required|max:50',
        //     'phone_number' => 'min:14|max:15',
        //     'country' => 'required|max:500',
        //     'cpf' => 'required|max:500',
        //     'foreigner_document' => 'max:500',
        //     'password' => 'required|max:500',
        // ]);
        
        $data = [
            'place_id' => 'euaqpe8smdzl26k275zx',
            'email_address' => 'pedro@gmail.com',
            'name' => 'Pedro',
            'surname' => 'da Silva',
            'phone_number' => '5547996221155',
            'country' => 'Brasil',
            'cpf' => '87267973051',
            'foreigner_document' => '',
            'password' => 'abacaxi',
        ];

        if ($data) {
            $apiService = new ApiService();
            $apiData = $apiService->postData(env('API_URL').'/customer', env('API_USERNAME'), env('API_PASSWORD'), $data);
            if ($apiData === 200) {
                //Registra o usuario, salva em sessão.
                return response()->json(['message' => 'Usuário criado com sucesso!'], 200, [], JSON_UNESCAPED_UNICODE);
            } else if ($apiData === 409) {
                return response()->json(['error' => 'Email ou cpf já cadastrados'], 409, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(['error' => 'Não foi possível criar o usuário.'], 422, [], JSON_UNESCAPED_UNICODE);
            }
        } else {
            return response()->json(['errors' => $request->errors()], 422);
        }
    }

    public function uniqueCpf(Request $request)
    {
        $data = [
            'place_id' => 'euaqpe8smdzl26k275zx',
            'customer_email_address' => 'null',
            'customer_cpf' => '60830102094',
        ];

        if ($data) {
            $apiService = new ApiService();
            $apiData = $apiService->postData(env('API_URL').'/customer-exists', env('API_USERNAME'), env('API_PASSWORD'), $data);
            if ($apiData === 200) {
                return response()->json(['message' => 'Usuário existe.'], 200, [], JSON_UNESCAPED_UNICODE);
            } else if ($apiData === 404) {
                return response()->json(['error' => 'Usuário não existe.'], 404, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(['error' => 'Não foi possível validar o usuário.'], 422, [], JSON_UNESCAPED_UNICODE);
            }
        } else {
            return response()->json(['errors' => $request->errors()], 422);
        }
    }

    public function uniqueEmail(Request $request)
    {
        $data = [
            'place_id' => 'euaqpe8smdzl26k275zx',
            'customer_email_address' => 'pedro@gmail.com',
            'customer_cpf' => 'null',
        ];

        if ($data) {
            $apiService = new ApiService();
            $apiData = $apiService->postData(env('API_URL').'/customer-exists', env('API_USERNAME'), env('API_PASSWORD'), $data);
            if ($apiData === 200) {
                return response()->json(['message' => 'Usuário existe.'], 200, [], JSON_UNESCAPED_UNICODE);
            } else if ($apiData === 404) {
                return response()->json(['error' => 'Usuário não existe.'], 404, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(['error' => 'Não foi possível validar o usuário.'], 422, [], JSON_UNESCAPED_UNICODE);
            }
        } else {
            return response()->json(['errors' => $request->errors()], 422);
        }
    }

    public function requestPassword(Request $request)
    {
        $data = [
            'place_id' => 'euaqpe8smdzl26k275zx',
            'email_address' => 'pedro@gmail.com',
        ];

        if ($data) {
            $apiService = new ApiService();
            $apiData = $apiService->postData(env('API_URL').'/customer-change-password', env('API_USERNAME'), env('API_PASSWORD'), $data);
            if ($apiData === 200) {
                return response()->json(['message' => 'Token obtido com sucesso!'], 200, [], JSON_UNESCAPED_UNICODE);
            } else if ($apiData === 404) {
                return response()->json(['error' => 'Cliente não encontrado.'], 404, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(['error' => 'Não foi possível solicitar o token.'], 422, [], JSON_UNESCAPED_UNICODE);
            }
        } else {
            return response()->json(['errors' => $request->errors()], 422);
        }
    }

    public function passwordRecovery(Request $request)
    {
        $data = [
            'place_id' => 'euaqpe8smdzl26k275zx',
            'customer_token' => '9898y98aysdasdasd8y98y98yasdasd',
            'customer_new_password' => 'pera',
        ];

        if ($data) {
            $apiService = new ApiService();
            $apiData = $apiService->postData(env('API_URL').'/customer-change-password-confirm', env('API_USERNAME'), env('API_PASSWORD'), $data);
            if ($apiData === 200) {
                return response()->json(['message' => 'Senha alterada com sucesso!'], 200, [], JSON_UNESCAPED_UNICODE);
            } else if ($apiData === 404) {
                return response()->json(['error' => 'Token não encontrado.'], 404, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(['error' => 'Não foi possível alterar a senha.'], 422, [], JSON_UNESCAPED_UNICODE);
            }
        } else {
            return response()->json(['errors' => $request->errors()], 422);
        }
    }

    public function sendEmailNewUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email',
            'fone' => 'min:14|max:15',
            'body' => 'required|max:500',
        ]);

        if ($validatedData) {
            $emailTemplate = '
            <!DOCTYPE html>
            <html>
            <head>
                <title>Bem-vindo ao Nosso Sistema</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f5f5f5;
                        padding: 20px;
                    }
                    .container {
                        background-color: #ffffff;
                        padding: 20px;
                        border-radius: 5px;
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    }
                    h1 {
                        color: #333;
                    }
                    ul {
                        list-style: none;
                        padding: 0;
                    }
                    li {
                        margin-bottom: 10px;
                    }
                    p {
                        color: #555;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <h1>Bem-vindo ao Nosso Sistema</h1>
                    <p>Olá, [NOME_DO_USUÁRIO],</p>
                    <p>Seu cadastro no Nosso Sistema foi criado com sucesso.</p>
                    <p>Aqui estão os detalhes da sua conta:</p>
                    
                    <ul>
                        <li><strong>Nome de Usuário:</strong> [NOME_DE_USUÁRIO]</li>
                        <li><strong>Email:</strong> [EMAIL_DO_USUÁRIO]</li>
                        <li><strong>Fone:</strong> [FONE_DO_USUÁRIO]</li>
                    </ul>
                    
                    <p>Agradecemos por fazer parte do nosso sistema. Você pode fazer login a qualquer momento usando as informações fornecidas.</p>
                    
                    <p>Se você tiver alguma dúvida ou precisar de assistência, entre em contato conosco.</p>
                    
                    <p>Obrigado!</p>
                </div>
            </body>
            </html>
            ';

            // Substitua os espaços reservados pelos dados reais
            $emailTemplate = str_replace('[NOME_DO_USUÁRIO]', $validatedData['name'], $emailTemplate);
            $emailTemplate = str_replace('[EMAIL_DO_USUÁRIO]', $validatedData['email'], $emailTemplate);
            $emailTemplate = str_replace('[FONE_DO_USUÁRIO]', $validatedData['fone'], $emailTemplate);

            $validatedData['type'] = 'contact';
            $validatedData['subject'] = 'Contato via site';
            $validatedData['fone'] = preg_replace('/[^0-9]/', '', $validatedData['fone']);
            $apiData = $this->userService->postSendEmailNewUser($data);
            if($apiData){
                return response()->json(['message' => 'E-mail enviado com sucesso!']);
            }
            return response()->json(['error' => 'Não foi possível enviar a mensagem, entre em contato de outra forma.'], 400);
        } else {
            return response()->json(['errors' => $request->errors()], 422);
        }
    }

    public function sendEmailPasswordRecovery(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);

        if ($validatedData) {
            $validatedData['type'] = 'contact';
            $validatedData['subject'] = 'Contato via site';
            $validatedData['fone'] = preg_replace('/[^0-9]/', '', $validatedData['fone']);
            $apiData = $this->userService->postSendEmailPasswordRecovery($data);
            if($apiData){
                return response()->json(['message' => 'E-mail enviado com sucesso!']);
            }
            return response()->json(['error' => 'Não foi possível enviar a mensagem, entre em contato de outra forma.'], 400);
        } else {
            return response()->json(['errors' => $request->errors()], 422);
        }
    }
}
