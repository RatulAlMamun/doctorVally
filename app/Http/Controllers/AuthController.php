<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\DoctorRegisterRequest;
use App\Http\Requests\auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(DoctorRegisterRequest $request)
    {
        $data = [
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ];
        $user = User::create($data);
        $token = $user->createToken('userToken')->accessToken;
        return response()->json([
            'error' => false,
            'message' => 'Registration Completed Successfully!!',
            'data' => [
                'token' => $token,
                'user' => $user
            ]
        ], 201);
    }


    public function login(LoginRequest $request)
    {
        $login_info = [
            'phone' => $request->phone,
            'password' => $request->password
        ];
        if(auth()->attempt($login_info))
        {
            $user = auth()->user();
            $token = $user->createToken('userToken')->accessToken;
            return response()->json([
                'error' => false,
                'message' => 'LogIn Successfully',
                'data' => [
                    'token' => $token,
                    'user' => $user
                ]
            ]);
        }
        else
        {
            return response()->json([
                'error' => true,
                'message' => 'Credential does not match!!'
            ], 401);
        }
    }

    public function me()
    {
        $user = auth()->user();
        return response()->json([
            'error' => false,
            'message' => 'LoggedIn user information!',
            'data' => $user
        ]);
    }
}
