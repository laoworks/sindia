@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                Detail Kelas
            </h1>
            <p class="text-sm text-gray-500 mt-2">
                Ringkasan informasi kelas yang tersimpan di sistem.
            </p>
        </div>

        <div class="bg-white border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100" style="background: oklch(97% 0.01 286)">
                <h2 class="text-lg font-semibold text-gray-900">{{ $kelas->nama_kelas }}</h2>
                <p class="text-sm text-gray-500 mt-1">{{ $kelas->jurusan }}</p>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="border border-gray-100 bg-gray-50 px-4 py-4">
                        <p class="text-sm text-gray-500">Nama Kelas</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $kelas->nama_kelas }}</p>
                    </div>

                    <div class="border border-gray-100 bg-gray-50 px-4 py-4">
                        <p class="text-sm text-gray-500">Jurusan</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $kelas->jurusan }}</p>
                    </div>

                    <div class="border border-gray-100 bg-gray-50 px-4 py-4">
                        <p class="text-sm text-gray-500">Dibuat</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $kelas->created_at->format('d M Y H:i') }}
                        </p>
                    </div>

                    <div class="border border-gray-100 bg-gray-50 px-4 py-4">
                        <p class="text-sm text-gray-500">Diperbarui</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $kelas->updated_at->format('d M Y H:i') }}
                        </p>
                    </div>
                </div>

                <div class="mt-8 flex flex-col sm:flex-row justify-end gap-3">
                    <a href="{{ route('admin.kelas.index') }}"
                        class="inline-flex items-center justify-center px-5 py-3 border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition duration-200">
                        Kembali
                    </a>

                    <a href="{{ route('admin.kelas.edit', $kelas->id) }}"
                        class="inline-flex items-center justify-center px-5 py-3 text-sm font-semibold text-white transition duration-200 hover:opacity-90"
                        style="background: oklch(45.7% 0.24 277.023)">
                        Edit Kelas
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
