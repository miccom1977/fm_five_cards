<?php

namespace App\Services;

use App\Models\{Duel, User};

class DuelService {

    /** Metoda losuje randomowego przeciwnika
     * @param int $currentUserId
     * @return User
     */
    public function getRandomOpponent(int $currentUserId): User
    {
        return User::where('id', '!=', $currentUserId)
            ->inRandomOrder()
            ->first();
    }

    /** Metoda tworzy pojedynek
     * @param int $player1Id
     * @param int $player2Id
     * @return Duel
     */
    public function createDuel(int $player1Id,int $player2Id): Duel
    {
        return Duel::create([
            'player1_id' => $player1Id,
            'player2_id' => $player2Id,
        ]);
    }

    public function handleDuelEnd(User $user, $opponentUserId, $yourPoints, $opponentPoints): void
    {
        $gameWinner = $this->calculateGameWinner($yourPoints, $user, $opponentPoints, $opponentUserId);

        if ($gameWinner === $user->id) {
            $user->level_points += 20;
            $user->save();
        } else {
            $winnerUser = User::find($opponentUserId);
            $winnerUser->level_points += 20;
            $winnerUser->save();
        }
    }

    protected function calculateGameWinner($yourPoints, $user, $opponentPoints, $opponentUserId)
    {
        if ($yourPoints > $opponentPoints) {
            return $user->id;
        } elseif ($opponentPoints > $yourPoints) {
            return $opponentUserId;
        } else {
            return null; // Remis
        }
    }
}
