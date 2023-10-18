<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Authenticatable;

class SessionGuard implements Guard
{
    protected $user;

    public function check()
    {
        return !is_null($this->user);
    }

    public function guest()
    {
        return is_null($this->user);
    }

    public function user()
    {
        return $this->user;
    }

    public function id()
    {
        return $this->user ? $this->user->getAuthIdentifier() : null;
    }

    public function validate(array $credentials = [])
    {
        dd("ENTROU NO SESSION GUARD");
        // Implement your session-based validation logic here.
        // For example, compare session data with provided credentials.
        // If valid, set $this->user to the authenticated user.
        // Otherwise, leave $this->user as null.

        // Example:
        if (session('username') === $credentials['username']) {
            $this->user = new YourUserModel(session('user_id'));
            return true;
        }

        return false;
    }

    public function hasUser()
    {
        return !is_null($this->user);
    }

    public function setUser(Authenticatable $user)
    {
        $this->user = $user;
    }
}