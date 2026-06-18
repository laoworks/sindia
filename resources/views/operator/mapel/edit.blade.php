@extends('layouts.operator')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 shadow-md">

        <h1 class="text-2xl font-bold mb-6">Edit Mata Pelajaran</h1>

        <form action="{{ route('operator.mapel.update', $mapel->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="mb-1 block text-sm font-medium text-gray-700">Nama Mapel</label>
                <input type="text" name="nama_mapel" value="{{ old('nama_mapel', $mapel->nama_mapel) }}"
                    class="w-full border p-2">
                @error('nama_mapel')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="mb-1 block text-sm font-medium text-gray-700">KKM</label>
                <input type="number" name="kkm" value="{{ old('kkm', $mapel->kkm) }}" min="0" max="100"
                    class="w-full border p-2">
                @error('kkm')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('operator.mapel.index') }}" class="bg-gray-500 px-4 py-2 text-white">
                    Kembali
                </a>

                <button class="bg-blue-600 px-4 py-2 text-white">
                    Update
                </button>
            </div>

        </form>

    </div>
@endsection
