<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'guru');

        // LIVE SEARCH
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        $gurus = $query->latest()->paginate(10);
        $gurus->appends($request->all());

        return view('admin.guru.index', compact('gurus'));
    }

    public function show($id)
    {
        $guru = User::where('role', 'guru')->findOrFail($id);

        return view('admin.guru.show', compact('guru'));
    }
}
