<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class GuruController extends Controller
{
    public function index()
    {
        return view('operator.guru.index', [
            'guru' => User::where('role', 'guru')->latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('operator.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'nip' => 'nullable|string|max:255|unique:users,nip',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nip' => $request->nip,
            'password' => Hash::make($request->password),
            'role' => 'guru',
            'is_active' => true,
        ]);

        return redirect()
            ->route('operator.guru.index')
            ->with('success', 'Guru berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('operator.guru.edit', [
            'guru' => User::where('role', 'guru')->findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $guru = User::where('role', 'guru')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($guru->id),
            ],
            'nip' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('users', 'nip')->ignore($guru->id),
            ],
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $guru->update([
            'name' => $request->name,
            'email' => $request->email,
            'nip' => $request->nip,
        ]);

        if ($request->filled('password')) {
            $guru->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()
            ->route('operator.guru.index')
            ->with('success', 'Guru berhasil diupdate');
    }

    public function destroy($id)
    {
        User::where('role', 'guru')->findOrFail($id)->delete();

        return back()->with('success', 'Guru berhasil dihapus');
    }
}
