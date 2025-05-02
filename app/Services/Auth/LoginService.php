<?php

namespace App\Services\Auth;

use App\Models\User;

class LoginService
{
    public function run(array $data): string
    {
        $user = User::where('email', $data['email'])->first();
        return $user->createToken('login_api')->plainTextToken;
    }
}
