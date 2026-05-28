<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index()
    {
        return view('operator.guru.index', [
            'guru' => User::where('role', 'guru')->paginate(10)
        ]);
    }

    public function create()
    {
        return view('operator.guru.create');
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nip' => $request->nip,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);

        return redirect()
            ->route('operator.guru.index')
            ->with('success', 'Guru berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('operator.guru.edit', [
            'guru' => User::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $guru = User::findOrFail($id);

        $guru->update([
            'name' => $request->name,
            'email' => $request->email,
            'nip' => $request->nip,
        ]);

        return redirect()
            ->route('operator.guru.index')
            ->with('success', 'Guru berhasil diupdate');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return back()->with('success', 'Guru berhasil dihapus');
    }
}
