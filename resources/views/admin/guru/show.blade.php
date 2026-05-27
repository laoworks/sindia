@extends('layouts.admin')

@section('content')

<div class="max-w-4xl mx-auto">

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
            Detail Guru
        </h1>
        <p class="text-gray-500 text-sm mt-2">
            Informasi lengkap data guru
        </p>
    </div>

    <!-- CARD -->
    <div class="bg-white border rounded-3xl p-6">

        <!-- TOP -->
        <div class="flex items-center gap-4 mb-6">

            <!-- Avatar -->
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-white text-xl font-bold"
                 style="background: oklch(45.7% 0.24 277.023)">

                {{ strtoupper(substr($guru->name, 0, 1)) }}

            </div>

            <!-- Nama + Role -->
            <div>
                <h2 class="text-xl font-bold text-gray-900">
                    {{ $guru->name }}
                </h2>

                <p class="text-sm text-gray-500">
                    Guru
                </p>
            </div>

        </div>

        <!-- DETAIL -->
        <div class="space-y-4">

            <div>
                <p class="text-gray-500 text-sm">Nama</p>
                <p class="font-semibold text-lg">{{ $guru->name }}</p>
            </div>

            <div>
                <p class="text-gray-500 text-sm">Email</p>
                <p class="font-semibold">{{ $guru->email }}</p>
            </div>

            <div>
                <p class="text-gray-500 text-sm">NIP</p>
                <p class="font-semibold">{{ $guru->nip ?? '-' }}</p>
            </div>

            <div>
                <p class="text-gray-500 text-sm">Role</p>
                <p class="font-semibold">Guru</p>
            </div>

            <div>
                <p class="text-gray-500 text-sm">Status</p>

                @if($guru->is_active)
                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 border border-green-200">
                        Aktif
                    </span>
                @else
                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700 border border-red-200">
                        Nonaktif
                    </span>
                @endif

            </div>

        </div>

        <!-- BACK BUTTON -->
        <div class="mt-6">
            <a href="{{ route('admin.guru.index') }}"
               class="inline-flex px-4 py-2 rounded-xl text-white text-sm font-semibold"
               style="background: oklch(45.7% 0.24 277.023)">
                Kembali
            </a>
        </div>

    </div>

</div>

@endsection
