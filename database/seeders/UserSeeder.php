<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'              => 'Super Admin',
                'email'             => 'superadmin@example.com',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'Admin',
                'email'             => 'admin@example.com',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'User',
                'email'             => 'user@example.com',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}