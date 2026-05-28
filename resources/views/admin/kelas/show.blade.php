@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
            Detail Kelas
        </h1>
        <p class="text-sm text-gray-500 mt-2">
            Informasi lengkap kelas
        </p>
    </div>

    <div class="bg-white p-6 rounded-3xl border">

        <div class="space-y-4">

            <div>
                <p class="text-sm text-gray-500">Nama Kelas</p>
                <p class="text-lg font-semibold">{{ $kelas->nama_kelas }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Jurusan</p>
                <p class="text-lg font-semibold">{{ $kelas->jurusan }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Dibuat</p>
                <p class="text-lg font-semibold">{{ $kelas->created_at }}</p>
            </div>

        </div>

        <div class="mt-6">
            <a href="{{ route('admin.kelas.index') }}"
               class="px-5 py-3 rounded-xl bg-gray-200">
                Kembali
            </a>
        </div>

    </div>

</div>

@endsection
