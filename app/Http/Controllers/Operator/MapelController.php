<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;

class MapelController extends Controller
{
    public function index()
    {
        $mapel = MataPelajaran::latest()->paginate(10);
        return view('operator.mapel.index', compact('mapel'));
    }

    public function create()
    {
        return view('operator.mapel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required',
            'kkm' => 'required|numeric'
        ]);

        MataPelajaran::create($request->all());

        return redirect()->route('operator.mapel.index')
            ->with('success', 'Data mapel berhasil ditambahkan');
    }

    public function edit($id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        return view('operator.mapel.edit', compact('mapel'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mapel' => 'required',
            'kkm' => 'required|numeric'
        ]);

        $mapel = MataPelajaran::findOrFail($id);
        $mapel->update($request->all());

        return redirect()->route('operator.mapel.index')
            ->with('success', 'Data mapel berhasil diupdate');
    }

    public function destroy($id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        $mapel->delete();

        return redirect()->route('operator.mapel.index')
            ->with('success', 'Data mapel berhasil dihapus');
    }
}
