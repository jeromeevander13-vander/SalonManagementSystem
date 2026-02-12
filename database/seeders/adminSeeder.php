<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' =>  "admin",
                'email_verified_at' => now()
            ]
        );

         User::updateOrCreate(
            ['email' => 'client@gmail.com'],
            [
                'name' => 'client',
                'password' => Hash::make('client'),
                'role' =>  "client",
                'email_verified_at' => now()
            ]
        );
    }
}
