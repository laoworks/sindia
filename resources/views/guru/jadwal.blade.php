@extends('layouts.guru')

@section('content')
    <div class="max-w-7xl mx-auto">

        <!-- HEADER -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold">
                Jadwal Mengajar
            </h1>

            <p class="text-gray-500">
                Daftar jadwal mengajar Anda
            </p>
        </div>

        <!-- TABLE -->
        <div class="bg-white shadow overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-4 text-left">Hari</th>
                        <th class="p-4 text-left">Mapel</th>
                        <th class="p-4 text-left">Kelas</th>
                        <th class="p-4 text-left">Jam</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $jadwal = \App\Models\Jadwal::with(['mapel', 'kelas'])
                            ->where('guru_id', auth()->id())
                            ->orderBy('hari')
                            ->get();
                    @endphp

                    @forelse($jadwal as $item)
                        <tr class="border-t hover:bg-gray-50">

                            <td class="p-4">
                                {{ $item->hari }}
                            </td>

                            <td class="p-4 font-semibold">
                                {{ $item->mapel->nama_mapel ?? '-' }}
                            </td>

                            <td class="p-4">
                                {{ $item->kelas->nama_kelas ?? '-' }}
                            </td>

                            <td class="p-4">
                                {{ $item->jam_mulai }} - {{ $item->jam_selesai }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="text-center py-10 text-gray-500">
                                Tidak ada jadwal mengajar
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
@endsection
