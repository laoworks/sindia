<?php

namespace App\Http\Controllers\Operator;

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

        if ($request->hari) {
            $query->where('hari', $request->hari);
        }

        return view('operator.jadwal.index', [
            'jadwal' => $query->latest()->paginate(10)->withQueryString()
        ]);
    }

    public function create()
    {
        return view('operator.jadwal.create', [
            'guru' => User::where('role', 'guru')->get(),
            'kelas' => Kelas::all(),
            'mapel' => MataPelajaran::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:users,id',
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mata_pelajaran,id',
            'hari' => 'required|string|max:20',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        Jadwal::create([
            'guru_id' => $request->guru_id,
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()
            ->route('operator.jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('operator.jadwal.edit', [
            'jadwal' => Jadwal::findOrFail($id),
            'guru' => User::where('role', 'guru')->get(),
            'kelas' => Kelas::all(),
            'mapel' => MataPelajaran::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'guru_id' => 'required|exists:users,id',
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mata_pelajaran,id',
            'hari' => 'required|string|max:20',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $jadwal->update([
            'guru_id' => $request->guru_id,
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()
            ->route('operator.jadwal.index')
            ->with('success', 'Jadwal berhasil diupdate');
    }

    public function destroy($id)
    {
        Jadwal::findOrFail($id)->delete();

        return back()->with('success', 'Jadwal berhasil dihapus');
    }
}
