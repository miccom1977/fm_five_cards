<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\CardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CardController extends Controller
{
    public function getNewCard(CardService $cardService): JsonResponse
    {
        $user = User::find(Auth::id());
        $response = $cardService->getNewCard($user);

        return response()->json($response, ResponseAlias::HTTP_OK);
    }
}
