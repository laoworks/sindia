@extends('layouts.guru')

@section('content')

<div class="max-w-4xl mx-auto">

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold"
            style="color: oklch(45.7% 0.24 277.023)">
            Profile Guru
        </h1>
        <p class="text-sm text-gray-500 mt-2">
            Kelola informasi akun anda
        </p>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">

        <form id="profileForm"
              method="POST"
              action="{{ route('guru.profile.update') }}"
              class="space-y-6">

            @csrf
            @method('PATCH')

            <!-- NAMA -->
            <div>
                <label class="block text-sm font-semibold mb-2">Nama</label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $user->name) }}"
                       class="w-full px-4 py-3 rounded-2xl border border-gray-200">
            </div>

            <!-- EMAIL -->
            <div>
                <label class="block text-sm font-semibold mb-2">Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email', $user->email) }}"
                       class="w-full px-4 py-3 rounded-2xl border border-gray-200">
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="block text-sm font-semibold mb-2">
                    Password Baru (opsional)
                </label>
                <input type="password"
                       name="password"
                       class="w-full px-4 py-3 rounded-2xl border border-gray-200">
            </div>

            <!-- KONFIRM PASSWORD -->
            <div>
                <label class="block text-sm font-semibold mb-2">
                    Konfirmasi Password
                </label>
                <input type="password"
                       name="password_confirmation"
                       class="w-full px-4 py-3 rounded-2xl border border-gray-200">
            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-3">

                <a href="{{ route('guru.dashboard') }}"
                   class="px-5 py-3 rounded-2xl border text-gray-600">
                    Kembali
                </a>

                <button type="submit"
                        id="submitBtn"
                        class="px-5 py-3 rounded-2xl text-white font-semibold"
                        style="background: oklch(45.7% 0.24 277.023)">
                    Simpan
                </button>

            </div>

        </form>

    </div>
</div>

<!-- SWEETALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('profileForm').addEventListener('submit', function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Simpan perubahan?',
        text: "Data profile akan diperbarui",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#6d28d9',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, simpan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {

            Swal.fire({
                title: 'Menyimpan...',
                text: 'Mohon tunggu',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            setTimeout(() => {
                e.target.submit();
            }, 800);
        }
    });
});
</script>

<!-- SUCCESS ALERT -->
@if(session('status') === 'profile-updated')
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: 'Profile berhasil diperbarui',
    confirmButtonColor: '#6d28d9'
});
</script>
@endif

<!-- ERROR ALERT -->
@if ($errors->any())
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal',
    html: `{!! implode('<br>', $errors->all()) !!}`,
    confirmButtonColor: '#ef4444'
});
</script>
@endif

@endsection
