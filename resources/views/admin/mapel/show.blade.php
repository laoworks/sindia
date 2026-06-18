@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                Detail Mata Pelajaran
            </h1>
            <p class="text-sm text-gray-500 mt-2">
                Informasi detail mata pelajaran dan nilai KKM.
            </p>
        </div>

        <div class="bg-white border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100" style="background: oklch(97% 0.01 286)">
                <h2 class="text-lg font-semibold text-gray-900">{{ $mapel->nama_mapel }}</h2>
                <p class="text-sm text-gray-500 mt-1">KKM {{ $mapel->kkm }}</p>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="bg-gray-50 border border-gray-100 p-4">
                        <p class="text-sm text-gray-500">Nama Mapel</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $mapel->nama_mapel }}</p>
                    </div>

                    <div class="bg-gray-50 border border-gray-100 p-4">
                        <p class="text-sm text-gray-500">KKM</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $mapel->kkm }}</p>
                    </div>

                    <div class="bg-gray-50 border border-gray-100 p-4">
                        <p class="text-sm text-gray-500">Dibuat</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $mapel->created_at->format('d M Y H:i') }}
                        </p>
                    </div>

                    <div class="bg-gray-50 border border-gray-100 p-4">
                        <p class="text-sm text-gray-500">Diperbarui</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $mapel->updated_at->format('d M Y H:i') }}
                        </p>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('admin.mapel.index') }}"
                        class="px-5 py-3 border border-gray-200 text-gray-700 hover:bg-gray-50">
                        Kembali
                    </a>

                    <a href="{{ route('admin.mapel.edit', $mapel->id) }}" class="px-5 py-3 text-white font-semibold"
                        style="background: oklch(45.7% 0.24 277.023)">
                        Edit Mapel
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
