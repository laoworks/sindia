<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();

        $totalGuru = User::where('role', 'guru')->count();
        $guruAktif = User::where('role', 'guru')->where('is_active', true)->count();
        $absensiHariIni = Absensi::whereDate('tanggal', $today)->count();
        $terlambatHariIni = Absensi::whereDate('tanggal', $today)
            ->where('status_masuk', 'terlambat')
            ->count();
        $jadwalHariIni = Jadwal::where('hari', $today->locale('id')->translatedFormat('l'))->count();

        $ringkasanMingguan = collect(range(6, 0))->map(function ($daysAgo) {
            $date = Carbon::today()->subDays($daysAgo);

            return [
                'label' => $date->translatedFormat('d M'),
                'hadir' => Absensi::whereDate('tanggal', $date)->count(),
                'terlambat' => Absensi::whereDate('tanggal', $date)
                    ->where('status_masuk', 'terlambat')
                    ->count(),
            ];
        })->push([
            'label' => $today->translatedFormat('d M'),
            'hadir' => Absensi::whereDate('tanggal', $today)->count(),
            'terlambat' => Absensi::whereDate('tanggal', $today)
                ->where('status_masuk', 'terlambat')
                ->count(),
        ]);

        $laporanTerbaru = Absensi::with('user')
            ->whereDate('tanggal', '>=', $startOfMonth)
            ->latest('tanggal')
            ->latest('waktu_masuk')
            ->take(5)
            ->get();

        return view('kepala.dashboard', compact(
            'totalGuru',
            'guruAktif',
            'absensiHariIni',
            'terlambatHariIni',
            'jadwalHariIni',
            'ringkasanMingguan',
            'laporanTerbaru'
        ));
    }
}
