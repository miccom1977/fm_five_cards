<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany, HasManyThrough};

class Duel extends Model
{
    use HasFactory;

    protected $fillable = [
        'player1_id',
        'player2_id',
        'current_round'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Sprawdza, czy dany użytkownik jest uczestnikiem danej gry.
     * @param User $user
     * @return bool
     */
    public function hasParticipant(User $user): bool
    {
        // sprawdzamy, czy user znajduje się na liście graczy w danym pojedynku
        return in_array($user->id, [$this->player1_id, $this->player2_id]);
    }

    public function rounds(): HasMany
    {
        return $this->hasMany(Round::class);
    }

    public function roundResults(): HasManyThrough
    {
        return $this->hasManyThrough(RoundResult::class, Round::class, 'duel_id', 'round_id');
    }
}
