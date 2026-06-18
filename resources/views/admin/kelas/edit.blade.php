@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto">

        <div class="mb-8">
            <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                Edit Kelas
            </h1>
            <p class="text-sm text-gray-500 mt-2">
                Ubah data kelas
            </p>
        </div>

        <div class="bg-white p-6 border">

            <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="POST">

                @csrf
                @method('PUT')

                <!-- Nama -->
                <div class="mb-5">
                    <label class="text-sm font-semibold">Nama Kelas</label>
                    <input type="text" name="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                        class="w-full mt-2 px-4 py-3 border">
                    @error('nama_kelas')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jurusan -->
                <div class="mb-5">
                    <label class="text-sm font-semibold">Jurusan</label>
                    <input type="text" name="jurusan" value="{{ old('jurusan', $kelas->jurusan) }}"
                        class="w-full mt-2 px-4 py-3 border">
                    @error('jurusan')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Button -->
                <div class="flex justify-end gap-3">

                    <a href="{{ route('admin.kelas.index') }}" class="px-5 py-3 bg-gray-200">
                        Batal
                    </a>

                    <button class="px-5 py-3 text-white" style="background: oklch(45.7% 0.24 277.023)">
                        Update
                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection
