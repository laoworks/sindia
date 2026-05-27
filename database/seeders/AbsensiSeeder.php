<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AbsensiSeeder extends Seeder
{
    public function run(): void
    {
        $guru = User::where('role', 'guru')->get();
        $statusMasuk = ['tepat_waktu', 'terlambat'];
        $statusPulang = ['tepat_waktu', 'lebih_awal'];

        $absensiData = [];

        // Data untuk bulan Mei 2026 (tanggal 1-27)
        $startDate = Carbon::create(2026, 5, 1);
        $endDate = Carbon::create(2026, 5, 27);

        foreach ($guru as $g) {
            $date = clone $startDate;
            $hadirCount = 0;

            while ($date <= $endDate) {
                // Skip weekend (Sabtu dan Minggu)
                if ($date->dayOfWeek != Carbon::SATURDAY && $date->dayOfWeek != Carbon::SUNDAY) {
                    // 90% chance hadir, 10% chance tidak hadir
                    $isHadir = rand(1, 100) <= 90;

                    if ($isHadir) {
                        $jamMasuk = rand(7, 9) . ':' . rand(0, 59) . ':' . rand(0, 59);
                        $jamPulang = rand(14, 16) . ':' . rand(0, 59) . ':' . rand(0, 59);

                        $statusMasukValue = $jamMasuk <= '08:00:00' ? 'tepat_waktu' : 'terlambat';
                        $statusPulangValue = $jamPulang >= '15:00:00' ? 'tepat_waktu' : 'lebih_awal';

                        $absensiData[] = [
                            'user_id' => $g->id,
                            'tanggal' => $date->format('Y-m-d'),
                            'waktu_masuk' => $date->format('Y-m-d') . ' ' . $jamMasuk,
                            'waktu_pulang' => $date->format('Y-m-d') . ' ' . $jamPulang,
                            'foto_masuk' => null,
                            'foto_pulang' => null,
                            'status_masuk' => $statusMasukValue,
                            'status_pulang' => $statusPulangValue,
                            'ip_address' => '127.0.0.1',
                            'user_agent' => 'Seeder',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                        $hadirCount++;
                    }
                }
                $date->addDay();
            }

            // Pastikan setiap guru punya minimal 10 absensi
            if ($hadirCount < 10) {
                // Tambahkan absensi tambahan
                $date = clone $startDate;
                $added = 0;
                while ($added < (10 - $hadirCount) && $date <= $endDate) {
                    if ($date->dayOfWeek != Carbon::SATURDAY && $date->dayOfWeek != Carbon::SUNDAY) {
                        // Cek apakah sudah ada absensi di tanggal ini
                        $exists = false;
                        foreach ($absensiData as $a) {
                            if ($a['user_id'] == $g->id && $a['tanggal'] == $date->format('Y-m-d')) {
                                $exists = true;
                                break;
                            }
                        }
                        if (!$exists) {
                            $jamMasuk = rand(7, 9) . ':' . rand(0, 59) . ':' . rand(0, 59);
                            $jamPulang = rand(14, 16) . ':' . rand(0, 59) . ':' . rand(0, 59);

                            $absensiData[] = [
                                'user_id' => $g->id,
                                'tanggal' => $date->format('Y-m-d'),
                                'waktu_masuk' => $date->format('Y-m-d') . ' ' . $jamMasuk,
                                'waktu_pulang' => $date->format('Y-m-d') . ' ' . $jamPulang,
                                'foto_masuk' => null,
                                'foto_pulang' => null,
                                'status_masuk' => $jamMasuk <= '08:00:00' ? 'tepat_waktu' : 'terlambat',
                                'status_pulang' => $jamPulang >= '15:00:00' ? 'tepat_waktu' : 'lebih_awal',
                                'ip_address' => '127.0.0.1',
                                'user_agent' => 'Seeder',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                            $added++;
                        }
                    }
                    $date->addDay();
                }
            }
        }

        // Insert batch 100 records at a time
        $chunks = array_chunk($absensiData, 100);
        foreach ($chunks as $chunk) {
            Absensi::insert($chunk);
        }
    }
}
