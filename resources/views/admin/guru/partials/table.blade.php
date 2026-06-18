@forelse($gurus as $guru)
    <tr class="border-t hover:bg-gray-50/60 transition">
        <td class="px-6 py-5">
            {{ $gurus->firstItem() + $loop->index }}
        </td>

        <td class="px-6 py-5 font-semibold">
            {{ $guru->name }}
        </td>

        <td class="px-6 py-5">
            {{ $guru->email }}
        </td>

        <td class="px-6 py-5">
            {{ $guru->nip ?? '-' }}
        </td>

        <td class="px-6 py-5">
            @if ($guru->is_active)
                <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-700">
                    Aktif
                </span>
            @else
                <span class="px-3 py-1 text-xs font-semibold bg-red-100 text-red-700">
                    Nonaktif
                </span>
            @endif
        </td>

        <td class="px-6 py-5 text-center">
            <a href="{{ route('admin.guru.show', $guru->id) }}"
                class="px-4 py-2 text-xs font-semibold text-white bg-purple-600 hover:bg-purple-700">
                View
            </a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center py-10 text-gray-500">
            Tidak ada data guru
        </td>
    </tr>
@endforelse
