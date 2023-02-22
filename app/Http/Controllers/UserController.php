<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function register(Request $request) {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string'
        ]);

        $user = User::create($request->all());

        $token = $user->createToken('basic')->plainTextToken;

        $response = [
            'name' => $user->name,
            'token' => $token
        ];

        return response($response, 201);

    }

}
