@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <!-- HEADER -->
    <div class="mb-8">

        <h1
            class="text-3xl font-bold"
            style="color: oklch(45.7% 0.24 277.023)"
        >
            Tambah Jadwal
        </h1>

        <p class="text-sm text-gray-500 mt-2">
            Tambahkan jadwal mengajar guru
        </p>

    </div>

    <!-- CARD -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">

        <form
            method="POST"
            action="{{ route('admin.jadwal.store') }}"
        >

            @csrf

            <!-- FORM -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <!-- GURU -->
                <div>

                    <label class="text-sm font-semibold text-gray-700">
                        Guru
                    </label>

                    <select
                        name="guru_id"
                        class="w-full mt-2 px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent"
                        style="--tw-ring-color: oklch(87% 0.065 274.039)"
                    >

                        @foreach($guru as $g)

                            <option value="{{ $g->id }}">
                                {{ $g->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- KELAS -->
                <div>

                    <label class="text-sm font-semibold text-gray-700">
                        Kelas
                    </label>

                    <select
                        name="kelas_id"
                        class="w-full mt-2 px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent"
                        style="--tw-ring-color: oklch(87% 0.065 274.039)"
                    >

                        @foreach($kelas as $k)

                            <option value="{{ $k->id }}">
                                {{ $k->nama_kelas }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- MAPEL -->
                <div>

                    <label class="text-sm font-semibold text-gray-700">
                        Mata Pelajaran
                    </label>

                    <select
                        name="mapel_id"
                        class="w-full mt-2 px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent"
                        style="--tw-ring-color: oklch(87% 0.065 274.039)"
                    >

                        @foreach($mapel as $m)

                            <option value="{{ $m->id }}">
                                {{ $m->nama_mapel }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- HARI -->
                <div>

                    <label class="text-sm font-semibold text-gray-700">
                        Hari
                    </label>

                    <select
                        name="hari"
                        class="w-full mt-2 px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent"
                        style="--tw-ring-color: oklch(87% 0.065 274.039)"
                    >

                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>

                    </select>

                </div>

                <!-- JAM MULAI -->
                <div>

                    <label class="text-sm font-semibold text-gray-700">
                        Jam Mulai
                    </label>

                    <input
                        type="time"
                        name="jam_mulai"
                        class="w-full mt-2 px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent"
                        style="--tw-ring-color: oklch(87% 0.065 274.039)"
                    >

                </div>

                <!-- JAM SELESAI -->
                <div>

                    <label class="text-sm font-semibold text-gray-700">
                        Jam Selesai
                    </label>

                    <input
                        type="time"
                        name="jam_selesai"
                        class="w-full mt-2 px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent"
                        style="--tw-ring-color: oklch(87% 0.065 274.039)"
                    >

                </div>

            </div>

            <!-- BUTTON -->
            <div class="mt-8 flex flex-col sm:flex-row justify-end gap-3">

                <!-- BACK -->
                <a
                    href="{{ route('admin.jadwal.index') }}"
                    class="inline-flex items-center justify-center px-5 py-3 rounded-2xl border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition duration-200"
                >

                    Kembali

                </a>

                <!-- SUBMIT -->
                <button
                    type="submit"
                    class="inline-flex items-center justify-center px-5 py-3 rounded-2xl text-sm font-semibold text-white hover:opacity-90 transition duration-200"
                    style="background: oklch(45.7% 0.24 277.023)"
                >

                    Simpan Jadwal

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
