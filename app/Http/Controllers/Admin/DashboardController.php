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
        Carbon::setLocale('id');

        $today = Carbon::today();
        $hariIni = $today->translatedFormat('l');

        $totalGuru = User::where('role', 'guru')->count();
        $totalGuruAktif = User::where('role', 'guru')
            ->where('is_active', true)
            ->count();
        $totalOperator = User::where('role', 'operator')->count();
        $totalMapel = MataPelajaran::count();
        $totalJadwal = Jadwal::count();
        $totalKelas = Kelas::count();

        $absensiHariIni = Absensi::whereDate('tanggal', $today)->count();

        $terlambatHariIni = Absensi::whereDate('tanggal', $today)
            ->where('status_masuk', 'terlambat')
            ->count();

        $belumAbsenHariIni = max($totalGuruAktif - $absensiHariIni, 0);
        $persentaseKehadiran = $totalGuruAktif > 0
            ? (int) round(($absensiHariIni / $totalGuruAktif) * 100)
            : 0;

        $ringkasanAbsensi = collect(range(6, 0))->map(function ($daysAgo) {
            $date = Carbon::today()->subDays($daysAgo);
            $total = Absensi::whereDate('tanggal', $date)->count();
            $terlambat = Absensi::whereDate('tanggal', $date)
                ->where('status_masuk', 'terlambat')
                ->count();

            return [
                'tanggal' => $date,
                'label' => $date->translatedFormat('d M'),
                'total' => $total,
                'terlambat' => $terlambat,
                'tepat_waktu' => max($total - $terlambat, 0),
            ];
        });

        $jadwalHariIni = Jadwal::with(['guru', 'kelas', 'mapel'])
            ->where('hari', $hariIni)
            ->orderBy('jam_mulai')
            ->take(5)
            ->get();

        $absensiTerbaru = Absensi::with('user')
            ->latest('tanggal')
            ->latest('waktu_masuk')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalGuru',
            'totalGuruAktif',
            'totalOperator',
            'totalMapel',
            'totalJadwal',
            'totalKelas',
            'absensiHariIni',
            'terlambatHariIni',
            'belumAbsenHariIni',
            'persentaseKehadiran',
            'ringkasanAbsensi',
            'jadwalHariIni',
            'absensiTerbaru'
        ));
    }
}
