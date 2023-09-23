<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Sprawdza, czy dany użytkownik jest uczestnikiem danej gry.
     * @param User $user
     * @return bool
     */
    public function hasParticipant(User $user)
    {
        // sprawdzamy, czy user znajduje się na liście playerów w danej grze
        return in_array($user->id, [$this->player1_id, $this->player2_id]);
    }
}
