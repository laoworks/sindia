<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;

class MataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $mapelData = [
            ['nama_mapel' => 'Matematika', 'kkm' => 75],
            ['nama_mapel' => 'Fisika', 'kkm' => 75],
            ['nama_mapel' => 'Kimia', 'kkm' => 75],
            ['nama_mapel' => 'Biologi', 'kkm' => 75],
            ['nama_mapel' => 'Bahasa Indonesia', 'kkm' => 75],
            ['nama_mapel' => 'Bahasa Inggris', 'kkm' => 75],
            ['nama_mapel' => 'Sejarah', 'kkm' => 75],
            ['nama_mapel' => 'Geografi', 'kkm' => 75],
            ['nama_mapel' => 'Ekonomi', 'kkm' => 75],
            ['nama_mapel' => 'Sosiologi', 'kkm' => 75],
            ['nama_mapel' => 'Pendidikan Agama', 'kkm' => 75],
            ['nama_mapel' => 'Pendidikan Pancasila', 'kkm' => 75],
            ['nama_mapel' => 'Seni Budaya', 'kkm' => 75],
            ['nama_mapel' => 'Penjaskes', 'kkm' => 75],
            ['nama_mapel' => 'Informatika', 'kkm' => 75],
        ];

        foreach ($mapelData as $mapel) {
            MataPelajaran::create($mapel);
        }
    }
}
