<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * @return array
     */
    public function store(UserService $userService): array
    {
        $user = User::find(Auth::id());
        return $userService->getUserProfile($user);
    }
}
