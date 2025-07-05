<?php

namespace Database\Seeders;

use App\Models\Mortality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MortalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mortality::insert([
            ['poultry_lots_id' => 1, 'quantity' => 100, 'date' => now(), 'observation'=> 'muertos por enfermedad'],
            ['poultry_lots_id' => 2, 'quantity' => 50, 'date' => now(), 'observation'=> 'muertos por estrés'],
            ['poultry_lots_id' => 3, 'quantity' => 75, 'date' => now(), 'observation'=> 'muertos por desnutrición']
        ]);
    }
}
