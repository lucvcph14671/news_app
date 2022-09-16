<?php

namespace App\Http\Entities;

use App\Models\User;

class UserEntity
{
    public function index()
    {
        return response()->json([
            'data' => User::whereNot('role', 1)->get()
        ]);
    }
}
