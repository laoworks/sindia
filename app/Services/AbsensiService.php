<?php

namespace App\Services;

use App\Models\Jadwal;
use Carbon\Carbon;

class AbsensiService
{
    public static function getJadwalAktif($guruId)
    {
        $hari = Carbon::now()->locale('id')->isoFormat('dddd');

        return Jadwal::where('guru_id', $guruId)
            ->where('hari', $hari)
            ->orderBy('jam_mulai', 'asc')
            ->get();
    }

    public static function getStatusMasuk($jadwal, $now)
    {
        $jamMulai = Carbon::createFromFormat('H:i:s', $jadwal->jam_mulai);

        return $now->gt($jamMulai) ? 'terlambat' : 'tepat_waktu';
    }

    public static function getStatusPulang($jadwal, $now)
    {
        $jamSelesai = Carbon::createFromFormat('H:i:s', $jadwal->jam_selesai);

        return $now->lt($jamSelesai) ? 'lebih_awal' : 'tepat_waktu';
    }
}
