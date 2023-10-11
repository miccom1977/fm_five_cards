<?php

namespace App\Services;

use App\Models\{Duel, Round, RoundResult, User};

class DuelStatusService
{
    /** Metoda obsługująca pojedynek w rundzie
     * @param User $user
     * @param RoundCalculationService $roundCalculationService
     * @param DuelService $duelService
     * @param RoundService $roundService
     * @return array
     */
    public function getDuelStatus(User $user,
                                  RoundCalculationService $roundCalculationService,
                                  DuelService $duelService,
                                  RoundService $roundService): array
    {
        $activeDuel = Duel::where(function ($query) use ($user) {
            $query->where('player1_id', $user->id)
                ->orWhere('player2_id', $user->id);
        })
            ->with('rounds')
            ->orderBy('id', 'desc')
            ->first();

        // Pobierz ID przeciwnika
        $opponentUserId = ($activeDuel->player1_id == $user->id) ? $activeDuel->player2_id : $activeDuel->player1_id;

        if ($activeDuel->rounds->count() > 0 && $activeDuel->rounds->count() <= 5) {
            $highestRoundId = $activeDuel->rounds->max('id');
            $roundResults = RoundResult::where('round_id', $highestRoundId)->get();
            $round = Round::find($highestRoundId);

            // Oblicz wynik rundy i zapisz go
            $roundCalculationService->calculateRoundResult($round, $roundResults);
            // inicjujemy kolejną rundę
            $roundService->createRound($activeDuel);
        }

        // Oblicz punkty gracza i przeciwnika
        $yourPoints = $this->calculateUserPoints($activeDuel->id, $user->id);
        $opponentPoints = $this->calculateUserPoints($activeDuel->id, $opponentUserId);

        if ($activeDuel->rounds->count() > 5) {
            $duelService->handleDuelEnd($activeDuel, $user, $opponentUserId, $yourPoints, $opponentPoints, $roundService);
        }

        return [
            'id' => $activeDuel->id,
            'round' => $activeDuel->rounds->count() ?? 1,
            'your_points' => $yourPoints,
            'opponent_points' => $opponentPoints,
            'status' => ($activeDuel->rounds->count() <= 5) ? 'active' : 'finished',
            'cards' => $user->cards
        ];
    }

    /** Metoda oblicza punkty zdobyte w całym pojedynku
     * @param $duelId
     * @param $userId
     * @return int
     */
    protected function calculateUserPoints($duelId, $userId): int
    {
        return Round::where('duel_id', $duelId)
            ->where('winner_id', $userId)
            ->sum('points');
    }
}
