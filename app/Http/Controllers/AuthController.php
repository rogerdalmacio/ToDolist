<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    
    public function login(Request $request) {

        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return response(['Bad Credentials'], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('basic')->plainTextToken;
        
        $response = [
            'name' => $user['name'],
            'token' => $token
        ];

        return response($response, 200);

    }

    public function logout(){

        $user = Auth::user();

        $user->currentAccessToken()->delete();
        
        $response =  [
            'message' => 'Logged out'
        ];
        
        return response($response, 200);

    }

}
