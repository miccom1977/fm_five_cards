<?php

namespace App\Services;

use App\Models\{Card, Round};

class RoundCalculationService
{
    /** Metoda wykonuje porównanie wybranych kart
     * @param Round $round
     * @param $roundResults
     * @return void
     */
    public function calculateRoundResult(Round $round, $roundResults): void
    {
        $winnerUserId = null;
        $powerDifference = null;

        if ($roundResults->count() > 1) {
            foreach ($roundResults as $roundResult) {
                $playerId = $roundResult->player_id;
                $card = Card::find($roundResult->card_id);
                $power = $card->power;

                if ($powerDifference === null || abs($power - $powerDifference) > $powerDifference) {
                    $powerDifference = abs($power - $powerDifference);
                    $winnerUserId = $playerId;
                }
            }
        } elseif ($roundResults->count() === 1) {
            $winnerUserId = $roundResults[0]->player_id;
            $card = Card::find($roundResults[0]->card_id);
            $powerDifference = $card->power;
        } else {
            // żaden z graczy nie wybrał karty
            $winnerUserId = true;
            $powerDifference = false;
        }

        if ($winnerUserId !== null) {
            $round->winner_id = $winnerUserId;
            $round->points = $powerDifference;
            $round->save();
        }
    }
}
