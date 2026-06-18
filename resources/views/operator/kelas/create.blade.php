@extends('layouts.operator')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 shadow-md">

        <h1 class="text-2xl font-bold mb-6 text-gray-900">
            Tambah Data Kelas
        </h1>

        <form action="{{ route('operator.kelas.store') }}" method="POST">

            @csrf

            <!-- NAMA KELAS -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Kelas
                </label>

                <input type="text" name="nama_kelas" value="{{ old('nama_kelas') }}" placeholder="Contoh: X IPA 1"
                    class="w-full border px-3 py-2 focus:ring focus:ring-blue-200" required>
                @error('nama_kelas')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- JURUSAN -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Jurusan
                </label>

                <input type="text" name="jurusan" value="{{ old('jurusan') }}" placeholder="Contoh: IPA / IPS / RPL"
                    class="w-full border px-3 py-2 focus:ring focus:ring-blue-200" required>
                @error('jurusan')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- BUTTON -->
            <div class="flex justify-between">

                <a href="{{ route('operator.kelas.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 hover:bg-gray-600 transition">
                    Kembali
                </a>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 hover:bg-blue-700 transition">
                    Simpan
                </button>

            </div>

        </form>

    </div>
@endsection
