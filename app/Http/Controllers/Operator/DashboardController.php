<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Jadwal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $guru = User::where('role', 'guru')->count();
        $kelas = Kelas::count();
        $mapel = MataPelajaran::count();
        $jadwal = Jadwal::count();

        // ABSENSI 7 HARI TERAKHIR
        $data = Absensi::select(
            DB::raw('DATE(tanggal) as tanggal'),
            DB::raw('COUNT(*) as total')
        )
            ->where('tanggal', '>=', Carbon::now()->subDays(6))
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->get();

        $labels = [];
        $values = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = Carbon::now()->subDays($i)->format('Y-m-d');

            $labels[] = $date;

            $found = $data->firstWhere('tanggal', $date);

            $values[] = $found ? $found->total : 0;
        }

        return view('operator.dashboard', compact(
            'guru',
            'kelas',
            'mapel',
            'jadwal',
            'labels',
            'values'
        ));
    }
}
