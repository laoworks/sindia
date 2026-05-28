<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::latest()->paginate(10);

        return view('operator.kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('operator.kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'jurusan' => 'required',
        ]);

        Kelas::create($request->all());

        return redirect()->route('operator.kelas.index')
            ->with('success', 'Kelas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);

        return view('operator.kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('operator.kelas.index')
            ->with('success', 'Kelas berhasil diupdate');
    }

    public function destroy($id)
    {
        Kelas::findOrFail($id)->delete();

        return back()->with('success', 'Kelas berhasil dihapus');
    }
}
