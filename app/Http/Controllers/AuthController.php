<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\DoctorRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(DoctorRegisterRequest $request)
    {
        // dd($request->all());
        $data = [
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        $user = User::create($data);
        $token = $user->createToken('userToken')->accessToken;
        return response()->json([
            'error' => false,
            'message' => 'Registration Completed Successfully',
            'data' => [
                'token' => $token,
                'user' => $user
            ]
        ]);
    }
}
