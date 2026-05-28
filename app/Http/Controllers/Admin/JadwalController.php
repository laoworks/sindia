<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = Jadwal::with(['guru', 'kelas', 'mapel']);

        // LIVE SEARCH (SAMA PERSIS USER)
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->whereHas('guru', function ($g) use ($search) {
                    $g->where('name', 'like', "%{$search}%");
                })
                    ->orWhereHas('kelas', function ($k) use ($search) {
                        $k->where('nama_kelas', 'like', "%{$search}%");
                    })
                    ->orWhereHas('mapel', function ($m) use ($search) {
                        $m->where('nama_mapel', 'like', "%{$search}%");
                    })
                    ->orWhere('hari', 'like', "%{$search}%");
            });
        }

        $jadwal = $query->latest()->paginate(10);

        // agar pagination bawa search
        $jadwal->appends($request->all());

        return view('admin.jadwal.index', compact('jadwal'));
    }

    // ✅ REALTIME SEARCH FIX (PENTING)
    public function search(Request $request)
    {
        $query = $request->get('query');

        $data = Jadwal::with(['guru', 'kelas', 'mapel'])
            ->when($query, function ($q) use ($query) {
                $q->whereHas('guru', fn($g) =>
                $g->where('name', 'like', "%$query%"))
                    ->orWhereHas('kelas', fn($k) =>
                    $k->where('nama_kelas', 'like', "%$query%"))
                    ->orWhereHas('mapel', fn($m) =>
                    $m->where('nama_mapel', 'like', "%$query%"))
                    ->orWhere('hari', 'like', "%$query%");
            })
            ->latest()
            ->get();

        return response()->json($data);
    }

    public function create()
    {
        return view('admin.jadwal.create', [
            'guru' => User::where('role', 'guru')->get(),
            'kelas' => Kelas::all(),
            'mapel' => MataPelajaran::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required',
            'kelas_id' => 'required',
            'mapel_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('admin.jadwal.index')
            ->with([
                'title' => 'Berhasil',
                'message' => 'Jadwal berhasil ditambahkan',
                'icon' => 'success'
            ]);
    }

    public function show(Jadwal $jadwal)
    {
        $jadwal->load(['guru', 'kelas', 'mapel']);
        return view('admin.jadwal.show', compact('jadwal'));
    }

    public function edit(Jadwal $jadwal)
    {
        return view('admin.jadwal.edit', [
            'jadwal' => $jadwal,
            'guru' => User::where('role', 'guru')->get(),
            'kelas' => Kelas::all(),
            'mapel' => MataPelajaran::all(),
        ]);
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')
            ->with([
                'title' => 'Berhasil',
                'message' => 'Jadwal berhasil diupdate',
                'icon' => 'success'
            ]);
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')
            ->with([
                'title' => 'Berhasil',
                'message' => 'Jadwal berhasil dihapus',
                'icon' => 'success'
            ]);
    }
}
