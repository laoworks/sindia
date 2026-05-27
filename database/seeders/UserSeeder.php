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
        // =========================
        // ADMIN
        // =========================
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@sma26.com',
            'nip' => '19870001',
            'role' => 'admin',
            'foto_profil' => null,
            'password' => Hash::make('password'),
            'is_active' => 1,
        ]);

        // =========================
        // KEPALA SEKOLAH
        // =========================
        User::create([
            'name' => 'Kepala Sekolah',
            'email' => 'kepsek@sma26.com',
            'nip' => '19870003',
            'role' => 'kepala_sekolah',
            'foto_profil' => null,
            'password' => Hash::make('password'),
            'is_active' => 1,
        ]);

        // =========================
        // OPERATOR
        // =========================
        User::create([
            'name' => 'Operator Sekolah',
            'email' => 'operator@sma26.com',
            'nip' => '19870004',
            'role' => 'operator',
            'foto_profil' => null,
            'password' => Hash::make('password'),
            'is_active' => 1,
        ]);

        // =========================
        // GURU (30 Data)
        // =========================
        $guruData = [
            ['name' => 'Guru SMA 26', 'email' => 'guru@sma26.com', 'nip' => '19870002'],
            ['name' => 'Ahmad Fauzi', 'email' => 'guru1@sma26.com', 'nip' => '19870101'],
            ['name' => 'Budi Santoso', 'email' => 'guru2@sma26.com', 'nip' => '19870102'],
            ['name' => 'Citra Dewi', 'email' => 'guru3@sma26.com', 'nip' => '19870103'],
            ['name' => 'Dian Purnama', 'email' => 'guru4@sma26.com', 'nip' => '19870104'],
            ['name' => 'Eko Prasetyo', 'email' => 'guru5@sma26.com', 'nip' => '19870105'],
            ['name' => 'Fitri Handayani', 'email' => 'guru6@sma26.com', 'nip' => '19870106'],
            ['name' => 'Gunawan Wibowo', 'email' => 'guru7@sma26.com', 'nip' => '19870107'],
            ['name' => 'Hesti Nuraini', 'email' => 'guru8@sma26.com', 'nip' => '19870108'],
            ['name' => 'Indra Saputra', 'email' => 'guru9@sma26.com', 'nip' => '19870109'],
            ['name' => 'Joko Susilo', 'email' => 'guru10@sma26.com', 'nip' => '19870110'],
            ['name' => 'Kartika Sari', 'email' => 'guru11@sma26.com', 'nip' => '19870111'],
            ['name' => 'Lukman Hakim', 'email' => 'guru12@sma26.com', 'nip' => '19870112'],
            ['name' => 'Maya Sari', 'email' => 'guru13@sma26.com', 'nip' => '19870113'],
            ['name' => 'Nugroho Adi', 'email' => 'guru14@sma26.com', 'nip' => '19870114'],
            ['name' => 'Oktavia Dewi', 'email' => 'guru15@sma26.com', 'nip' => '19870115'],
            ['name' => 'Purnomo Hadi', 'email' => 'guru16@sma26.com', 'nip' => '19870116'],
            ['name' => 'Qonita Zahra', 'email' => 'guru17@sma26.com', 'nip' => '19870117'],
            ['name' => 'Rahmat Hidayat', 'email' => 'guru18@sma26.com', 'nip' => '19870118'],
            ['name' => 'Siti Aminah', 'email' => 'guru19@sma26.com', 'nip' => '19870119'],
            ['name' => 'Teguh Prasetyo', 'email' => 'guru20@sma26.com', 'nip' => '19870120'],
            ['name' => 'Umi Kalsum', 'email' => 'guru21@sma26.com', 'nip' => '19870121'],
            ['name' => 'Veronica Putri', 'email' => 'guru22@sma26.com', 'nip' => '19870122'],
            ['name' => 'Wahyu Nugroho', 'email' => 'guru23@sma26.com', 'nip' => '19870123'],
            ['name' => 'Xena Amelia', 'email' => 'guru24@sma26.com', 'nip' => '19870124'],
            ['name' => 'Yusuf Maulana', 'email' => 'guru25@sma26.com', 'nip' => '19870125'],
            ['name' => 'Zahra Aulia', 'email' => 'guru26@sma26.com', 'nip' => '19870126'],
            ['name' => 'Agus Salim', 'email' => 'guru27@sma26.com', 'nip' => '19870127'],
            ['name' => 'Bambang Hermanto', 'email' => 'guru28@sma26.com', 'nip' => '19870128'],
            ['name' => 'Cahya Ningrum', 'email' => 'guru29@sma26.com', 'nip' => '19870129'],
            ['name' => 'Dedi Mulyadi', 'email' => 'guru30@sma26.com', 'nip' => '19870130'],
        ];

        foreach ($guruData as $guru) {
            User::create([
                'name' => $guru['name'],
                'email' => $guru['email'],
                'nip' => $guru['nip'],
                'role' => 'guru',
                'foto_profil' => null,
                'password' => Hash::make('password'),
                'is_active' => 1,
            ]);
        }
    }
}
