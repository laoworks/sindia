@extends('layouts.operator')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">

    <!-- HEADER -->
    <h1 class="text-2xl font-bold mb-6 text-gray-900">
        Tambah Data Guru
    </h1>

    <!-- ERROR VALIDATION -->
    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM -->
    <form action="{{ route('operator.guru.store') }}" method="POST">

        @csrf

        <!-- NAMA -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="w-full border rounded-md px-3 py-2 focus:ring focus:ring-blue-200"
                   required>
        </div>

        <!-- EMAIL -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="w-full border rounded-md px-3 py-2"
                   required>
        </div>

        <!-- NIP -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">NIP</label>
            <input type="text"
                   name="nip"
                   value="{{ old('nip') }}"
                   class="w-full border rounded-md px-3 py-2">
        </div>

        <!-- PASSWORD -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password"
                   name="password"
                   class="w-full border rounded-md px-3 py-2"
                   required>
        </div>

        <!-- BUTTON -->
        <div class="flex justify-between">

            <a href="{{ route('operator.guru.index') }}"
               class="px-4 py-2 bg-gray-500 text-white rounded-md">
                Kembali
            </a>

            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md">
                Simpan Guru
            </button>

        </div>

    </form>

</div>

@endsection
