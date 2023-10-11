<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Level::create(['name' => 'Nowicjusz', 'point_threshold' => 0]);
        Level::create(['name' => 'Weteran', 'point_threshold' => 100]);
        Level::create(['name' => 'Mistrz', 'point_threshold' => 160]);
    }
}
