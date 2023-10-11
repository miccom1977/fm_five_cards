<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Round extends Model
{
    use HasFactory;
    protected $fillable = [
        'created_at',
        'updated_at',
        'winner_id',
        'points'
    ];

    public function duel(): BelongsTo
    {
        return $this->belongsTo(Duel::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(RoundResult::class, 'round_id');
    }
}
