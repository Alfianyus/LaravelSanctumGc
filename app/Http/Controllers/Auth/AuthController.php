<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function register(RegisterRequest $registerRequest)
    {
        // validate

        $registerRequest->validated();

        //register
        $user = User::create([
            'name'=>$registerRequest->name,
            'username'=>$registerRequest->username,
            'email'=>$registerRequest->email,
            'password'=>Hash::make($registerRequest->password),
        ]);

        //create token
        $token = $user->createToken('groceryapp')->plainTextToken;



        //return response
        return response([
            'user' => $user,
            'token' => $token
        ], 201);

    }
}
