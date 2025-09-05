<?php

// database/seeders/UserSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::firstOrCreate(
            ['email' => 'admin@demo.com'],
            ['name' => 'Administrador', 'password' => Hash::make('12345678'), 'rol' => 'admin']
        );

        // Vendedores
        User::firstOrCreate(
            ['email' => 'vendedor1@demo.com'],
            ['name' => 'Vendedor 1', 'password' => Hash::make('12345678'), 'rol' => 'vendedor']
        );

        User::firstOrCreate(
            ['email' => 'vendedor2@demo.com'],
            ['name' => 'Vendedor 2', 'password' => Hash::make('12345678'), 'rol' => 'vendedor']
        );

        // Cliente
        User::firstOrCreate(
            ['email' => 'cliente@demo.com'],
            ['name' => 'Cliente', 'password' => Hash::make('12345678'), 'rol' => 'cliente']
        );
    }
}
