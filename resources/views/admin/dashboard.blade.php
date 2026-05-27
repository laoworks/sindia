@extends('layouts.admin')

@section('content')

<div class="mb-6">
    <h1 class="text-3xl font-bold">
        Dashboard Admin
    </h1>

    <p class="text-gray-500">
        Selamat datang {{ auth()->user()->name }}
    </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-gray-500 text-sm">
            Total Guru
        </h2>

        <p class="text-3xl font-bold mt-2">
            25
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-gray-500 text-sm">
            Total Absensi Hari Ini
        </h2>

        <p class="text-3xl font-bold mt-2">
            20
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-gray-500 text-sm">
            Guru Terlambat
        </h2>

        <p class="text-3xl font-bold mt-2 text-red-500">
            3
        </p>
    </div>

</div>

@endsection
