<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use App\Models\User;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $guru = User::where('role', 'guru')->get();
        $kelas = Kelas::all();
        $mapel = MataPelajaran::all();

        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $jamMulai = ['07:30:00', '08:30:00', '09:30:00', '10:30:00', '13:00:00', '14:00:00'];
        $jamSelesai = ['08:30:00', '09:30:00', '10:30:00', '11:30:00', '14:00:00', '15:00:00'];

        $jadwalData = [];
        $counter = 0;

        foreach ($guru as $g) {
            // Setiap guru mendapat 3-5 jadwal
            $jumlahJadwal = rand(3, 5);
            $usedCombinations = [];

            for ($i = 0; $i < $jumlahJadwal; $i++) {
                $hariKe = array_rand($hari);
                $jamKe = array_rand($jamMulai);
                $kelasKe = array_rand($kelas->toArray());
                $mapelKe = array_rand($mapel->toArray());

                $key = $hari[$hariKe] . '_' . $jamKe;

                // Hindari duplikasi jadwal untuk guru yang sama di hari dan jam yang sama
                if (!in_array($key, $usedCombinations)) {
                    $usedCombinations[] = $key;

                    $jadwalData[] = [
                        'guru_id' => $g->id,
                        'kelas_id' => $kelas[$kelasKe]->id,
                        'mapel_id' => $mapel[$mapelKe]->id,
                        'hari' => $hari[$hariKe],
                        'jam_mulai' => $jamMulai[$jamKe],
                        'jam_selesai' => $jamSelesai[$jamKe],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $counter++;

                    if ($counter >= 100) break 2;
                }
            }
        }

        Jadwal::insert($jadwalData);
    }
}
