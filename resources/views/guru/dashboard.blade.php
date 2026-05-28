@extends('layouts.guru')

@section('content')

<div class="space-y-8">

    <!-- HEADER -->
    <div
        class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4"
    >

        <div>

            <h1
                class="text-3xl font-bold"
                style="color: oklch(45.7% 0.24 277.023)"
            >
                Dashboard Guru
            </h1>

            <p class="text-gray-500 mt-2">
                Selamat datang kembali,
                <span class="font-semibold text-gray-700">
                    {{ auth()->user()->name }}
                </span>
            </p>

        </div>

        <!-- DATE -->
        <div
            class="bg-white border border-gray-100 rounded-2xl px-5 py-4 shadow-sm"
        >

            <p class="text-sm text-gray-500">
                Hari Ini
            </p>

            <h2
                class="font-bold text-lg"
                style="color: oklch(45.7% 0.24 277.023)"
            >
                {{ now()->translatedFormat('l, d F Y') }}
            </h2>

        </div>

    </div>

    <!-- STATISTIC -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        <!-- TOTAL JADWAL -->
        <div
            class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm"
        >

            <div
                class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4"
                style="background: oklch(87% 0.065 274.039)"
            >

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-6 h-6"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     style="color: oklch(45.7% 0.24 277.023)">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z"/>
                </svg>

            </div>

            <p class="text-sm text-gray-500">
                Total Jadwal
            </p>

            <h2
                class="text-3xl font-bold mt-2"
                style="color: oklch(45.7% 0.24 277.023)"
            >
                {{ $totalJadwal }}
            </h2>

        </div>

        <!-- ABSENSI -->
        <div
            class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm"
        >

            <div
                class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4"
                style="background: oklch(87% 0.065 274.039)"
            >

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-6 h-6"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     style="color: oklch(45.7% 0.24 277.023)">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                </svg>

            </div>

            <p class="text-sm text-gray-500">
                Absensi Bulan Ini
            </p>

            <h2
                class="text-3xl font-bold mt-2"
                style="color: oklch(45.7% 0.24 277.023)"
            >
                {{ $absensiBulanIni }}
            </h2>

        </div>

        <!-- TERLAMBAT -->
        <div
            class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm"
        >

            <div
                class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4 bg-red-100"
            >

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-6 h-6 text-red-500"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>

            </div>

            <p class="text-sm text-gray-500">
                Terlambat
            </p>

            <h2 class="text-3xl font-bold text-red-500 mt-2">
                {{ $terlambat }}
            </h2>

        </div>

        <!-- TEPAT WAKTU -->
        <div
            class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm"
        >

            <div
                class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4 bg-green-100"
            >

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-6 h-6 text-green-500"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5 13l4 4L19 7"/>
                </svg>

            </div>

            <p class="text-sm text-gray-500">
                Tepat Waktu
            </p>

            <h2 class="text-3xl font-bold text-green-500 mt-2">
                {{ $tepatWaktu }}
            </h2>

        </div>

    </div>

    <!-- JADWAL HARI INI -->
    <div
        class="bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden"
    >

        <!-- HEADER -->
        <div
            class="px-6 py-5 border-b border-gray-100 flex items-center justify-between"
        >

            <div>

                <h2
                    class="text-xl font-bold"
                    style="color: oklch(45.7% 0.24 277.023)"
                >
                    Jadwal Hari Ini
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Jadwal mengajar guru hari ini
                </p>

            </div>

            <div
                class="px-4 py-2 rounded-2xl text-sm font-semibold"
                style="background: oklch(87% 0.065 274.039); color: oklch(45.7% 0.24 277.023)"
            >

                {{ $jadwalHariIni->count() }} Jadwal

            </div>

        </div>

        <!-- CONTENT -->
        <div class="divide-y divide-gray-100">

            @forelse($jadwalHariIni as $jadwal)

                <div
                    class="px-6 py-5 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 hover:bg-gray-50 transition duration-200"
                >

                    <!-- LEFT -->
                    <div>

                        <div class="flex items-center gap-3">

                            <div
                                class="w-12 h-12 rounded-2xl flex items-center justify-center text-sm font-bold"
                                style="background: oklch(87% 0.065 274.039); color: oklch(45.7% 0.24 277.023)"
                            >

                                {{ strtoupper(substr($jadwal->mapel->nama_mapel ?? 'M', 0, 1)) }}

                            </div>

                            <div>

                                <h3 class="font-bold text-gray-800">
                                    {{ $jadwal->mapel->nama_mapel ?? '-' }}
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $jadwal->kelas->nama_kelas ?? '-' }}
                                </p>

                            </div>

                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div
                        class="flex flex-col sm:flex-row sm:items-center gap-3"
                    >

                        <div
                            class="px-4 py-2 rounded-2xl text-sm font-medium bg-gray-100 text-gray-700"
                        >

                            {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}

                        </div>

                        @if($jadwal->is_active)

                            <span
                                class="px-4 py-2 rounded-2xl text-sm font-semibold bg-green-100 text-green-700"
                            >
                                Sedang Berlangsung
                            </span>

                        @else

                            <span
                                class="px-4 py-2 rounded-2xl text-sm font-semibold bg-gray-100 text-gray-600"
                            >
                                {{ $jadwal->countdown }}
                            </span>

                        @endif

                    </div>

                </div>

            @empty

                <div class="px-6 py-16 text-center">

                    <div
                        class="w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-4"
                        style="background: oklch(95% 0.02 274)"
                    >

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-10 h-10"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             style="color: oklch(45.7% 0.24 277.023)">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z"/>
                        </svg>

                    </div>

                    <h3 class="text-lg font-semibold text-gray-700">
                        Tidak Ada Jadwal Hari Ini
                    </h3>

                    <p class="text-sm text-gray-500 mt-2">
                        Jadwal mengajar belum tersedia untuk hari ini
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection
