<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /** Start new game
     * @return void
     */
     public function create(): JsonResponse
     {
         $this->authorize('start', Game::class);
        /*
         Game::create([
             'player1_id' => Auth::id(),
             'current_round' => 0,
         ]);
         return response()->json([
             'message' => 'Rozpoczynasz nową grę. Zaczekaj na gracza lub wyślij zaproszenie do gry na endpoint '
         ]);
        */
    }
}
