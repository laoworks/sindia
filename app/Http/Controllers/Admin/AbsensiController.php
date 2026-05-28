<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    /**
     * LIST ABSENSI
     */
    public function index(Request $request)
    {
        $query = Absensi::with('user');

        // FILTER TANGGAL
        if ($request->filled('dari') && $request->filled('sampai')) {
            $query->whereBetween('tanggal', [$request->dari, $request->sampai]);
        }

        // FILTER USER (guru)
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $absensi = $query->latest()->paginate(10)->withQueryString();

        $users = User::where('role', 'guru')->orderBy('name')->get();

        return view('admin.absensi.index', compact('absensi', 'users'));
    }

    /**
     * DETAIL ABSENSI
     */
    public function show(Absensi $absensi)
    {
        return view('admin.absensi.show', [
            'absensi' => $absensi->load('user')
        ]);
    }

    /**
     * DELETE ABSENSI
     */
    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);

        // optional: hapus foto kalau ada
        if ($absensi->foto_masuk) {
            Storage::disk('public')->delete($absensi->foto_masuk);
        }

        if ($absensi->foto_pulang) {
            Storage::disk('public')->delete($absensi->foto_pulang);
        }

        $absensi->delete();

        return redirect()
            ->route('admin.absensi.index')
            ->with('success', 'Data absensi berhasil dihapus');
    }

    /**
     * EXPORT EXCEL
     */
    public function export(Request $request)
    {
        $query = Absensi::with('user');

        // FILTER TANGGAL
        if ($request->filled('dari') && $request->filled('sampai')) {
            $query->whereBetween('tanggal', [$request->dari, $request->sampai]);
        }

        // FILTER USER
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $data = $query->latest()->get();

        return Excel::download(
            new AbsensiExport($data),
            'laporan-absensi.xlsx'
        );
    }
}
