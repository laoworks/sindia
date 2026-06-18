@extends('layouts.guru')

@section('content')
    <div class="space-y-8">

        <!-- HEADER -->
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                    Dashboard Guru
                </h1>

                <p class="mt-2 text-gray-500">
                    Selamat datang kembali,
                    <span class="font-semibold text-gray-700">
                        {{ auth()->user()->name }}
                    </span>
                </p>

            </div>

            <!-- DATE -->
            <div class="px-5 py-4 bg-white border border-gray-100 rounded-lg shadow-sm">

                <p class="text-sm text-gray-500">
                    Hari Ini
                </p>

                <h2 class="text-lg font-bold" style="color: oklch(45.7% 0.24 277.023)">
                    {{ now()->translatedFormat('l, d F Y') }}
                </h2>

            </div>

        </div>

        <!-- STATISTIC -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

            <!-- TOTAL JADWAL -->
            <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">

                <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-lg" style="background: oklch(87% 0.065 274.039)">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" style="color: oklch(45.7% 0.24 277.023)">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                    </svg>

                </div>

                <p class="text-sm text-gray-500">
                    Total Jadwal
                </p>

                <h2 class="mt-2 text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                    {{ $totalJadwal }}
                </h2>

            </div>

            <!-- ABSENSI -->
            <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">

                <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-lg" style="background: oklch(87% 0.065 274.039)">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" style="color: oklch(45.7% 0.24 277.023)">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                    </svg>

                </div>

                <p class="text-sm text-gray-500">
                    Absensi Bulan Ini
                </p>

                <h2 class="mt-2 text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                    {{ $absensiBulanIni }}
                </h2>

            </div>

            <!-- TERLAMBAT -->
            <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">

                <div class="flex items-center justify-center w-12 h-12 mb-4 bg-red-100 rounded-lg">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                </div>

                <p class="text-sm text-gray-500">
                    Terlambat
                </p>

                <h2 class="mt-2 text-3xl font-bold text-red-500">
                    {{ $terlambat }}
                </h2>

            </div>

            <!-- TEPAT WAKTU -->
            <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">

                <div class="flex items-center justify-center w-12 h-12 mb-4 bg-green-100 rounded-lg">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>

                </div>

                <p class="text-sm text-gray-500">
                    Tepat Waktu
                </p>

                <h2 class="mt-2 text-3xl font-bold text-green-500">
                    {{ $tepatWaktu }}
                </h2>

            </div>

        </div>

        <!-- JADWAL HARI INI -->
        <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-xl">

            <!-- HEADER -->
            <div class="flex flex-col gap-3 px-6 py-5 border-b border-gray-100 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <h2 class="text-xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                        Jadwal Hari Ini
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Jadwal mengajar guru hari ini
                    </p>

                </div>

                <div class="px-4 py-2 text-sm font-semibold text-center rounded-lg"
                    style="background: oklch(87% 0.065 274.039); color: oklch(45.7% 0.24 277.023)">

                    {{ $jadwalHariIni->count() }} Jadwal

                </div>

            </div>

            <!-- CONTENT -->
            <div class="divide-y divide-gray-100">

                @forelse($jadwalHariIni as $jadwal)
                    <div
                        class="flex flex-col gap-3 px-4 py-4 transition duration-200 sm:px-6 sm:py-5 sm:flex-row sm:items-center sm:justify-between hover:bg-gray-50">

                        <!-- LEFT -->
                        <div class="flex items-center gap-3">

                            <div class="flex items-center justify-center w-10 h-10 text-sm font-bold rounded-lg sm:w-12 sm:h-12"
                                style="background: oklch(87% 0.065 274.039); color: oklch(45.7% 0.24 277.023)">

                                {{ strtoupper(substr($jadwal->mapel->nama_mapel ?? 'M', 0, 1)) }}

                            </div>

                            <div>

                                <h3 class="text-sm font-bold text-gray-800 sm:text-base">
                                    {{ $jadwal->mapel->nama_mapel ?? '-' }}
                                </h3>

                                <p class="text-sm text-gray-500 mt-0.5">
                                    {{ $jadwal->kelas->nama_kelas ?? '-' }}
                                </p>

                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="flex flex-wrap items-center gap-2 sm:gap-3">

                            <div class="px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm font-medium bg-gray-100 text-gray-700 rounded-lg">

                                {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}

                            </div>

                            @if ($jadwal->is_active)
                                <span class="px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm font-semibold bg-green-100 text-green-700 rounded-lg">
                                    Sedang Berlangsung
                                </span>
                            @else
                                <span class="px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm font-semibold bg-gray-100 text-gray-600 rounded-lg">
                                    {{ $jadwal->countdown }}
                                </span>
                            @endif

                        </div>

                    </div>

                @empty

                    <div class="px-6 py-16 text-center">

                        <div class="flex items-center justify-center w-20 h-20 mx-auto mb-4 rounded-full"
                            style="background: oklch(95% 0.02 274)">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" style="color: oklch(45.7% 0.24 277.023)">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                            </svg>

                        </div>

                        <h3 class="text-lg font-semibold text-gray-700">
                            Tidak Ada Jadwal Hari Ini
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            Jadwal mengajar belum tersedia untuk hari ini
                        </p>

                    </div>
                @endforelse

            </div>

        </div>

    </div>
@endsection
