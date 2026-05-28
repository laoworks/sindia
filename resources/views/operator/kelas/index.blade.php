@extends('layouts.operator')

@section('content')

<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold text-gray-900">
            Data Kelas
        </h1>

        <a href="{{ route('operator.kelas.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
            + Tambah Kelas
        </a>

    </div>

    <!-- SUCCESS ALERT -->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
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

    <!-- TABLE -->
    <div class="overflow-x-auto">

        <table class="min-w-full border bg-white">

            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">Nama Kelas</th>
                    <th class="px-4 py-2 text-left">Jurusan</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($kelas as $k)

                <tr class="border-t hover:bg-gray-50">

                    <td class="px-4 py-2">
                        {{ $k->nama_kelas }}
                    </td>

                    <td class="px-4 py-2">
                        {{ $k->jurusan }}
                    </td>

                    <td class="px-4 py-2 flex gap-2">

                        <!-- EDIT -->
                        <a href="{{ route('operator.kelas.edit', $k->id) }}"
                           class="bg-amber-500 text-white px-3 py-1 rounded text-sm hover:bg-amber-600">
                            Edit
                        </a>

                        <!-- DELETE -->
                        <form method="POST"
                              action="{{ route('operator.kelas.destroy', $k->id) }}"
                              class="delete-form">

                            @csrf
                            @method('DELETE')

                            <button type="button"
                                    class="delete-btn bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="3" class="text-center py-4 text-gray-500">
                        Tidak ada data kelas
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-4">
        {{ $kelas->links() }}
    </div>

</div>

@endsection

@push('scripts')

<!-- DELETE SWEETALERT FIX 100% WORK -->
<script>
document.addEventListener('click', function (e) {

    const btn = e.target.closest('.delete-btn');
    if (!btn) return;

    e.preventDefault();

    const form = btn.closest('.delete-form');
    if (!form) return;

    Swal.fire({
        title: "Yakin hapus data?",
        text: "Data tidak bisa dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc2626",
        cancelButtonColor: "#6b7280",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal",
        reverseButtons: true
    }).then((result) => {

        if (result.isConfirmed) {

            Swal.fire({
                title: "Menghapus...",
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            form.submit();
        }

    });

});
</script>

@endpush
