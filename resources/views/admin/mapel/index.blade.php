@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">

        <div>
            <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                Mata Pelajaran
            </h1>
            <p class="text-sm text-gray-500 mt-2">
                Kelola data mata pelajaran
            </p>
        </div>

        <div class="flex justify-end">

            <a href="{{ route('admin.mapel.create') }}"
               class="inline-flex items-center px-5 py-3 rounded-2xl text-sm font-semibold text-white shadow-sm hover:opacity-90 transition"
               style="background: oklch(45.7% 0.24 277.023)">
                Tambah Mapel
            </a>

        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden shadow-sm">

        <table class="min-w-full">

            <thead style="background: oklch(97% 0.01 286)">
                <tr>
                    <th class="px-6 py-5 text-left text-xs font-semibold uppercase text-gray-500">No</th>
                    <th class="px-6 py-5 text-left text-xs font-semibold uppercase text-gray-500">Nama Mapel</th>
                    <th class="px-6 py-5 text-left text-xs font-semibold uppercase text-gray-500">KKM</th>
                    <th class="px-6 py-5 text-center text-xs font-semibold uppercase text-gray-500">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 bg-white">

                @forelse($mapel as $item)

                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-5 text-sm text-gray-500">
                        {{ $mapel->firstItem() + $loop->index }}
                    </td>

                    <td class="px-6 py-5 font-semibold text-gray-900">
                        {{ $item->nama_mapel }}
                    </td>

                    <td class="px-6 py-5">
                        <span class="px-3 py-1 rounded-xl text-xs font-semibold bg-blue-100 text-blue-700">
                            {{ $item->kkm }}
                        </span>
                    </td>

                    <td class="px-6 py-5">

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('admin.mapel.show', $item->id) }}"
                               class="px-4 py-2 text-white bg-blue-500 rounded-xl text-xs">
                                View
                            </a>

                            <a href="{{ route('admin.mapel.edit', $item->id) }}"
                               class="px-4 py-2 text-white bg-yellow-500 rounded-xl text-xs">
                                Edit
                            </a>

                            <!-- DELETE with SWEETALERT -->
                            <button type="button"
                                    onclick="deleteMapel({{ $item->id }}, @js($item->nama_mapel))"
                                    class="px-4 py-2 text-white bg-red-500 rounded-xl text-xs">
                                Delete
                            </button>

                            <form id="delete-form-{{ $item->id }}"
                                  action="{{ route('admin.mapel.destroy', $item->id) }}"
                                  method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="4" class="text-center py-10 text-gray-500">
                        Data tidak tersedia
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div class="mt-6">
        {{ $mapel->links() }}
    </div>

</div>

@endsection


@push('scripts')

{{-- ✅ SWEETALERT SUCCESS --}}
@if(session('message'))
<script>
    Swal.fire({
        icon: @json(session('icon') ?? 'success'),
        title: @json(session('title') ?? 'Berhasil'),
        text: @json(session('message')),
        confirmButtonColor: '#6d28d9',
    });
</script>
@endif

{{-- ✅ SWEETALERT DELETE --}}
<script>
function deleteMapel(id, name)
{
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data mapel "' + name + '" akan dihapus!',
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
