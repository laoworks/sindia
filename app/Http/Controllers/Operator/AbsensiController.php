<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $query = Absensi::with('user')
            ->orderBy('tanggal', 'desc');

        // filter tanggal (optional)
        if ($request->tanggal) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // filter user (optional)
        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        $absensi = $query->paginate(20)->withQueryString();
        $users = User::where('role', 'guru')->orderBy('name')->get();

        return view('operator.absensi.index', compact('absensi', 'users'));
    }

    public function show($id)
    {
        $absensi = Absensi::with('user')->findOrFail($id);

        return view('operator.absensi.show', compact('absensi'));
    }

    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();

        return back()->with('success', 'Data absensi berhasil dihapus');
    }
}
