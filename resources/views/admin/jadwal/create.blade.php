@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto">

        <!-- HEADER -->
        <div class="mb-8">

            <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                Tambah Jadwal
            </h1>

            <p class="text-sm text-gray-500 mt-2">
                Tambahkan jadwal mengajar guru
            </p>

        </div>

        <!-- CARD -->
        <div class="bg-white border border-gray-100 shadow-sm p-6">

            <form method="POST" action="{{ route('admin.jadwal.store') }}">

                @csrf

                <!-- FORM -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- GURU -->
                    <div>

                        <label class="text-sm font-semibold text-gray-700">
                            Guru
                        </label>

                        <select name="guru_id"
                            class="w-full mt-2 px-4 py-3 border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent"
                            style="--tw-ring-color: oklch(87% 0.065 274.039)">

                            @foreach ($guru as $g)
                                <option value="{{ $g->id }}" @selected((string) old('guru_id') === (string) $g->id)>
                                    {{ $g->name }}
                                </option>
                            @endforeach

                        </select>
                        @error('guru_id')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- KELAS -->
                    <div>

                        <label class="text-sm font-semibold text-gray-700">
                            Kelas
                        </label>

                        <select name="kelas_id"
                            class="w-full mt-2 px-4 py-3 border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent"
                            style="--tw-ring-color: oklch(87% 0.065 274.039)">

                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}" @selected((string) old('kelas_id') === (string) $k->id)>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach

                        </select>
                        @error('kelas_id')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- MAPEL -->
                    <div>

                        <label class="text-sm font-semibold text-gray-700">
                            Mata Pelajaran
                        </label>

                        <select name="mapel_id"
                            class="w-full mt-2 px-4 py-3 border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent"
                            style="--tw-ring-color: oklch(87% 0.065 274.039)">

                            @foreach ($mapel as $m)
                                <option value="{{ $m->id }}" @selected((string) old('mapel_id') === (string) $m->id)>
                                    {{ $m->nama_mapel }}
                                </option>
                            @endforeach

                        </select>
                        @error('mapel_id')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- HARI -->
                    <div>

                        <label class="text-sm font-semibold text-gray-700">
                            Hari
                        </label>

                        <select name="hari"
                            class="w-full mt-2 px-4 py-3 border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent"
                            style="--tw-ring-color: oklch(87% 0.065 274.039)">

                            <option value="Senin" @selected(old('hari') === 'Senin')>Senin</option>
                            <option value="Selasa" @selected(old('hari') === 'Selasa')>Selasa</option>
                            <option value="Rabu" @selected(old('hari') === 'Rabu')>Rabu</option>
                            <option value="Kamis" @selected(old('hari') === 'Kamis')>Kamis</option>
                            <option value="Jumat" @selected(old('hari') === 'Jumat')>Jumat</option>
                            <option value="Sabtu" @selected(old('hari') === 'Sabtu')>Sabtu</option>

                        </select>
                        @error('hari')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- JAM MULAI -->
                    <div>

                        <label class="text-sm font-semibold text-gray-700">
                            Jam Mulai
                        </label>

                        <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}"
                            class="w-full mt-2 px-4 py-3 border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent"
                            style="--tw-ring-color: oklch(87% 0.065 274.039)">
                        @error('jam_mulai')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- JAM SELESAI -->
                    <div>

                        <label class="text-sm font-semibold text-gray-700">
                            Jam Selesai
                        </label>

                        <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}"
                            class="w-full mt-2 px-4 py-3 border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent"
                            style="--tw-ring-color: oklch(87% 0.065 274.039)">
                        @error('jam_selesai')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-8 flex flex-col sm:flex-row justify-end gap-3">

                    <!-- BACK -->
                    <a href="{{ route('admin.jadwal.index') }}"
                        class="inline-flex items-center justify-center px-5 py-3 border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition duration-200">

                        Kembali

                    </a>

                    <!-- SUBMIT -->
                    <button type="submit"
                        class="inline-flex items-center justify-center px-5 py-3 text-sm font-semibold text-white hover:opacity-90 transition duration-200"
                        style="background: oklch(45.7% 0.24 277.023)">

                        Simpan Jadwal

                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection
