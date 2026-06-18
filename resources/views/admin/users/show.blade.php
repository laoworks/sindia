@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                Detail User
            </h1>

            <p class="text-sm text-gray-500 mt-2">
                Informasi lengkap user sistem
            </p>
        </div>

        <!-- Card -->
        <div class="bg-white border border-gray-100 shadow-sm p-6">

            <!-- Foto -->
            <div class="flex items-center gap-4 mb-6">

                @if ($user->foto_profil)
                    <img src="{{ asset('storage/' . $user->foto_profil) }}" class="w-20 h-20 object-cover border">
                @else
                    <div class="w-20 h-20 flex items-center justify-center text-white font-bold text-xl"
                        style="background: oklch(45.7% 0.24 277.023)">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif

                <div>
                    <h2 class="text-xl font-bold text-gray-900">
                        {{ $user->name }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        {{ $user->email }}
                    </p>
                </div>

            </div>

            <!-- Detail -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div class="p-4 border">
                    <p class="text-sm text-gray-500">NIP</p>
                    <p class="font-semibold">{{ $user->nip ?? '-' }}</p>
                </div>

                <div class="p-4 border">
                    <p class="text-sm text-gray-500">Role</p>
                    <p class="font-semibold">
                        {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                    </p>
                </div>

                <div class="p-4 border">
                    <p class="text-sm text-gray-500">Status</p>
                    <p class="font-semibold">
                        {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                    </p>
                </div>

                <div class="p-4 border">
                    <p class="text-sm text-gray-500">Dibuat</p>
                    <p class="font-semibold">
                        {{ $user->created_at->format('d M Y H:i') }}
                    </p>
                </div>

            </div>

            <!-- Button -->
            <div class="mt-6 flex gap-3">

                <a href="{{ route('admin.users.index') }}" class="px-5 py-3 border border-gray-300">
                    Kembali
                </a>

                <a href="{{ route('admin.users.edit', $user->id) }}" class="px-5 py-3 text-white"
                    style="background: oklch(45.7% 0.24 277.023)">
                    Edit User
                </a>

            </div>

        </div>

    </div>
@endsection
