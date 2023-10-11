<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoundResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'round_id',
        'player_id',
        'card_id'
    ];

    // Relacja do rundy
    public function round(): BelongsTo
    {
        return $this->belongsTo(Round::class);
    }

    // Relacja do gracza
    public function player(): BelongsTo
    {
        return $this->belongsTo(User::class, 'player_id');
    }

    // Relacja do karty
    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'card_id', 'id');
    }

}
