@extends('layouts.operator')

@section('content')

<div class="max-w-5xl mx-auto bg-white p-6 rounded-2xl shadow-sm border border-gray-100">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            Detail Absensi
        </h1>

        <a href="{{ route('operator.absensi.index') }}"
           class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-gray-700">
            Kembali
        </a>
    </div>

    <!-- DATA -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <p class="text-sm text-gray-500">Nama Guru</p>
            <p class="text-lg font-semibold text-gray-900">
                {{ $absensi->user->name ?? '-' }}
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Tanggal</p>
            <p class="text-lg font-semibold text-gray-900">
                {{ \Carbon\Carbon::parse($absensi->tanggal)->translatedFormat('d F Y') }}
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Waktu Masuk</p>
            <p class="text-lg font-semibold text-gray-900">
                {{ $absensi->waktu_masuk ?? '-' }}
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Waktu Pulang</p>
            <p class="text-lg font-semibold text-gray-900">
                {{ $absensi->waktu_pulang ?? '-' }}
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Status Masuk</p>
            <span class="px-3 py-1 rounded-full text-sm font-medium
                {{ $absensi->status_masuk == 'terlambat'
                    ? 'bg-red-100 text-red-600'
                    : 'bg-green-100 text-green-600' }}">
                {{ ucfirst($absensi->status_masuk ?? '-') }}
            </span>
        </div>

        <div>
            <p class="text-sm text-gray-500">Status Pulang</p>
            <span class="px-3 py-1 rounded-full text-sm font-medium
                {{ $absensi->status_pulang == 'lebih_awal'
                    ? 'bg-yellow-100 text-yellow-600'
                    : 'bg-green-100 text-green-600' }}">
                {{ ucfirst($absensi->status_pulang ?? '-') }}
            </span>
        </div>

    </div>

    <!-- FOTO -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <p class="text-sm text-gray-500 mb-2">Foto Masuk</p>

            @if($absensi->foto_masuk)
                <img src="{{ asset('storage/' . $absensi->foto_masuk) }}"
                     class="rounded-xl border w-full">
            @else
                <p class="text-gray-400">Tidak ada foto</p>
            @endif
        </div>

        <div>
            <p class="text-sm text-gray-500 mb-2">Foto Pulang</p>

            @if($absensi->foto_pulang)
                <img src="{{ asset('storage/' . $absensi->foto_pulang) }}"
                     class="rounded-xl border w-full">
            @else
                <p class="text-gray-400">Tidak ada foto</p>
            @endif
        </div>

    </div>

</div>

@endsection
