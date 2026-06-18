<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // LIVE SEARCH
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(10);

        // agar pagination tetap bawa search
        $users->appends($request->all());

        // AJAX response
        if ($request->ajax()) {
            return view('admin.users.partials.table', compact('users'))->render();
        }

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'nip'         => 'nullable|unique:users,nip',
            'role'        => 'required|in:admin,guru,operator,kepala_sekolah',
            'password'    => 'required|min:6|confirmed',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = null;

        if ($request->hasFile('foto_profil')) {
            $foto = $request->file('foto_profil')
                ->store('foto-profil', 'public');
        }

        User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'nip'         => $request->nip,
            'role'        => $request->role,
            'password'    => Hash::make($request->password),
            'foto_profil' => $foto,
            'is_active'   => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.users.index')
            ->with([
                'title'   => 'Berhasil',
                'message' => 'User "' . $request->name . '" berhasil ditambahkan',
                'icon'    => 'success',
            ]);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email,' . $user->id,
            'nip'         => 'nullable|unique:users,nip,' . $user->id,
            'role'        => 'required|in:admin,guru,operator,kepala_sekolah',
            'password'    => 'nullable|min:6|confirmed',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = $user->foto_profil;

        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            $foto = $request->file('foto_profil')
                ->store('foto-profil', 'public');
        }

        $user->update([
            'name'        => $request->name,
            'email'       => $request->email,
            'nip'         => $request->nip,
            'role'        => $request->role,
            'foto_profil' => $foto,
            'is_active'   => $request->has('is_active') ? 1 : 0,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with([
                'title'   => 'Berhasil',
                'message' => 'User "' . $request->name . '" berhasil diupdate',
                'icon'    => 'success',
            ]);
    }

    public function destroy(User $user)
    {
        $nama = $user->name;

        if ($user->foto_profil) {
            Storage::disk('public')->delete($user->foto_profil);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with([
                'title'   => 'Berhasil',
                'message' => 'User "' . $nama . '" berhasil dihapus',
                'icon'    => 'success',
            ]);
    }
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
    public function guruIndex()
    {
        $gurus = User::where('role', 'guru')
            ->latest()
            ->paginate(10);

        return view('admin.guru.index', compact('gurus'));
    }

    public function guruShow(User $user)
    {
        if ($user->role !== 'guru') {
            abort(404);
        }

        return view('admin.guru.show', compact('user'));
    }
}
