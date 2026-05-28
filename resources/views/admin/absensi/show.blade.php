@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
            Detail Absensi
        </h1>
        <p class="text-sm text-gray-500 mt-2">
            Informasi lengkap kehadiran guru
        </p>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 space-y-4">

        <!-- GURU -->
        <div>
            <p class="text-sm text-gray-500">Guru</p>
            <p class="font-semibold text-gray-900">
                {{ $absensi->user->name ?? '-' }}
            </p>
        </div>

        <!-- TANGGAL -->
        <div>
            <p class="text-sm text-gray-500">Tanggal</p>
            <p class="font-semibold text-gray-900">
                {{ $absensi->tanggal }}
            </p>
        </div>

        <!-- MASUK -->
        <div>
            <p class="text-sm text-gray-500">Jam Masuk</p>
            <p class="font-semibold text-gray-900">
                {{ $absensi->waktu_masuk ?? '-' }}
            </p>
        </div>

        <!-- PULANG -->
        <div>
            <p class="text-sm text-gray-500">Jam Pulang</p>
            <p class="font-semibold text-gray-900">
                {{ $absensi->waktu_pulang ?? '-' }}
            </p>
        </div>

        <!-- STATUS MASUK -->
        <div>
            <p class="text-sm text-gray-500">Status Masuk</p>

            @if($absensi->status_masuk == 'terlambat')
                <span class="px-3 py-1 text-xs rounded-xl bg-red-100 text-red-700">
                    Terlambat
                </span>
            @else
                <span class="px-3 py-1 text-xs rounded-xl bg-green-100 text-green-700">
                    Tepat Waktu
                </span>
            @endif

        </div>

        <!-- FOTO MASUK -->
        @if($absensi->foto_masuk)
        <div>
            <p class="text-sm text-gray-500 mb-2">Foto Masuk</p>
            <img src="{{ asset('storage/' . $absensi->foto_masuk) }}"
                 class="w-40 rounded-2xl border">
        </div>
        @endif

        <!-- BACK BUTTON -->
        <div class="pt-4">
            <a href="{{ route('admin.absensi.index') }}"
               class="px-5 py-3 rounded-2xl border text-gray-600 hover:bg-gray-50 inline-block">
                Kembali
            </a>
        </div>

    </div>

</div>

@endsection
