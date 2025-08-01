<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create Admin User ONLY
        User::create([
            'name' => 'Admin',
            'email' => 'admin@jakartagigsinfo.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);
    }
}
