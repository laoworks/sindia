@extends('layouts.guru')

@section('content')

<h1 class="text-3xl font-bold mb-2">
    Dashboard Guru
</h1>

<p class="text-gray-500 mb-6">
    Selamat datang {{ auth()->user()->name }}
</p>

<div class="bg-white rounded-2xl shadow p-6">
    Informasi absensi guru
</div>

@endsection
