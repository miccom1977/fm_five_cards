<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegistrationRequest;
use App\Jobs\SendRegistrationEmailJob;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{

    /** Player Registration
     * @param UserRegistrationRequest $request
     * @return JsonResponse
     */
    protected function register(UserRegistrationRequest $request): JsonResponse
    {
        // Create user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => Role::PLAYER
        ]);
        // send job to queue
        dispatch(new SendRegistrationEmailJob($user));
        return response()->json([
            'message' => 'Your account is registered. If you want to log in to the game: go to the api/login endpoint'
        ]);
    }
}
