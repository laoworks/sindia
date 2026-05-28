<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // =========================
        // TOTAL DATA
        // =========================
        $totalGuru = User::where('role', 'guru')->count();
        $totalMapel = MataPelajaran::count();
        $totalJadwal = Jadwal::count();
        $totalKelas = Kelas::count();

        // =========================
        // ABSENSI HARI INI
        // =========================
        $absensiHariIni = Absensi::whereDate('tanggal', now())->count();

        $terlambatHariIni = Absensi::whereDate('tanggal', now())
            ->where('status_masuk', 'terlambat')
            ->count();

        $guruTerlambat = $terlambatHariIni;

        // =========================
        // CHART 7 HARI (LINE & BAR)
        // =========================
        $labels = [];
        $dataHadir = [];
        $dataTerlambat = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = Carbon::now()->subDays($i);

            $labels[] = $date->format('d M');

            $dataHadir[] = Absensi::whereDate('tanggal', $date)->count();

            $dataTerlambat[] = Absensi::whereDate('tanggal', $date)
                ->where('status_masuk', 'terlambat')
                ->count();
        }

        // =========================
        // LIST 7 HARI ABSENSI (FIX ERROR KAMU)
        // =========================
        $absensi7Hari = Absensi::selectRaw('tanggal, COUNT(*) as total')
            ->whereBetween('tanggal', [
                Carbon::now()->subDays(6)->toDateString(),
                Carbon::now()->toDateString()
            ])
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'desc')
            ->get();

        // =========================
        // RETURN VIEW
        // =========================
        return view('admin.dashboard', compact(
            'totalGuru',
            'totalMapel',
            'totalJadwal',
            'totalKelas',
            'absensiHariIni',
            'terlambatHariIni',
            'guruTerlambat',
            'labels',
            'dataHadir',
            'dataTerlambat',
            'absensi7Hari'
        ));
    }
}
