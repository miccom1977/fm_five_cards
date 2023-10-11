<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @param AuthService $authService
     * @return JsonResponse
     */
    public function login(LoginRequest $request, AuthService $authService): JsonResponse
    {

        $validatedData = $request->validated();

        $credentials = [
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ];

        $loginResponse = $authService->login($credentials);

        if (isset($loginResponse['token'])) {
            return response()->json($loginResponse);
        }

        return response()->json($loginResponse, ResponseAlias::HTTP_UNAUTHORIZED);
    }

    /**
     * @param AuthService $authService
     * @return JsonResponse
     */
    public function logout(AuthService $authService): JsonResponse
    {
        $authService->logout();

        return response()->json(['info' => 'OK']);
    }
}
