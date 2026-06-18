@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">

        <!-- HEADER -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                Detail Guru
            </h1>
            <p class="text-gray-500 text-sm mt-2">
                Informasi lengkap data guru
            </p>
        </div>

        <div class="bg-white border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100" style="background: oklch(97% 0.01 286)">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 flex items-center justify-center text-white text-xl font-bold"
                        style="background: oklch(45.7% 0.24 277.023)">
                        {{ strtoupper(substr($guru->name, 0, 1)) }}
                    </div>

                    <div>
                        <h2 class="text-xl font-bold text-gray-900">{{ $guru->name }}</h2>
                        <p class="text-sm text-gray-500">{{ $guru->email }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">Nama</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $guru->name }}</p>
                    </div>

                    <div class="border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $guru->email }}</p>
                    </div>

                    <div class="border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">NIP</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $guru->nip ?? '-' }}</p>
                    </div>

                    <div class="border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">Role</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">Guru</p>
                    </div>

                    <div class="border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">Status</p>
                        <div class="mt-2">
                            @if ($guru->is_active)
                                <span
                                    class="inline-flex px-3 py-1 text-xs font-semibold bg-green-100 text-green-700 border border-green-200">
                                    Aktif
                                </span>
                            @else
                                <span
                                    class="inline-flex px-3 py-1 text-xs font-semibold bg-red-100 text-red-700 border border-red-200">
                                    Nonaktif
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">Dibuat</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $guru->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>

                <div class="mt-8 flex flex-col sm:flex-row justify-end gap-3">
                    <a href="{{ route('admin.guru.index') }}"
                        class="inline-flex items-center justify-center px-5 py-3 border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition duration-200">
                        Kembali
                    </a>

                    <a href="{{ route('admin.users.edit', $guru->id) }}"
                        class="inline-flex items-center justify-center px-5 py-3 text-sm font-semibold text-white transition duration-200 hover:opacity-90"
                        style="background: oklch(45.7% 0.24 277.023)">
                        Edit Guru
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection
