@extends('layouts.operator')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold text-gray-900">
            Data Guru
        </h1>

        <a href="{{ route('operator.guru.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
            + Tambah Guru
        </a>

    </div>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}"
            });
        </script>
    @endif

    <!-- TABLE -->
    <div class="overflow-x-auto">

        <table class="min-w-full border bg-white">

            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">Nama</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">NIP</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($guru as $item)

                <tr class="border-t hover:bg-gray-50">

                    <td class="px-4 py-2">{{ $item->name }}</td>
                    <td class="px-4 py-2">{{ $item->email }}</td>
                    <td class="px-4 py-2">{{ $item->nip ?? '-' }}</td>

                    <td class="px-4 py-2 flex gap-2">

                        <!-- EDIT -->
                        <a href="{{ route('operator.guru.edit', $item->id) }}"
                           class="px-3 py-1 bg-amber-500 text-white rounded-md text-sm">
                            Edit
                        </a>

                        <!-- DELETE -->
                        <form action="{{ route('operator.guru.destroy', $item->id) }}"
                              method="POST"
                              class="delete-form">

                            @csrf
                            @method('DELETE')

                            <button type="button"
                                    class="delete-btn px-3 py-1 bg-red-600 text-white rounded-md text-sm">
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">
                        Tidak ada data guru
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-4">
        {{ $guru->links() }}
    </div>

</div>

<!-- SWEETALERT DELETE -->
<script>
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function () {

        let form = this.closest('.delete-form');

        Swal.fire({
            title: "Hapus Guru?",
            text: "Data tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc2626",
            cancelButtonColor: "#6b7280",
            confirmButtonText: "Ya, hapus"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });

    });
});
</script>

@endsection
