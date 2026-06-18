@extends('layouts.kepala-sekolah')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-2 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Laporan Absensi Guru</h1>
            <p class="mt-2 text-sm text-slate-500">
                Pantau kehadiran guru berdasarkan periode, nama guru, dan status masuk.
            </p>
        </div>
    </div>

    <!-- STATISTIK -->
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div class="p-5 bg-white shadow-sm ring-1 ring-slate-100">
            <p class="text-sm text-slate-500">Total Data</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalData }}</p>
        </div>

        <div class="p-5 bg-white shadow-sm ring-1 ring-slate-100">
            <p class="text-sm text-slate-500">Tepat Waktu</p>
            <p class="mt-2 text-3xl font-bold text-green-600">{{ $tepatWaktu }}</p>
        </div>

        <div class="p-5 bg-white shadow-sm ring-1 ring-slate-100">
            <p class="text-sm text-slate-500">Terlambat</p>
            <p class="mt-2 text-3xl font-bold text-red-500">{{ $terlambat }}</p>
        </div>

        <div class="p-5 bg-white shadow-sm ring-1 ring-slate-100">
            <p class="text-sm text-slate-500">Belum Pulang</p>
            <p class="mt-2 text-3xl font-bold text-amber-500">{{ $belumPulang }}</p>
        </div>
    </div>

    <!-- FILTER -->
    <form method="GET" action="{{ route('kepala.absensi.index') }}" class="grid grid-cols-1 gap-4 p-5 bg-white shadow-sm ring-1 ring-slate-100 lg:grid-cols-5">
        <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">Dari</label>
            <input type="date" name="dari" value="{{ request('dari') }}" class="w-full text-sm border-slate-200 focus:border-purple-500 focus:ring-purple-500">
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">Sampai</label>
            <input type="date" name="sampai" value="{{ request('sampai') }}" class="w-full text-sm border-slate-200 focus:border-purple-500 focus:ring-purple-500">
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">Guru</label>
            <select name="user_id" class="w-full text-sm border-slate-200 focus:border-purple-500 focus:ring-purple-500">
                <option value="">Semua Guru</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}" @selected((string) request('user_id') === (string) $user->id)>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">Status Masuk</label>
            <select name="status_masuk" class="w-full text-sm border-slate-200 focus:border-purple-500 focus:ring-purple-500">
                <option value="">Semua Status</option>
                <option value="tepat_waktu" @selected(request('status_masuk') === 'tepat_waktu')>Tepat Waktu</option>
                <option value="terlambat" @selected(request('status_masuk') === 'terlambat')>Terlambat</option>
            </select>
        </div>

        <div class="flex items-end gap-3">
            <button type="submit" class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-semibold text-white transition bg-purple-700 hover:bg-purple-800">
                Filter
            </button>
            <a href="{{ route('kepala.absensi.index') }}" class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-semibold transition border border-slate-200 text-slate-600 hover:bg-slate-50">
                Reset
            </a>
        </div>
    </form>

    <!-- TABEL -->
    <div class="overflow-hidden bg-white shadow-sm ring-1 ring-slate-100">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">Tanggal</th>
                        <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">Guru</th>
                        <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">Masuk</th>
                        <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">Foto Masuk</th>
                        <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">Pulang</th>
                        <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">Foto Pulang</th>
                        <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($absensi as $item)
                    <tr class="hover:bg-slate-50/70">
                        <td class="px-6 py-4 text-sm text-slate-600">
                            {{ optional($item->tanggal)->translatedFormat('d F Y') ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-slate-900">{{ $item->user->name ?? '-' }}</div>
                            <div class="text-xs text-slate-500">{{ $item->user->nip ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            {{ optional($item->waktu_masuk)->format('H:i') ?? '-' }}
                        </td>
                        <!-- FOTO MASUK -->
                        <td class="px-6 py-4">
                            @if($item->foto_masuk)
                                <img src="{{ asset('storage/' . $item->foto_masuk) }}"
                                    class="object-cover w-12 h-12 transition border rounded-lg cursor-pointer border-slate-200 hover:opacity-80"
                                    onclick="openModal('{{ asset('storage/' . $item->foto_masuk) }}')"
                                    title="Klik untuk perbesar">
                            @else
                                <span class="text-sm text-slate-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            {{ optional($item->waktu_pulang)->format('H:i') ?? '-' }}
                        </td>
                        <!-- FOTO PULANG -->
                        <td class="px-6 py-4">
                            @if($item->foto_pulang)
                                <img src="{{ asset('storage/' . $item->foto_pulang) }}"
                                    class="object-cover w-12 h-12 transition border rounded-lg cursor-pointer border-slate-200 hover:opacity-80"
                                    onclick="openModal('{{ asset('storage/' . $item->foto_pulang) }}')"
                                    title="Klik untuk perbesar">
                            @else
                                <span class="text-sm text-slate-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-3 py-1 text-xs font-semibold {{ $item->status_masuk === 'terlambat' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                {{ $item->status_masuk === 'terlambat' ? 'Terlambat' : 'Tepat Waktu' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 text-sm text-center py-14 text-slate-500">
                            Belum ada data absensi yang sesuai filter.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- PAGINATION -->
    <div>
        {{ $absensi->links() }}
    </div>
</div>

<!-- ============================================ -->
<!-- MODAL UNTUK PERBESAR GAMBAR -->
<!-- ============================================ -->
<div id="imageModal" class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 bg-black bg-opacity-75"
    onclick="closeModal()">
    <div class="relative w-full max-w-4xl" onclick="event.stopPropagation()">
        <img id="modalImage" src="" alt="Foto Absensi"
            class="w-full h-auto max-h-[90vh] object-contain rounded-lg shadow-2xl">
        <button onclick="closeModal()"
            class="absolute right-0 text-3xl text-white transition -top-12 hover:text-gray-300">
            ✕
        </button>
    </div>
</div>

<style>
    #imageModal {
        animation: fadeIn 0.2s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    #modalImage {
        animation: zoomIn 0.3s ease-out;
    }
    @keyframes zoomIn {
        from { transform: scale(0.8); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
</style>

<script>
    function openModal(imageSrc) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageSrc;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Tutup modal dengan ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
</script>
@endsection
