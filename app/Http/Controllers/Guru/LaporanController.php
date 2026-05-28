<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    //
    public function index()
    {
        $laporan = Absensi::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('guru.laporan', compact('laporan'));
    }
}
