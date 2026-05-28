@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <!-- Header -->
    <div class="mb-8">

        <h1
            class="text-3xl font-bold"
            style="color: oklch(45.7% 0.24 277.023)"
        >
            Tambah Kelas
        </h1>

        <p class="text-sm text-gray-500 mt-2">
            Tambahkan data kelas baru
        </p>

    </div>

    <!-- Card -->
    <div class="bg-white border border-gray-100 rounded-3xl shadow-sm p-8">

        <form action="{{ route('admin.kelas.store') }}" method="POST">

            @csrf

            <!-- Nama Kelas -->
            <div class="mb-6">

                <label class="block text-sm font-semibold text-gray-700">
                    Nama Kelas
                </label>

                <input
                    type="text"
                    name="nama_kelas"
                    value="{{ old('nama_kelas') }}"
                    placeholder="Contoh: X IPA 1"
                    class="w-full mt-2 px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent transition duration-200"
                    style="--tw-ring-color: oklch(87% 0.065 274.039)"
                >

                @error('nama_kelas')

                    <p class="text-sm text-red-500 mt-2">

                        {{ $message }}

                    </p>

                @enderror

            </div>

            <!-- Jurusan -->
            <div class="mb-8">

                <label class="block text-sm font-semibold text-gray-700">
                    Jurusan
                </label>

                <input
                    type="text"
                    name="jurusan"
                    value="{{ old('jurusan') }}"
                    placeholder="Contoh: IPA / IPS / RPL"
                    class="w-full mt-2 px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent transition duration-200"
                    style="--tw-ring-color: oklch(87% 0.065 274.039)"
                >

                @error('jurusan')

                    <p class="text-sm text-red-500 mt-2">

                        {{ $message }}

                    </p>

                @enderror

            </div>

            <!-- Button -->
            <div class="flex items-center justify-end gap-3">

                <!-- Kembali -->
                <a
                    href="{{ route('admin.kelas.index') }}"
                    class="inline-flex items-center px-5 py-3 rounded-2xl text-sm font-semibold bg-gray-100 text-gray-700 hover:bg-gray-200 transition duration-200"
                >

                    Kembali

                </a>

                <!-- Simpan -->
                <button
                    type="submit"
                    class="inline-flex items-center px-5 py-3 rounded-2xl text-sm font-semibold text-white hover:opacity-90 transition duration-200"
                    style="background: oklch(45.7% 0.24 277.023)"
                >

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
