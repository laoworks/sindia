@extends('layouts.admin')

@section('content')

<div class="max-w-2xl mx-auto bg-white p-6 shadow-sm border border-gray-100">

 <h1 class="text-xl font-bold mb-6 text-gray-800">
 Profile
 </h1>

 <form method="POST" action="{{ route('profile.update') }}">
 @csrf
 @method('PATCH')

 <!-- NAME -->
 <div class="mb-4">
 <label class="text-sm font-semibold text-gray-700">Nama</label>
 <input type="text"
 name="name"
 value="{{ old('name', $user->name) }}"
 class="w-full border border-gray-200 p-3 mt-2">

 @error('name')
 <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
 @enderror
 </div>

 <!-- EMAIL -->
 <div class="mb-4">
 <label class="text-sm font-semibold text-gray-700">Email</label>
 <input type="email"
 name="email"
 value="{{ old('email', $user->email) }}"
 class="w-full border border-gray-200 p-3 mt-2">

 @error('email')
 <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
 @enderror
 </div>

 <!-- PASSWORD -->
 <div class="mb-4">
 <label class="text-sm font-semibold text-gray-700">
 Password Baru (opsional)
 </label>
 <input type="password"
 name="password"
 class="w-full border border-gray-200 p-3 mt-2"
 placeholder="Kosongkan jika tidak ingin mengubah">

 @error('password')
 <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
 @enderror
 </div>

 <!-- CONFIRM PASSWORD -->
 <div class="mb-6">
 <label class="text-sm font-semibold text-gray-700">
 Konfirmasi Password
 </label>
 <input type="password"
 name="password_confirmation"
 class="w-full border border-gray-200 p-3 mt-2">
 </div>

 <!-- BUTTON -->
 <div class="flex justify-end">
 <button type="submit"
 class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold transition">
 Update Profile
 </button>
 </div>

 </form>

</div>

@endsection

@push('scripts')

<!-- SWEETALERT2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
 Swal.fire({
 icon: 'success',
 title: 'Berhasil',
 text: @json(session('success')),
 confirmButtonColor: '#7c3aed'
 });
</script>
@endif

@if(session('error'))
<script>
 Swal.fire({
 icon: 'error',
 title: 'Gagal',
 text: @json(session('error')),
 confirmButtonColor: '#ef4444'
 });
</script>
@endif

@if($errors->any())
<script>
 Swal.fire({
 icon: 'warning',
 title: 'Validasi Error',
 text: 'Silakan periksa kembali input Anda',
 confirmButtonColor: '#f59e0b'
 });
</script>
@endif

@endpush
