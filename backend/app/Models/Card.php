<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Card extends Model
{
    use HasFactory;

    public function roundResults(): HasMany
    {
        return $this->hasMany(RoundResult::class, 'card_id');
    }
}
