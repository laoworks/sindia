@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">

        <!-- HEADER -->
        <div class="mb-8">

            <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                Detail Jadwal
            </h1>

            <p class="text-sm text-gray-500 mt-2">
                Informasi lengkap jadwal mengajar guru
            </p>

        </div>

        <!-- CARD -->
        <div class="bg-white border border-gray-100 shadow-sm overflow-hidden">

            <!-- TOP -->
            <div class="px-6 py-5 border-b border-gray-100" style="background: oklch(97% 0.01 286)">

                <h2 class="text-lg font-semibold" style="color: oklch(45.7% 0.24 277.023)">
                    Data Jadwal Mengajar
                </h2>

            </div>

            <!-- CONTENT -->
            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- GURU -->
                    <div>

                        <p class="text-sm font-medium text-gray-500 mb-2">
                            Guru
                        </p>

                        <div class="px-4 py-3 border border-gray-100 bg-gray-50">

                            <p class="font-semibold text-gray-800">
                                {{ $jadwal->guru?->name ?? '-' }}
                            </p>

                        </div>

                    </div>

                    <!-- KELAS -->
                    <div>

                        <p class="text-sm font-medium text-gray-500 mb-2">
                            Kelas
                        </p>

                        <div class="px-4 py-3 border border-gray-100 bg-gray-50">

                            <p class="font-semibold text-gray-800">
                                {{ $jadwal->kelas?->nama_kelas ?? '-' }}
                            </p>

                        </div>

                    </div>

                    <!-- MAPEL -->
                    <div>

                        <p class="text-sm font-medium text-gray-500 mb-2">
                            Mata Pelajaran
                        </p>

                        <div class="px-4 py-3 border border-gray-100 bg-gray-50">

                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold"
                                style="
 background: oklch(87% 0.065 274.039);
 color: oklch(45.7% 0.24 277.023);
 ">

                                {{ $jadwal->mapel?->nama_mapel ?? '-' }}

                            </span>

                        </div>

                    </div>

                    <!-- HARI -->
                    <div>

                        <p class="text-sm font-medium text-gray-500 mb-2">
                            Hari
                        </p>

                        <div class="px-4 py-3 border border-gray-100 bg-gray-50">

                            <p class="font-semibold text-gray-800">
                                {{ $jadwal->hari }}
                            </p>

                        </div>

                    </div>

                    <!-- JAM -->
                    <div class="md:col-span-2">

                        <p class="text-sm font-medium text-gray-500 mb-2">
                            Jam Mengajar
                        </p>

                        <div class="px-4 py-3 border border-gray-100 bg-gray-50">

                            <p class="font-semibold text-gray-800">
                                {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                            </p>

                        </div>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-8 flex flex-col sm:flex-row justify-end gap-3">

                    <!-- BACK -->
                    <a href="{{ route('admin.jadwal.index') }}"
                        class="inline-flex items-center justify-center px-5 py-3 border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition duration-200">

                        Kembali

                    </a>

                    <!-- EDIT -->
                    <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}"
                        class="inline-flex items-center justify-center px-5 py-3 text-sm font-semibold text-white hover:opacity-90 transition duration-200"
                        style="background: oklch(45.7% 0.24 277.023)">

                        Edit Jadwal

                    </a>

                </div>

            </div>

        </div>

    </div>
@endsection
