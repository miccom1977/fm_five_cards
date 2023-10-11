<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Seeder;

class CardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // tworzymy kartę zerową w przypadku kiedy gracz nie wybierze karty
        Card::factory()->create(['name' => 'Zero', 'power' => 0, 'image' => 'card-0.jpg']);
        Card::factory(15)->create();
    }
}
