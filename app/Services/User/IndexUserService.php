<?php

namespace App\Services\User;

use App\Models\User;

class IndexUserService
{
    public function run($data)
    {
        $users = User::all();
        return $users;
    }
}
