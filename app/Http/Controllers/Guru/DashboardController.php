<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $guruId = Auth::id();

        // =========================
        // KONVERSI HARI INDONESIA
        // =========================
        $hari = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu',
        ][Carbon::now()->format('l')];

        // =========================
        // JADWAL HARI INI
        // =========================
        $jadwalHariIni = Jadwal::with(['kelas', 'mapel'])
            ->where('guru_id', $guruId)
            ->where('hari', $hari)
            ->orderBy('jam_mulai')
            ->get();

        // =========================
        // JAM SEKARANG
        // =========================
        $now = Carbon::now()->format('H:i:s');

        // =========================
        // DETEKSI JADWAL AKTIF
        // =========================
        foreach ($jadwalHariIni as $jadwal) {
            $jadwal->is_active =
                $now >= $jadwal->jam_mulai &&
                $now <= $jadwal->jam_selesai;

            // countdown ke mulai
            $jadwal->countdown = Carbon::parse($jadwal->jam_mulai)
                ->diffForHumans();
        }

        // =========================
        // STATISTIK
        // =========================
        $totalJadwal = Jadwal::where('guru_id', $guruId)->count();

        $absensiBulanIni = Absensi::where('user_id', $guruId)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->count();

        $terlambat = Absensi::where('user_id', $guruId)
            ->where('status_masuk', 'terlambat')
            ->count();

        $tepatWaktu = Absensi::where('user_id', $guruId)
            ->where('status_masuk', 'tepat_waktu')
            ->count();

        return view('guru.dashboard', compact(
            'jadwalHariIni',
            'totalJadwal',
            'absensiBulanIni',
            'terlambat',
            'tepatWaktu'
        ));
    }
}
