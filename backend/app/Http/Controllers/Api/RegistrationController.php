<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegistrationRequest;
use App\Jobs\SendRegistrationEmailJob;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{

    /** Player Registration
     * @param UserRegistrationRequest $request
     * @return JsonResponse
     */
    protected function register(UserRegistrationRequest $request, UserService $userService): JsonResponse
    {
        // Create user
        $user = $userService->create($request->validated());

        // send job to queue
        dispatch(new SendRegistrationEmailJob($user));
        return response()->json([
            'message' => 'Your account is registered. If you want to log in to the game: go to the api/login endpoint'
        ]);
    }
}
