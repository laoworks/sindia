<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $kelasData = [];

        $jurusan = ['IPA', 'IPS', 'Bahasa'];
        $tingkat = [10, 11, 12];

        foreach ($tingkat as $t) {
            foreach ($jurusan as $j) {
                for ($i = 1; $i <= 2; $i++) {
                    $kelasData[] = [
                        'nama_kelas' => "{$t} {$j} {$i}",
                        'jurusan' => $j,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        Kelas::insert($kelasData);
    }
}
