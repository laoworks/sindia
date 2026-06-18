@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="flex flex-col gap-4 mb-8">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                <div>

                    <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                        Data User
                    </h1>

                    <p class="text-sm text-gray-500 mt-2">
                        Kelola seluruh user sistem absensi guru
                    </p>

                </div>

                <!-- Button -->
                <div class="flex justify-end">

                    <a href="{{ route('admin.users.create') }}"
                        class="inline-flex items-center px-5 py-3 text-sm font-semibold text-white shadow-sm hover:opacity-90 transition duration-200"
                        style="background: oklch(45.7% 0.24 277.023)">
                        Tambah User
                    </a>

                </div>

            </div>

            <!-- SEARCH (SUDAH DIPERBAIKI) -->
            <div class="flex justify-start">

                <input type="text" id="search" value="{{ request('search') }}"
                    placeholder="Cari nama, email, atau NIP..."
                    class="w-full lg:w-1/3 px-4 py-3 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">

            </div>

        </div>

        <!-- Card -->
        <div class="bg-white border border-gray-100 shadow-sm overflow-hidden">

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead style="background: oklch(97% 0.01 286)" class="border-b border-gray-100">

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
                        @include('admin.users.partials.table', ['users' => $users])
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
        @if (session('message'))

            Swal.fire({
                icon: @json(session('icon') ?? 'success'),
                title: @json(session('title') ?? 'Berhasil'),
                text: @json(session('message')),
                confirmButtonColor: '#6d28d9',
            });
        @endif

        // DELETE
        function deleteUser(id, name) {
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

        document.getElementById('search').addEventListener('keyup', function() {

            clearTimeout(timeout);

            let keyword = this.value;

            timeout = setTimeout(() => {

                fetch(`{{ route('admin.users.index') }}?search=${encodeURIComponent(keyword)}`)
                    .then(res => res.text())
                    .then(html => {
                        document.querySelector('#user-table').innerHTML = html;
                    });

            }, 300);

        });
    </script>
@endpush
