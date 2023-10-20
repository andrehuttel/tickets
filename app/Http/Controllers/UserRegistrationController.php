<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
//use App\Models\User;
use App\Models\UserSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserRegistrationController extends Controller
{
    use PasswordValidationRules;
    
    public function register(Request $request)
    {
        // Valide os dados de entrada
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Crie o usuário
        $user = UserSession::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        
        // Autentique o usuário
        auth()->login($user);
        
        // Armazene o usuário na sessão
        $request->session()->put('user', $user);
        //dd($user);
        //return Redirect::back()->with('success', 'Organization updated.');
        // Redirecione para a página desejada
        //return back();
    }
}