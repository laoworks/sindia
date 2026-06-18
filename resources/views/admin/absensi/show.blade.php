@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                Detail Absensi
            </h1>
            <p class="text-sm text-gray-500 mt-2">
                Informasi lengkap kehadiran guru pada tanggal tertentu.
            </p>
        </div>

        <div class="bg-white border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100" style="background: oklch(97% 0.01 286)">
                <h2 class="text-lg font-semibold text-gray-900">{{ $absensi->user->name ?? '-' }}</h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ optional($absensi->tanggal)->translatedFormat('d F Y') ?? '-' }}
                </p>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">Guru</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $absensi->user->name ?? '-' }}</p>
                    </div>

                    <div class="border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">Tanggal</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">
                            {{ optional($absensi->tanggal)->translatedFormat('d F Y') ?? '-' }}</p>
                    </div>

                    <div class="border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">Jam Masuk</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">
                            {{ optional($absensi->waktu_masuk)->format('H:i') ?? '-' }}</p>
                    </div>

                    <div class="border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">Jam Pulang</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">
                            {{ optional($absensi->waktu_pulang)->format('H:i') ?? '-' }}</p>
                    </div>

                    <div class="border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">Status Masuk</p>
                        <div class="mt-2">
                            @if ($absensi->status_masuk === 'terlambat')
                                <span class="px-3 py-1 text-xs bg-red-100 text-red-700">Terlambat</span>
                            @elseif($absensi->status_masuk === 'tepat_waktu')
                                <span class="px-3 py-1 text-xs bg-green-100 text-green-700">Tepat Waktu</span>
                            @else
                                <span class="px-3 py-1 text-xs bg-gray-100 text-gray-600">-</span>
                            @endif
                        </div>
                    </div>

                    <div class="border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">Status Pulang</p>
                        <div class="mt-2">
                            @if ($absensi->status_pulang === 'lebih_awal')
                                <span class="px-3 py-1 text-xs bg-yellow-100 text-yellow-700">Lebih Awal</span>
                            @elseif($absensi->status_pulang === 'tepat_waktu')
                                <span class="px-3 py-1 text-xs bg-green-100 text-green-700">Tepat Waktu</span>
                            @else
                                <span class="px-3 py-1 text-xs bg-gray-100 text-gray-600">Belum Pulang</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500 mb-2">Foto Masuk</p>
                        @if ($absensi->foto_masuk)
                            <img src="{{ asset('storage/' . $absensi->foto_masuk) }}"
                                class="w-full max-w-sm border border-gray-200">
                        @else
                            <div class="border border-dashed border-gray-200 px-4 py-10 text-center text-sm text-gray-400">
                                Tidak ada foto masuk
                            </div>
                        @endif
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 mb-2">Foto Pulang</p>
                        @if ($absensi->foto_pulang)
                            <img src="{{ asset('storage/' . $absensi->foto_pulang) }}"
                                class="w-full max-w-sm border border-gray-200">
                        @else
                            <div class="border border-dashed border-gray-200 px-4 py-10 text-center text-sm text-gray-400">
                                Tidak ada foto pulang
                            </div>
                        @endif
                    </div>
                </div>

                <div class="pt-8 flex justify-end">
                    <a href="{{ route('admin.absensi.index') }}"
                        class="px-5 py-3 border text-gray-600 hover:bg-gray-50 inline-block">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
