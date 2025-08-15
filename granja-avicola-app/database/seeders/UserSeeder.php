<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario Administrador
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@granja.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Crear usuario Empleado/Operario
        User::create([
            'name' => 'Employee User',
            'email' => 'employee@granja.com',
            'password' => Hash::make('password123'),
            'role' => 'operario',
        ]);
    }
}
