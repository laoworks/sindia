@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">

        <!-- Header -->
        <div class="mb-8">

            <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                Tambah User
            </h1>

            <p class="text-gray-500 mt-2">
                Tambahkan user baru ke sistem absensi guru
            </p>

        </div>

        <!-- Card -->
        <div class="bg-white border border-gray-100 shadow-sm overflow-hidden">

            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data"
                class="p-6 md:p-8 space-y-6">

                @csrf

                <!-- Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Nama -->
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Lengkap
                        </label>

                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap"
                            class="w-full border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 transition duration-200"
                            style="focus-ring-color: oklch(45.7% 0.24 277.023)">

                        @error('name')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Email -->
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Email
                        </label>

                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email"
                            class="w-full border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 transition duration-200">

                        @error('email')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- NIP -->
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            NIP
                        </label>

                        <input type="text" name="nip" value="{{ old('nip') }}" placeholder="Masukkan NIP"
                            class="w-full border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 transition duration-200">

                        @error('nip')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Role -->
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Role
                        </label>

                        <select name="role"
                            class="w-full border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 transition duration-200">

                            <option value="">-- Pilih Role --</option>

                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>

                            <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>
                                Guru
                            </option>

                            <option value="operator" {{ old('role') == 'operator' ? 'selected' : '' }}>
                                Operator
                            </option>

                            <option value="kepala_sekolah" {{ old('role') == 'kepala_sekolah' ? 'selected' : '' }}>
                                Kepala Sekolah
                            </option>

                        </select>

                        @error('role')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Password -->
                    <div class="md:col-span-2">

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Password
                        </label>

                        <input type="password" name="password" placeholder="Masukkan password"
                            class="w-full border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 transition duration-200">

                        @error('password')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div class="md:col-span-2">

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Konfirmasi Password
                        </label>

                        <input type="password" name="password_confirmation" placeholder="Ulangi password"
                            class="w-full border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 transition duration-200">

                    </div>

                    <!-- Foto -->
                    <div class="md:col-span-2">

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Foto Profil
                        </label>

                        <input type="file" name="foto_profil"
                            class="w-full border border-gray-200 px-4 py-3 text-sm bg-white">

                        @error('foto_profil')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Status -->
                    <div class="md:col-span-2">

                        <label class="flex items-center gap-3 cursor-pointer">

                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', '1') ? 'checked' : '' }} class="w-5 h-5 border-gray-300">

                            <span class="text-sm font-medium text-gray-700">
                                User Aktif
                            </span>

                        </label>

                    </div>

                </div>

                <!-- Button -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 pt-4">

                    <button type="submit"
                        class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white shadow-sm hover:opacity-90 transition duration-200"
                        style="background: oklch(45.7% 0.24 277.023)">

                        Simpan User

                    </button>

                    <a href="{{ route('admin.users.index') }}"
                        class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold border border-gray-200 text-gray-700 hover:bg-gray-50 transition duration-200">

                        Kembali

                    </a>

                </div>

            </form>

        </div>

    </div>
@endsection
