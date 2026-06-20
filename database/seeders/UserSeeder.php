<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // 1. Akun Admin (Owner)
        User::create([
            'name' => 'BOS RAFI',
            'email' => 'admin@cleansy.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Akun Kasir (Karyawan)
        User::create([
            'name' => 'Zahrotul',
            'email' => 'kasir@cleansy.com',
            'password' => Hash::make('password123'),
            'role' => 'kasir',
        ]);
    }
}