<?php

namespace App\Http\Controllers\Api;

use App\Helpers;
use App\Http\Controllers\Controller;
use App\Services\DuelService;
use App\Services\DuelStatusService;
use App\Services\RoundCalculationService;
use App\Services\RoundService;
use App\Models\{Card, Duel, Round, RoundResult, User};
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DuelController extends Controller
{
    /**
     * @return array
     */
    public function index(): array
    {
        $duels = Duel::where(function ($query) {
            $query->where('player1_id', Auth::id())
                ->orWhere('player2_id', Auth::id());
        })
            ->withCount('rounds')
            ->orderByDesc('id')
            ->get();

        $resultsArray = []; // Pusta tablica na wyniki

        foreach ($duels as $singleDuel) {
            $duel = Duel::find($singleDuel->id);
            $player1Id = $duel->player1_id;
            $player2Id = $duel->player2_id;

            $player1PointsSum = $duel->roundResults
                ->where('player_id', $player1Id)
                ->sum(function ($result) {
                    return $result->card->power;
                });

            $player2PointsSum = $duel->roundResults
                ->where('player_id', $player2Id)
                ->sum(function ($result) {
                    return $result->card->power;
                });

            $winnerId = null; // Inicjujemy wartość na null w przypadku remisu

            if ($player1PointsSum > $player2PointsSum) {
                $winnerId = $player1Id;
            } elseif ($player2PointsSum > $player1PointsSum) {
                $winnerId = $player2Id;
            }

            $resultsArray[] = [
                'duel_id' => $duel->id,
                'player_name' => User::find($player1Id)->username,
                'opponent_name' => User::find($player2Id)->username,
                'player1PointsSum' => $player1PointsSum,
                'player2PointsSum' => $player2PointsSum,
                'won' => $winnerId == Auth::id() ? 1 : ($winnerId ? 0 : 2), // 1: won, 0, defeat, 2: remis
            ];
        }

        return $resultsArray;
  }


    /** Start new game
     * @return JsonResponse
     * @throws AuthorizationException
     */
     public function create(DuelService $duelService, RoundService $roundService): JsonResponse
     {
         $this->authorize('start', Duel::class);
         $currentUserId = Auth::id();
         // losujemy przeciwnika
         $opponent = $duelService->getRandomOpponent($currentUserId);
         // uruchamiamy pojedynek
         $duel = $duelService->createDuel($currentUserId, $opponent->id);
         // tworzymy pierwszą rundę
         $roundService->createRound($duel);
         return response()->json([
             'info' => 'OK',
         ]);
    }

    /** Metoda prezentuje status rozgrywki
     * @param DuelStatusService $duelStatusService
     * @param RoundCalculationService $roundCalculationService
     * @param DuelService $duelService
     * @param RoundService $roundService
     * @return array
     */
    public function show(DuelStatusService $duelStatusService,
                         RoundCalculationService $roundCalculationService,
                         DuelService $duelService,
                         RoundService $roundService): array
    {
        $user = Auth::user();
        return $duelStatusService->getDuelStatus($user, $roundCalculationService, $duelService, $roundService);
    }

    /**
     * @param Request $request
     * @param RoundService $roundService
     * @return JsonResponse
     */
    public function doRound(Request $request, RoundService $roundService): JsonResponse
    {
        $response = $roundService->doRound($request);

        return response()->json($response);
    }
}
