@extends('layouts.operator')

@section('content')

<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold text-gray-900">
            Data Mata Pelajaran
        </h1>

        <a href="{{ route('operator.mapel.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            + Tambah Mapel
        </a>

    </div>

    <!-- SUCCESS -->
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
                    <th class="px-4 py-2 text-left">Nama Mapel</th>
                    <th class="px-4 py-2 text-left">KKM</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($mapel as $m)

                <tr class="border-t hover:bg-gray-50">

                    <td class="px-4 py-2">
                        {{ $m->nama_mapel }}
                    </td>

                    <td class="px-4 py-2">
                        {{ $m->kkm }}
                    </td>

                    <td class="px-4 py-2 flex gap-2">

                        <!-- EDIT -->
                        <a href="{{ route('operator.mapel.edit', $m->id) }}"
                           class="bg-amber-500 text-white px-3 py-1 rounded text-sm hover:bg-amber-600">
                            Edit
                        </a>

                        <!-- DELETE -->
                        <form method="POST"
                              action="{{ route('operator.mapel.destroy', $m->id) }}"
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
                        Tidak ada data mapel
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection

@push('scripts')

<script>
document.addEventListener('click', function (e) {

    const btn = e.target.closest('.delete-btn');
    if (!btn) return;

    const form = btn.closest('.delete-form');

    Swal.fire({
        title: "Hapus Mata Pelajaran?",
        text: "Data tidak bisa dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc2626",
        cancelButtonColor: "#6b7280",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal"
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
