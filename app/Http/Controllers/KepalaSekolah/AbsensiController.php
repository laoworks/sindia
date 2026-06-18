<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id');

        $query = Absensi::with('user')
            ->whereHas('user', fn ($user) => $user->where('role', 'guru'));

        if ($request->filled('dari')) {
            $query->whereDate('tanggal', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->whereDate('tanggal', '<=', $request->sampai);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('status_masuk')) {
            $query->where('status_masuk', $request->status_masuk);
        }

        $summaryQuery = clone $query;

        $absensi = $query
            ->latest('tanggal')
            ->latest('waktu_masuk')
            ->paginate(10)
            ->withQueryString();

        $totalData = (clone $summaryQuery)->count();
        $tepatWaktu = (clone $summaryQuery)->where('status_masuk', 'tepat_waktu')->count();
        $terlambat = (clone $summaryQuery)->where('status_masuk', 'terlambat')->count();
        $belumPulang = (clone $summaryQuery)->whereNull('waktu_pulang')->count();

        $users = User::where('role', 'guru')
            ->orderBy('name')
            ->get();

        return view('kepala.absensi.index', compact(
            'absensi',
            'users',
            'totalData',
            'tepatWaktu',
            'terlambat',
            'belumPulang'
        ));
    }
}
