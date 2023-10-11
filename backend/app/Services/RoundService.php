<?php

namespace App\Services;

use App\Models\{Duel, Round, RoundResult};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoundService {

    /** Metoda tworzy rundę dla danej potyczki
     * @param Duel $duel
     * @return mixed
     */
    public function createRound(Duel $duel): Duel
    {
        $duel->rounds()->create([
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'winner_id' => NULL,
            'points' => 0,
        ]);

        return $duel;
    }

    /** Metoda obsługuje zapis wyboru karty gracza dla danej rundy
     * @param Request $request
     * @return array
     */
    public function doRound(Request $request): array
    {
        $highestRoundId = Round::where('duel_id', $request->duelId)->max('id');
        RoundResult::create([
            'round_id' => $highestRoundId,
            'player_id' => Auth::id(),
            'card_id' => $request->selectedCard
        ]);

        // Możesz też zwrócić jakieś dodatkowe informacje lub status zależnie od potrzeb
        return ['info' => 'OK'];
    }
}
