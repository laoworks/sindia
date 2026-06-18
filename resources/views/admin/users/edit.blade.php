@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">

        <div class="mb-6">

            <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                Edit User
            </h1>

        </div>

        <div class="bg-white border border-gray-200 shadow-sm p-6">

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">

                @csrf
                @method('PUT')

                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Nama
                    </label>

                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full border border-gray-300 px-4 py-3">
                    @error('name')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                </div>

                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Email
                    </label>

                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full border border-gray-300 px-4 py-3">
                    @error('email')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                </div>

                <div>

                    <label class="block text-sm font-semibold mb-2">
                        NIP
                    </label>

                    <input type="text" name="nip" value="{{ old('nip', $user->nip) }}"
                        class="w-full border border-gray-300 px-4 py-3">
                    @error('nip')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                </div>

                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Role
                    </label>

                    <select name="role" class="w-full border border-gray-300 px-4 py-3">

                        <option value="admin" @selected(old('role', $user->role) == 'admin')>
                            Admin
                        </option>

                        <option value="guru" @selected(old('role', $user->role) == 'guru')>
                            Guru
                        </option>

                        <option value="operator" @selected(old('role', $user->role) == 'operator')>
                            Operator
                        </option>

                        <option value="kepala_sekolah" @selected(old('role', $user->role) == 'kepala_sekolah')>
                            Kepala Sekolah
                        </option>

                    </select>
                    @error('role')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                </div>

                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Password Baru
                    </label>

                    <input type="password" name="password" class="w-full border border-gray-300 px-4 py-3">
                    @error('password')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                </div>

                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Konfirmasi Password Baru
                    </label>

                    <input type="password" name="password_confirmation" class="w-full border border-gray-300 px-4 py-3">

                </div>

                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Foto Profil
                    </label>

                    <input type="file" name="foto_profil" class="w-full border border-gray-300 px-4 py-3">
                    @error('foto_profil')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                </div>

                <div class="flex items-center gap-3">

                    <input type="checkbox" name="is_active" value="1"
                        {{ old('is_active', $user->is_active) ? 'checked' : '' }} class="w-5 h-5">

                    <label>
                        User Aktif
                    </label>

                </div>

                <div class="flex items-center gap-3">

                    <button type="submit" class="px-5 py-3 text-white font-semibold"
                        style="background: oklch(45.7% 0.24 277.023)">

                        Update User

                    </button>

                    <a href="{{ route('admin.users.index') }}" class="px-5 py-3 border border-gray-300">

                        Kembali

                    </a>

                </div>

            </form>

        </div>

    </div>
@endsection
