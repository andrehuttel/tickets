<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UserSession extends Authenticatable
{
    // Defina as propriedades do modelo, mas não interaja com o banco de dados
    protected $fillable = ['name', 'email', 'password'];

    public static function create(array $data)
    {
        $user = new UserSession([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return $user;
    }
}