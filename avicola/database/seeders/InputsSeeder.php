<?php

namespace Database\Seeders;

use App\Models\inputs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InputsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        inputs::insert([
            ['poultry_lots_id' => 1, 'name' => 'Alimento A', 'quantity' => 1000, 'unit_price' => 10.00, 'date_entry' => now(), 'date_expiration' => now()->addDays(30), 'type' => 'Alimento'],
            ['poultry_lots_id' => 2, 'name' => 'Medicamento B', 'quantity' => 500, 'unit_price' => 20.00, 'date_entry' => now(), 'date_expiration' => now()->addDays(60), 'type' => 'Medicamento'],
            ['poultry_lots_id' => 3, 'name' => 'Vacuna C', 'quantity' => 300, 'unit_price' => 15.00, 'date_entry' => now(), 'date_expiration' => now()->addDays(90), 'type' => 'Vacuna']
        ]);
    }
}
