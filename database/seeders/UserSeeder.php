<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Administrator',
                'email' => 'admin@sma26.com',
                'nip' => '19870001',
                'role' => 'admin',
            ],

            [
                'name' => 'Operator Sekolah',
                'email' => 'operator@sma26.com',
                'nip' => '19870003',
                'role' => 'operator',
            ],
            [
                'name' => 'Guru Matematika',
                'email' => 'guru@sma26.com',
                'nip' => '19870004',
                'role' => 'guru',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']], // anti duplikat
                [
                    'name' => $user['name'],
                    'nip' => $user['nip'],
                    'role' => $user['role'],
                    'foto_profil' => null,
                    'password' => Hash::make('password'),
                    'is_active' => 1,
                ]
            );
        }
    }
}
