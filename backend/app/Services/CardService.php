<?php

namespace App\Services;

use App\Models\{Card, User};
use Carbon\Carbon;

class CardService
{
    /** Metoda losuje kartę dla gracza
     * @param User $user
     * @return array
     */
    public function getNewCard(User $user): array
    {
        if ($user->cards()->count() < 5) {
            $randomCard = Card::whereNotIn('id', [1])->inRandomOrder()->first();
            $user->cards()->attach($randomCard->id, ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            return ['message' => 'Wylosowano nową kartę!', 'card' => $randomCard];
        } else {
            return ['message' => 'Osiągnięto limit 5 kart. Nie można dodać więcej kart.'];
        }
    }
}
