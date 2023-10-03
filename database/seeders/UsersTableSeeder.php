<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creazione utente admin di default
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '',
            'password' => Hash::make('password'),
        ]);
    }
}

// php artisan db:seed --class=UsersTableSeeder
