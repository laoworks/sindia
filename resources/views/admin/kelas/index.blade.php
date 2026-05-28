@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">

        <div>
            <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                Data Kelas
            </h1>

            <p class="text-sm text-gray-500 mt-2">
                Kelola data kelas
            </p>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.kelas.create') }}"
               class="inline-flex items-center px-5 py-3 rounded-2xl text-sm font-semibold text-white shadow-sm hover:opacity-90 transition"
               style="background: oklch(45.7% 0.24 277.023)">
                Tambah Kelas
            </a>
        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead style="background: oklch(97% 0.01 286)"
                       class="border-b border-gray-100">

                    <tr>
                        <th class="px-6 py-5 text-left text-xs font-semibold uppercase text-gray-500">No</th>
                        <th class="px-6 py-5 text-left text-xs font-semibold uppercase text-gray-500">Nama Kelas</th>
                        <th class="px-6 py-5 text-left text-xs font-semibold uppercase text-gray-500">Jurusan</th>
                        <th class="px-6 py-5 text-center text-xs font-semibold uppercase text-gray-500">Aksi</th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">

                    @forelse($kelas as $item)

                        <tr class="hover:bg-gray-50/70 transition">

                            <td class="px-6 py-5 text-sm text-gray-500">
                                {{ $kelas->firstItem() + $loop->index }}
                            </td>

                            <td class="px-6 py-5 font-semibold text-gray-900">
                                {{ $item->nama_kelas }}
                            </td>

                            <td class="px-6 py-5 text-gray-600">
                                {{ $item->jurusan }}
                            </td>

                            <td class="px-6 py-5">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('admin.kelas.show', $item->id) }}"
                                       class="px-4 py-2 rounded-xl text-xs font-semibold text-white bg-blue-500 hover:bg-blue-600">
                                        View
                                    </a>

                                    <a href="{{ route('admin.kelas.edit', $item->id) }}"
                                       class="px-4 py-2 rounded-xl text-xs font-semibold text-white bg-yellow-500 hover:bg-yellow-600">
                                        Edit
                                    </a>

                                    <!-- DELETE SWEETALERT -->
                                    <button
                                        type="button"
                                        onclick="deleteKelas({{ $item->id }}, @js($item->nama_kelas))"
                                        class="px-4 py-2 rounded-xl text-xs font-semibold text-white bg-red-500 hover:bg-red-600">
                                        Delete
                                    </button>

                                    <form id="delete-form-{{ $item->id }}"
                                          action="{{ route('admin.kelas.destroy', $item->id) }}"
                                          method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="text-center py-16 text-gray-500">
                                Data kelas belum tersedia
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- PAGINATION -->
    <div class="mt-6">
        {{ $kelas->links() }}
    </div>

</div>

@endsection

@push('scripts')

{{-- SUCCESS ALERT --}}
@if(session('message'))
<script>
    Swal.fire({
        icon: @json(session('icon') ?? 'success'),
        title: @json(session('title') ?? 'Berhasil'),
        text: @json(session('message')),
        confirmButtonColor: '#6d28d9'
    });
</script>
@endif

{{-- DELETE SWEETALERT --}}
<script>
function deleteKelas(id, nama)
{
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data kelas "' + nama + '" akan dihapus!',
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
</script>

@endpush
