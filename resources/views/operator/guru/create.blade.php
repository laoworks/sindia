@extends('layouts.operator')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 shadow-md">

        <!-- HEADER -->
        <h1 class="text-2xl font-bold mb-6 text-gray-900">
            Tambah Data Guru
        </h1>

        <!-- FORM -->
        <form action="{{ route('operator.guru.store') }}" method="POST">

            @csrf

            <!-- NAMA -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full border px-3 py-2 focus:ring focus:ring-blue-200" required>
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- EMAIL -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border px-3 py-2" required>
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- NIP -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">NIP</label>
                <input type="text" name="nip" value="{{ old('nip') }}" class="w-full border px-3 py-2">
                @error('nip')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- PASSWORD -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" class="w-full border px-3 py-2" required>
                @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- BUTTON -->
            <div class="flex justify-between">

                <a href="{{ route('operator.guru.index') }}" class="px-4 py-2 bg-gray-500 text-white">
                    Kembali
                </a>

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white">
                    Simpan Guru
                </button>

            </div>

        </form>

    </div>
@endsection
