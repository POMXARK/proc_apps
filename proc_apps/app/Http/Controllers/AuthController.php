<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $data) {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $token = $user->createToken('apiToken')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], Response::HTTP_CREATED);
    }

    public function login(LoginUserRequest $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'msg' => 'incorrect username or password'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $user->createToken('apiToken')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], Response::HTTP_CREATED);
    }
}
