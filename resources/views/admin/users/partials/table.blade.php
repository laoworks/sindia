<tbody class="divide-y divide-gray-100 bg-white">

@forelse($users as $user)

<tr class="hover:bg-gray-50/70 transition duration-200">

    <td class="px-6 py-5 text-sm text-gray-500">
        {{ $users->firstItem() + $loop->index }}
    </td>

    <td class="px-6 py-5">
        @if($user->foto_profil)
            <img src="{{ asset('storage/' . $user->foto_profil) }}"
                 class="w-12 h-12 rounded-2xl object-cover border border-gray-200">
        @else
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-white font-bold text-sm"
                 style="background: oklch(45.7% 0.24 277.023)">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
        @endif
    </td>

    <td class="px-6 py-5 font-semibold text-gray-900">
        {{ $user->name }}
    </td>

    <td class="px-6 py-5 text-sm text-gray-500">
        {{ $user->email }}
    </td>

    <td class="px-6 py-5 text-sm text-gray-500">
        {{ $user->nip ?? '-' }}
    </td>

    <td class="px-6 py-5">
        <span class="inline-flex px-3 py-1 rounded-xl text-xs font-semibold"
              style="background: oklch(87% 0.065 274.039); color: oklch(45.7% 0.24 277.023);">
            {{ ucfirst(str_replace('_', ' ', $user->role)) }}
        </span>
    </td>

    <td class="px-6 py-5">
        @if($user->is_active)
            <span class="px-3 py-1 rounded-xl text-xs font-semibold bg-green-100 text-green-700">
                Aktif
            </span>
        @else
            <span class="px-3 py-1 rounded-xl text-xs font-semibold bg-red-100 text-red-700">
                Nonaktif
            </span>
        @endif
    </td>

    <td class="px-6 py-5 text-center">

        <a href="{{ route('admin.users.show', $user->id) }}"
           class="px-4 py-2 rounded-xl text-xs font-semibold text-white bg-blue-500">
            View
        </a>

    </td>

</tr>

@empty

<tr>
    <td colspan="8" class="text-center py-10 text-gray-500">
        Data tidak ditemukan
    </td>
</tr>

@endforelse

</tbody>
