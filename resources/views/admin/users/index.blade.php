@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex flex-col gap-4 mb-8">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <div>

                <h1 class="text-3xl font-bold"
                    style="color: oklch(45.7% 0.24 277.023)">
                    Data User
                </h1>

                <p class="text-sm text-gray-500 mt-2">
                    Kelola seluruh user sistem absensi guru
                </p>

            </div>

            <!-- Button -->
            <div class="flex justify-end">

                <a href="{{ route('admin.users.create') }}"
                   class="inline-flex items-center px-5 py-3 rounded-2xl text-sm font-semibold text-white shadow-sm hover:opacity-90 transition duration-200"
                   style="background: oklch(45.7% 0.24 277.023)">
                    Tambah User
                </a>

            </div>

        </div>

        <!-- SEARCH (SUDAH DIPERBAIKI) -->
        <div class="flex justify-start">

            <input
                type="text"
                id="search"
                placeholder="Cari nama, email, atau NIP..."
                class="w-full lg:w-1/3 px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-500"
            >

        </div>

    </div>

    <!-- Card -->
    <div class="bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead style="background: oklch(97% 0.01 286)"
                       class="border-b border-gray-100">

                    <tr>
                        <th class="px-6 py-5 text-left text-xs font-semibold uppercase text-gray-500">No</th>
                        <th class="px-6 py-5 text-left text-xs font-semibold uppercase text-gray-500">Foto</th>
                        <th class="px-6 py-5 text-left text-xs font-semibold uppercase text-gray-500">Nama</th>
                        <th class="px-6 py-5 text-left text-xs font-semibold uppercase text-gray-500">Email</th>
                        <th class="px-6 py-5 text-left text-xs font-semibold uppercase text-gray-500">NIP</th>
                        <th class="px-6 py-5 text-left text-xs font-semibold uppercase text-gray-500">Role</th>
                        <th class="px-6 py-5 text-left text-xs font-semibold uppercase text-gray-500">Status</th>
                        <th class="px-6 py-5 text-center text-xs font-semibold uppercase text-gray-500">Aksi</th>
                    </tr>

                </thead>

                <tbody id="user-table" class="divide-y divide-gray-100 bg-white">

                    @forelse($users as $user)

                        <tr class="hover:bg-gray-50/70 transition duration-200">

                            <td class="px-6 py-5 text-sm text-gray-500">
                                {{ $users->firstItem() + $loop->index }}
                            </td>

                            <td class="px-6 py-5">
                                @if($user->foto_profil)
                                    <img src="{{ asset('storage/' . $user->foto_profil) }}"
                                         class="w-12 h-12 rounded-2xl object-cover border border-gray-200">
                                @else
                                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-white font-bold text-sm"
                                         style="background: oklch(45.7% 0.24 277.023)">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                            </td>

                            <td class="px-6 py-5 font-semibold text-gray-900">
                                {{ $user->name }}
                            </td>

                            <td class="px-6 py-5 text-sm text-gray-500">
                                {{ $user->email }}
                            </td>

                            <td class="px-6 py-5 text-sm text-gray-500">
                                {{ $user->nip ?? '-' }}
                            </td>

                            <td class="px-6 py-5">
                                <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-semibold"
                                      style="background: oklch(87% 0.065 274.039); color: oklch(45.7% 0.24 277.023);">
                                    {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                </span>
                            </td>

                            <td class="px-6 py-5">

                                @if($user->is_active)
                                    <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-semibold bg-green-100 text-green-700">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-semibold bg-red-100 text-red-700">
                                        Nonaktif
                                    </span>
                                @endif

                            </td>

                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center gap-2">

                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                       class="px-4 py-2 rounded-xl text-xs font-semibold text-white"
                                       style="background: oklch(45.7% 0.24 277.023)">
                                        Edit
                                    </a>

                                    <a href="{{ route('admin.users.show', $user->id) }}"
                                       class="px-4 py-2 rounded-xl text-xs font-semibold text-white bg-blue-500 hover:bg-blue-600">
                                        View
                                    </a>

                                    <form id="delete-form-{{ $user->id }}"
                                          action="{{ route('admin.users.destroy', $user->id) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                                onclick="deleteUser({{ $user->id }}, @js($user->name))"
                                                class="px-4 py-2 rounded-xl text-xs font-semibold text-white bg-red-500 hover:bg-red-600">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center text-gray-500">
                                Data user belum tersedia
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>

</div>

@endsection

@push('scripts')

<script>

// SWEETALERT
@if(session('message'))

Swal.fire({
    icon: @json(session('icon') ?? 'success'),
    title: @json(session('title') ?? 'Berhasil'),
    text: @json(session('message')),
    confirmButtonColor: '#6d28d9',
});

@endif

// DELETE
function deleteUser(id, name)
{
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data user "' + name + '" akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}

// LIVE SEARCH AJAX
let timeout;

document.getElementById('search').addEventListener('keyup', function () {

    clearTimeout(timeout);

    let keyword = this.value;

    timeout = setTimeout(() => {

        fetch(`{{ route('admin.users.index') }}?search=${keyword}`)
            .then(res => res.text())
            .then(html => {

                let parser = new DOMParser();
                let doc = parser.parseFromString(html, 'text/html');

                document.querySelector('#user-table').innerHTML =
                    doc.querySelector('#user-table').innerHTML;

            });

    }, 300);

});

</script>

@endpush
