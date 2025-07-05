<?php

namespace Database\Seeders;

use App\Models\Sheds;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShedsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sheds::insert([
            ['name' => 'Galpon 1',
            'date' => now()],
            ['name' => 'Galpon 2',
            'date' => now()],
            ['name' => 'Galpon 3',
            'date' => now()]
        ]);
    }
}
