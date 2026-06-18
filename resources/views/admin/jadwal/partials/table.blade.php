@forelse($jadwal as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->guru?->name ?? '-' }}</td>
        <td>{{ $item->kelas?->nama_kelas ?? '-' }}</td>
        <td>{{ $item->mapel?->nama_mapel ?? '-' }}</td>
        <td>{{ $item->hari }}</td>
        <td>{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>

        <td>
            <a href="{{ route('admin.jadwal.show', $item->id) }}">View</a>
        </td>
    </tr>

@empty
    <tr>
        <td colspan="7" class="text-center py-6">Data kosong</td>
    </tr>
@endforelse
