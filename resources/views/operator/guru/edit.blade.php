@extends('layouts.operator')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 shadow-md">

        <h1 class="text-2xl font-bold mb-6">
            Edit Data Guru
        </h1>

        <form action="{{ route('operator.guru.update', $guru->id) }}" method="POST">

            @csrf
            @method('PUT')

            <!-- NAMA -->
            <div class="mb-4">
                <label class="mb-1 block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name', $guru->name) }}" class="w-full border p-2"
                    placeholder="Nama">
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- EMAIL -->
            <div class="mb-4">
                <label class="mb-1 block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $guru->email) }}" class="w-full border p-2"
                    placeholder="Email">
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- NIP -->
            <div class="mb-4">
                <label class="mb-1 block text-sm font-medium text-gray-700">NIP</label>
                <input type="text" name="nip" value="{{ old('nip', $guru->nip) }}" class="w-full border p-2"
                    placeholder="NIP">
                @error('nip')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- PASSWORD (OPSIONAL) -->
            <div class="mb-4">
                <label class="mb-1 block text-sm font-medium text-gray-700">Password Baru</label>
                <input type="password" name="password" class="w-full border p-2" placeholder="Kosongkan jika tidak diubah">
                @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- CONFIRM PASSWORD -->
            <div class="mb-4">
                <label class="mb-1 block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full border p-2"
                    placeholder="Ulangi password baru">
            </div>

            <div class="flex gap-2">

                <a href="{{ route('operator.guru.index') }}" class="bg-gray-500 text-white px-4 py-2">
                    Kembali
                </a>

                <button class="bg-blue-600 text-white px-4 py-2">
                    Update
                </button>

            </div>

        </form>

    </div>
@endsection
