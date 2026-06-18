@extends('layouts.operator')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="max-w-3xl mx-auto bg-white p-6 shadow-md">

        <h1 class="text-2xl font-bold mb-6">
            Profile Operator
        </h1>

        <!-- SUCCESS SWEETALERT -->
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: @json(session('success')),
                        timer: 2000,
                        showConfirmButton: false
                    });
                });
            </script>
        @endif

        <form action="{{ route('operator.profile.update') }}" method="POST">

            @csrf
            @method('PUT')

            <!-- NAME -->
            <div class="mb-4">
                <label class="block text-sm font-medium">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border px-3 py-2">
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- EMAIL -->
            <div class="mb-4">
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border px-3 py-2">
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- PASSWORD -->
            <div class="mb-4">
                <label class="block text-sm font-medium">
                    Password (opsional)
                </label>
                <input type="password" name="password" class="w-full border px-3 py-2"
                    placeholder="Kosongkan jika tidak diganti">
                @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium">
                    Konfirmasi Password
                </label>
                <input type="password" name="password_confirmation" class="w-full border px-3 py-2"
                    placeholder="Ulangi password baru">
            </div>

            <!-- BUTTON -->
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 hover:bg-blue-700">
                Update Profile
            </button>

        </form>

    </div>
@endsection
