<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\FortifyServiceProvider;
use Illuminate\Support\Facades\Auth;

class CustomFortifyServiceProvider extends FortifyServiceProvider
{
    public function boot()
    {
        parent::boot();
        Fortify::authenticateUsing(function (Request $request) {
            $data = [
                'name' => 'Andre Luiz H',
                'email' => 'andreluizhuttel@gmail.com',
                'password' => 123456789,
                'teste_session' => true,
            ];

            $userData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ];

            Session::put('user', $userData);

            $user = new User($userData);

            Auth::login($user);

            //dd(Auth::check());

            return $user;
        });
    }
}