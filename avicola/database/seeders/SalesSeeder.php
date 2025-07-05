<?php

namespace Database\Seeders;

use App\Models\Sales;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sales::insert([
            ['poultry_lots_id' => 1, 'quantity' => 200, 'price' => 5.00, 'date' => now(), 'type' => 'fiado'],
            ['poultry_lots_id' => 2, 'quantity' => 150, 'price' => 6.00, 'date' => now(), 'type' => 'contado'],
            ['poultry_lots_id' => 3, 'quantity' => 100, 'price' => 7.00, 'date' => now(), 'type' => 'fiado']
        ]);
    }
}
