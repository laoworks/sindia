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
            'jadwal' => $query->paginate(10)
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
        Jadwal::create($request->all());

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
        $jadwal->update($request->all());

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
