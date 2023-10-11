<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(array $credentials): array
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return [
                'info' => 'OK',
                'token' => $user->createToken('login-token')->plainTextToken
            ];
        }

        return ['info' => __('Email or password is incorrect')];
    }

    public function logout(): void
    {
        auth('sanctum')->user()->tokens()->delete();
    }
}






