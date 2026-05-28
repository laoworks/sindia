<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::latest()->paginate(10);
        return view('admin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('admin.kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'jurusan'    => 'required|string|max:255',
        ]);

        Kelas::create($request->all());

        return redirect()->route('admin.kelas.index')
            ->with([
                'title' => 'Berhasil Ditambahkan',
                'message' => 'Data kelas berhasil ditambahkan',
                'icon' => 'success',
            ]);
    }

    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('admin.kelas.show', compact('kelas'));
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('admin.kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'jurusan'    => 'required|string|max:255',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());

        return redirect()->route('admin.kelas.index')
            ->with([
                'title' => 'Berhasil Diupdate',
                'message' => 'Data kelas berhasil diupdate',
                'icon' => 'success',
            ]);
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('admin.kelas.index')
            ->with([
                'title' => 'Berhasil Dihapus',
                'message' => 'Data kelas berhasil dihapus',
                'icon' => 'success',
            ]);
    }
}
