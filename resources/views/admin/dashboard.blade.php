@extends('layouts.admin')

@section('content')

@php
    $user = auth()->user();
@endphp

<!-- HEADER -->
<div class="mb-6">
    <h1 class="text-3xl font-bold">
        Dashboard Admin
    </h1>

    <p class="text-gray-500">
        Selamat datang, {{ $user->name }}
    </p>
</div>

<!-- KPI CARDS -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">

    <div class="bg-white rounded-2xl shadow p-6">
        <p class="text-sm text-gray-500">Total Guru</p>
        <h2 class="text-3xl font-bold mt-2">
            {{ $totalGuru }}
        </h2>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <p class="text-sm text-gray-500">Total Mapel</p>
        <h2 class="text-3xl font-bold mt-2">
            {{ $totalMapel }}
        </h2>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <p class="text-sm text-gray-500">Jadwal Mengajar</p>
        <h2 class="text-3xl font-bold mt-2">
            {{ $totalJadwal }}
        </h2>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <p class="text-sm text-gray-500">Absensi Hari Ini</p>
        <h2 class="text-3xl font-bold mt-2">
            {{ $absensiHariIni }}
        </h2>
    </div>

</div>

<!-- SECOND ROW -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

    <div class="bg-white rounded-2xl shadow p-6">
        <p class="text-sm text-gray-500">Guru Terlambat Hari Ini</p>
        <h2 class="text-3xl font-bold mt-2 text-red-500">
            {{ $terlambatHariIni }}
        </h2>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <p class="text-sm text-gray-500">Status Sistem</p>
        <h2 class="text-xl font-bold mt-2 text-green-600">
            Aktif
        </h2>
    </div>

</div>

<!-- ABSENSI 7 HARI -->
<div class="bg-white rounded-2xl shadow p-6 mt-6">

    <h3 class="text-lg font-bold mb-4">
        Absensi 7 Hari Terakhir
    </h3>

    <div class="space-y-2">

        @forelse($absensi7Hari as $data)
            <div class="flex justify-between border-b py-2">
                <span class="text-gray-600">
                    {{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y') }}
                </span>

                <span class="font-bold text-gray-800">
                    {{ $data->total }}
                </span>
            </div>
        @empty
            <p class="text-gray-500 text-sm">
                Tidak ada data absensi
            </p>
        @endforelse

    </div>

</div>

@endsection
