<?php

namespace Database\Factories;

use App\Helpers;
use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Card>
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $usedNumbers = [];

        return [
            'name' => fake()->name('male'),
            'power' => fake()->numberBetween(1, 100),
            'image' => 'card-' . Helpers::generateUniqueNumber($usedNumbers) . '.jpg'
        ];
    }
}
