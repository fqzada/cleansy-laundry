<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun ADMIN / OWNER
        User::create([
            'name' => 'BOS RAFI',
            'email' => 'owner@cleansy.com',
            'password' => Hash::make('password'), // Password login: password
            'role' => 'admin',
        ]);

        // 2. Akun KASIR 1
        User::create([
            'name' => 'Zahrotul',
            'email' => 'kasir1@cleansy.com',
            'password' => Hash::make('password'), // Password login: password
            'role' => 'kasir',
        ]);

        // 3. Akun KASIR 2
        User::create([
            'name' => 'Ardito Sam',
            'email' => 'kasir2@cleansy.com',
            'password' => Hash::make('password'), // Password login: password
            'role' => 'kasir',
        ]);
        // 3. Akun Kasir (Karyawan Tambahan)
        User::create([
            'name' => 'Fulan1',
            'email' => 'kasir3@cleansy.com',
            'password' => Hash::make('password123'),
            'role' => 'kasir',
        ]);
    }
}