@extends('layouts.operator')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">

    <h1 class="text-2xl font-bold mb-6">
        Edit Data Guru
    </h1>

    <form action="{{ route('operator.guru.update', $guru->id) }}" method="POST">

        @csrf
        @method('PUT')

        <!-- NAMA -->
        <input type="text" name="name"
               value="{{ $guru->name }}"
               class="w-full border p-2 mb-3 rounded"
               placeholder="Nama">

        <!-- EMAIL -->
        <input type="email" name="email"
               value="{{ $guru->email }}"
               class="w-full border p-2 mb-3 rounded"
               placeholder="Email">

        <!-- NIP -->
        <input type="text" name="nip"
               value="{{ $guru->nip }}"
               class="w-full border p-2 mb-3 rounded"
               placeholder="NIP">

        <!-- PASSWORD (OPSIONAL) -->
        <input type="password" name="password"
               class="w-full border p-2 mb-3 rounded"
               placeholder="Password baru (kosongkan jika tidak diubah)">

        <!-- CONFIRM PASSWORD -->
        <input type="password" name="password_confirmation"
               class="w-full border p-2 mb-4 rounded"
               placeholder="Konfirmasi password">

        <div class="flex gap-2">

            <a href="{{ route('operator.guru.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded">
                Kembali
            </a>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Update
            </button>

        </div>

    </form>

</div>

@endsection
