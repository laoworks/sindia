@extends('layouts.operator')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-md">

    <h1 class="text-2xl font-bold mb-6 text-gray-900">
        Edit Jadwal
    </h1>

    <form action="{{ route('operator.jadwal.update', $jadwal->id) }}"
          method="POST"
          class="space-y-4">

        @csrf
        @method('PUT')

        <!-- GURU -->
        <div>
            <label class="block text-sm font-medium">Guru</label>
            <select name="guru_id" class="w-full border rounded-md p-2">
                @foreach($guru as $g)
                    <option value="{{ $g->id }}"
                        {{ $jadwal->guru_id == $g->id ? 'selected' : '' }}>
                        {{ $g->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- KELAS -->
        <div>
            <label class="block text-sm font-medium">Kelas</label>
            <select name="kelas_id" class="w-full border rounded-md p-2">
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}"
                        {{ $jadwal->kelas_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- MAPEL -->
        <div>
            <label class="block text-sm font-medium">Mapel</label>
            <select name="mapel_id" class="w-full border rounded-md p-2">
                @foreach($mapel as $m)
                    <option value="{{ $m->id }}"
                        {{ $jadwal->mapel_id == $m->id ? 'selected' : '' }}>
                        {{ $m->nama_mapel }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- HARI -->
        <div>
            <label class="block text-sm font-medium">Hari</label>
            <select name="hari" class="w-full border rounded-md p-2">
                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
                    <option value="{{ $h }}"
                        {{ $jadwal->hari == $h ? 'selected' : '' }}>
                        {{ $h }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- JAM -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Jam Mulai</label>
                <input type="time"
                       name="jam_mulai"
                       value="{{ $jadwal->jam_mulai }}"
                       class="w-full border rounded-md p-2">
            </div>

            <div>
                <label>Jam Selesai</label>
                <input type="time"
                       name="jam_selesai"
                       value="{{ $jadwal->jam_selesai }}"
                       class="w-full border rounded-md p-2">
            </div>
        </div>

        <!-- BUTTON -->
        <div class="flex gap-2 pt-4">

            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Update
            </button>

            <a href="{{ route('operator.jadwal.index') }}"
               class="bg-gray-300 px-4 py-2 rounded-md">
                Cancel
            </a>

        </div>

    </form>

</div>

@endsection
