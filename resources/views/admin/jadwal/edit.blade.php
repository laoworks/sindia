@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">

        <!-- HEADER -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                Edit Jadwal Mengajar
            </h1>
            <p class="text-sm text-gray-500 mt-2">
                Perbarui data jadwal guru
            </p>
        </div>

        <!-- CARD -->
        <div class="bg-white shadow-sm border border-gray-100 p-6">

            <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- GURU -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Guru</label>
                        <select name="guru_id" class="w-full mt-2 px-4 py-3 border border-gray-200">

                            @foreach ($guru as $g)
                                <option value="{{ $g->id }}"
                                    {{ old('guru_id', $jadwal->guru_id) == $g->id ? 'selected' : '' }}>
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
                        <label class="text-sm font-semibold text-gray-700">Kelas</label>
                        <select name="kelas_id" class="w-full mt-2 px-4 py-3 border border-gray-200">

                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}"
                                    {{ old('kelas_id', $jadwal->kelas_id) == $k->id ? 'selected' : '' }}>
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
                        <label class="text-sm font-semibold text-gray-700">Mata Pelajaran</label>
                        <select name="mapel_id" class="w-full mt-2 px-4 py-3 border border-gray-200">

                            @foreach ($mapel as $m)
                                <option value="{{ $m->id }}"
                                    {{ old('mapel_id', $jadwal->mapel_id) == $m->id ? 'selected' : '' }}>
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
                        <label class="text-sm font-semibold text-gray-700">Hari</label>
                        <select name="hari" class="w-full mt-2 px-4 py-3 border border-gray-200">

                            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                                <option value="{{ $hari }}"
                                    {{ old('hari', $jadwal->hari) == $hari ? 'selected' : '' }}>
                                    {{ $hari }}
                                </option>
                            @endforeach

                        </select>
                        @error('hari')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- JAM MULAI -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Jam Mulai</label>
                        <input type="time" name="jam_mulai"
                            value="{{ old('jam_mulai', \Illuminate\Support\Str::of($jadwal->jam_mulai)->substr(0, 5)) }}"
                            class="w-full mt-2 px-4 py-3 border border-gray-200">
                        @error('jam_mulai')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- JAM SELESAI -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Jam Selesai</label>
                        <input type="time" name="jam_selesai"
                            value="{{ old('jam_selesai', \Illuminate\Support\Str::of($jadwal->jam_selesai)->substr(0, 5)) }}"
                            class="w-full mt-2 px-4 py-3 border border-gray-200">
                        @error('jam_selesai')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-8 flex justify-end gap-3">

                    <a href="{{ route('admin.jadwal.index') }}" class="px-5 py-3 border text-gray-600 hover:bg-gray-50">
                        Batal
                    </a>

                    <button type="submit" class="px-5 py-3 text-white font-semibold"
                        style="background: oklch(45.7% 0.24 277.023)">
                        Update Jadwal
                    </button>

                </div>

            </form>

        </div>
    </div>
@endsection
