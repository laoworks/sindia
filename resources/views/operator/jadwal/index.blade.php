@extends('layouts.operator')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold text-gray-900">
            Data Jadwal
        </h1>

        <a href="{{ route('operator.jadwal.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
            + Tambah Jadwal
        </a>

    </div>

    <!-- FILTER -->
    <form method="GET" class="mb-6">
        <select name="hari" class="border px-3 py-2 rounded-md">
            <option value="">Semua Hari</option>
            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
                <option value="{{ $h }}" {{ request('hari') == $h ? 'selected' : '' }}>
                    {{ $h }}
                </option>
            @endforeach
        </select>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded-md">
            Filter
        </button>
    </form>

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
                    <th class="px-4 py-2">Guru</th>
                    <th class="px-4 py-2">Kelas</th>
                    <th class="px-4 py-2">Mapel</th>
                    <th class="px-4 py-2">Hari</th>
                    <th class="px-4 py-2">Jam</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($jadwal as $item)

                <tr class="border-t hover:bg-gray-50">

                    <td class="px-4 py-2">{{ $item->guru->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $item->kelas->nama_kelas ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $item->mapel->nama_mapel ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $item->hari }}</td>
                    <td class="px-4 py-2">
                        {{ $item->jam_mulai }} - {{ $item->jam_selesai }}
                    </td>

                    <td class="px-4 py-2 flex gap-2">

                        <!-- EDIT -->
                        <a href="{{ route('operator.jadwal.edit', $item->id) }}"
                           class="px-3 py-1 bg-amber-500 text-white rounded-md text-sm">
                            Edit
                        </a>

                        <!-- DELETE -->
                        <form action="{{ route('operator.jadwal.destroy', $item->id) }}"
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
                        <td colspan="6" class="text-center py-4 text-gray-500">
                            Tidak ada data
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

<script>
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function () {

        let form = this.closest('.delete-form');

        Swal.fire({
            title: "Hapus jadwal?",
            text: "Data tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
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
