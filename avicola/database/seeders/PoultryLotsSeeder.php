<?php

namespace Database\Seeders;

use App\Models\PoultryLots;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoultryLotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PoultryLots::insert([
            ['sheds_id' => 1, 'quantity' => 1000, 'date_entry' => now()],
            ['sheds_id' => 2, 'quantity' => 1500, 'date_entry' => now()],
            ['sheds_id' => 3, 'quantity' => 1200, 'date_entry' => now()]
        ]);
    }
}
