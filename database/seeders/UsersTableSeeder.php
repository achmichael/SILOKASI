<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin Konsensus',
                'email' => 'admin@gdss.com',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'DM Lahan',
                'email' => 'dm1@gdss.com',
                'role' => 'dm',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'DM Infrastruktur',
                'email' => 'dm2@gdss.com',
                'role' => 'dm',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'DM Sosial Ekonomi',
                'email' => 'dm3@gdss.com',
                'role' => 'dm',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
