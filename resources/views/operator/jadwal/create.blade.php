@extends('layouts.operator')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 shadow">

        <h1 class="text-2xl font-bold mb-6">Tambah Jadwal</h1>

        <form method="POST" action="{{ route('operator.jadwal.store') }}">

            @csrf

            <div class="mb-4">
                <label class="mb-1 block text-sm font-medium text-gray-700">Guru</label>
                <select name="guru_id" class="w-full border p-2">
                    @foreach ($guru as $g)
                        <option value="{{ $g->id }}" @selected((string) old('guru_id') === (string) $g->id)>{{ $g->name }}</option>
                    @endforeach
                </select>
                @error('guru_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="mb-1 block text-sm font-medium text-gray-700">Kelas</label>
                <select name="kelas_id" class="w-full border p-2">
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}" @selected((string) old('kelas_id') === (string) $k->id)>{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
                @error('kelas_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="mb-1 block text-sm font-medium text-gray-700">Mapel</label>
                <select name="mapel_id" class="w-full border p-2">
                    @foreach ($mapel as $m)
                        <option value="{{ $m->id }}" @selected((string) old('mapel_id') === (string) $m->id)>{{ $m->nama_mapel }}</option>
                    @endforeach
                </select>
                @error('mapel_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="mb-1 block text-sm font-medium text-gray-700">Hari</label>
                <select name="hari" class="w-full border p-2">
                    @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $h)
                        <option value="{{ $h }}" @selected(old('hari') === $h)>{{ $h }}</option>
                    @endforeach
                </select>
                @error('hari')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="mb-4">
                    <label class="mb-1 block text-sm font-medium text-gray-700">Jam Mulai</label>
                    <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}" class="w-full border p-2">
                    @error('jam_mulai')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="mb-1 block text-sm font-medium text-gray-700">Jam Selesai</label>
                    <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}" class="w-full border p-2">
                    @error('jam_selesai')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('operator.jadwal.index') }}" class="bg-gray-500 px-4 py-2 text-white">
                    Kembali
                </a>

                <button class="bg-blue-600 px-4 py-2 text-white">
                    Simpan
                </button>
            </div>

        </form>

    </div>
@endsection
