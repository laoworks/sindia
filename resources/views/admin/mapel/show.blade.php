@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white p-8 rounded-3xl border">

        <h2 class="text-2xl font-bold mb-6"
            style="color: oklch(45.7% 0.24 277.023)">
            Detail Mata Pelajaran
        </h2>

        <!-- CARD INFO -->
        <div class="space-y-4">

            <div class="p-4 rounded-2xl bg-gray-50">
                <p class="text-sm text-gray-500">Nama Mapel</p>
                <p class="font-semibold text-gray-900">{{ $mapel->nama_mapel }}</p>
            </div>

            <div class="p-4 rounded-2xl bg-gray-50">
                <p class="text-sm text-gray-500">KKM</p>
                <p class="font-semibold text-gray-900">{{ $mapel->kkm }}</p>
            </div>

            <div class="p-4 rounded-2xl bg-gray-50">
                <p class="text-sm text-gray-500">Dibuat</p>
                <p class="font-semibold text-gray-900">{{ $mapel->created_at->format('d M Y H:i') }}</p>
            </div>

        </div>

        <!-- BUTTON -->
        <div class="mt-6 flex justify-end">

            <a href="{{ route('admin.mapel.index') }}"
               class="px-5 py-3 rounded-2xl bg-gray-200 text-gray-700">
                Kembali
            </a>

        </div>

    </div>

</div>

@endsection
