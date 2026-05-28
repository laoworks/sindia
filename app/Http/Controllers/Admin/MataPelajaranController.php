<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mapel = MataPelajaran::latest()->paginate(10);

        return view('admin.mapel.index', compact('mapel'));
    }

    public function create()
    {
        return view('admin.mapel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'kkm' => 'required|integer|min:0|max:100',
        ]);

        MataPelajaran::create([
            'nama_mapel' => $request->nama_mapel,
            'kkm' => $request->kkm,
        ]);

        return redirect()->route('admin.mapel.index')->with([
            'title' => 'Berhasil',
            'message' => 'Mata pelajaran berhasil ditambahkan',
            'icon' => 'success'
        ]);
    }

    public function show(MataPelajaran $mapel)
    {
        return view('admin.mapel.show', compact('mapel'));
    }

    public function edit(MataPelajaran $mapel)
    {
        return view('admin.mapel.edit', compact('mapel'));
    }

    public function update(Request $request, MataPelajaran $mapel)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'kkm' => 'required|integer|min:0|max:100',
        ]);

        $mapel->update([
            'nama_mapel' => $request->nama_mapel,
            'kkm' => $request->kkm,
        ]);

        return redirect()->route('admin.mapel.index')->with([
            'title' => 'Berhasil',
            'message' => 'Mata pelajaran berhasil diupdate',
            'icon' => 'success'
        ]);
    }

    public function destroy(MataPelajaran $mapel)
    {
        $mapel->delete();

        return redirect()->route('admin.mapel.index')->with([
            'title' => 'Berhasil',
            'message' => 'Mata pelajaran berhasil dihapus',
            'icon' => 'success'
        ]);
    }
}
