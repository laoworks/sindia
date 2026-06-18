<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Carbon\Carbon;
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
        // =========================
        // VALIDASI DASAR
        // =========================
        $request->validate([
            'guru_id'     => 'required|exists:users,id',
            'kelas_id'    => 'required|exists:kelas,id',
            'mapel_id'    => 'required|exists:mata_pelajaran,id',
            'hari'        => 'required|string|max:20',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
        ]);

        // =========================
        // KONVERSI JAM (CARBON)
        // =========================
        $mulai = Carbon::createFromFormat('H:i', $request->jam_mulai);
        $selesai = Carbon::createFromFormat('H:i', $request->jam_selesai);

        // =========================
        // VALIDASI LOGIKA JAM
        // =========================
        // kasus normal: jam selesai harus lebih besar
        // kasus shift malam: boleh lewat tengah malam
        if ($mulai->equalTo($selesai)) {
            return back()->withErrors([
                'jam_selesai' => 'Jam selesai tidak boleh sama dengan jam mulai'
            ])->withInput();
        }

        // OPTIONAL RULE:
        // kalau kamu TIDAK mau shift malam, aktifkan ini:
        /*
    if ($selesai->lessThanOrEqualTo($mulai)) {
        return back()->withErrors([
            'jam_selesai' => 'Jam selesai harus lebih besar dari jam mulai'
        ])->withInput();
    }
    */

        // =========================
        // SIMPAN DATA
        // =========================
        Jadwal::create([
            'guru_id'     => $request->guru_id,
            'kelas_id'    => $request->kelas_id,
            'mapel_id'    => $request->mapel_id,
            'hari'        => $request->hari,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        // =========================
        // RESPONSE
        // =========================
        return redirect()->route('admin.jadwal.index')
            ->with([
                'title'   => 'Berhasil',
                'message' => 'Jadwal berhasil ditambahkan',
                'icon'    => 'success'
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
        // =========================
        // VALIDASI DASAR
        // =========================
        $request->validate([
            'guru_id'     => 'required|exists:users,id',
            'kelas_id'    => 'required|exists:kelas,id',
            'mapel_id'    => 'required|exists:mata_pelajaran,id',
            'hari'        => 'required|string|max:20',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
        ]);

        // =========================
        // KONVERSI JAM
        // =========================
        $mulai = Carbon::createFromFormat('H:i', $request->jam_mulai);
        $selesai = Carbon::createFromFormat('H:i', $request->jam_selesai);

        // =========================
        // VALIDASI LOGIKA JAM
        // =========================

        // tidak boleh sama
        if ($mulai->equalTo($selesai)) {
            return back()->withErrors([
                'jam_selesai' => 'Jam selesai tidak boleh sama dengan jam mulai'
            ])->withInput();
        }

        // OPTIONAL (aktifkan jika tidak mau shift malam)
        /*
    if ($selesai->lessThanOrEqualTo($mulai)) {
        return back()->withErrors([
            'jam_selesai' => 'Jam selesai harus lebih besar dari jam mulai'
        ])->withInput();
    }
    */

        // =========================
        // UPDATE DATA
        // =========================
        $jadwal->update([
            'guru_id'     => $request->guru_id,
            'kelas_id'    => $request->kelas_id,
            'mapel_id'    => $request->mapel_id,
            'hari'        => $request->hari,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        // =========================
        // RESPONSE
        // =========================
        return redirect()->route('admin.jadwal.index')
            ->with([
                'title'   => 'Berhasil',
                'message' => 'Jadwal berhasil diupdate',
                'icon'    => 'success'
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
