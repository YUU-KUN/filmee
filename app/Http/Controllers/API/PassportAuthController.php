<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use Hash;

class PassportAuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // $request->validate([
        //     'name' => 'required|string|min:4|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:6',
        // ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        return response()->json([
            'token' => $token,
            'user' => $user,
        ], 200);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        return $this->respondWithToken($token);
    }

    public function userProfile()
    {
        return response()->json(auth()->user());
    }
}
