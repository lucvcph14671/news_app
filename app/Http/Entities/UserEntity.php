<?php

namespace App\Http\Entities;

use App\Models\User;

class UserEntity
{
    public function dataUser()
    {
        return response()->json([
            'data' => User::whereNot('role', 1)->get()
        ]);
    }
}
