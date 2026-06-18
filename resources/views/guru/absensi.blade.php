@extends('layouts.guru')

@section('content')
<div class="space-y-6">

    <h1 class="text-3xl font-bold">Absensi Guru (Selfie)</h1>
    <p class="text-gray-500">Wajib selfie saat absen</p>

    @if ($absensi && $absensi->waktu_masuk && $absensi->waktu_pulang)
        <div class="p-4 text-green-700 bg-green-100">
            Anda sudah melakukan semua absensi hari ini
        </div>
    @endif

    @if (session('success'))
        <div class="p-4 text-green-700 bg-green-100">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="p-4 text-red-700 bg-red-100">
            {{ session('error') }}
        </div>
    @endif

    <!-- CAMERA -->
    <div class="p-6 space-y-4 bg-white shadow">

        <video id="video" autoplay class="w-full border"></video>
        <canvas id="canvas" class="hidden"></canvas>

        <button type="button"
            onclick="startCamera()"
            class="px-4 py-2 text-white bg-gray-800">
            Aktifkan Kamera
        </button>

    </div>

    <!-- BUTTON -->
    <div class="flex gap-3">

        {{-- MASUK --}}
        <form method="POST" action="{{ route('guru.absensi.masuk') }}" onsubmit="return capture(this, 'foto_masuk')">
            @csrf
            <input type="hidden" name="foto" id="foto_masuk">

            <button type="submit"
                @if ($absensi && $absensi->waktu_masuk) disabled @endif
                class="px-5 py-3 text-white bg-green-600 disabled:opacity-50">
                Absen Masuk
            </button>
        </form>

        {{-- PULANG --}}
        <form method="POST" action="{{ route('guru.absensi.pulang') }}" onsubmit="return capture(this, 'foto_pulang')">
            @csrf
            <input type="hidden" name="foto" id="foto_pulang">

            <button type="submit"
                @if (!$absensi || $absensi->waktu_pulang) disabled @endif
                class="px-5 py-3 text-white bg-blue-600 disabled:opacity-50">
                Absen Pulang
            </button>
        </form>

    </div>

</div>

{{-- SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let video = document.getElementById('video');
let canvas = document.getElementById('canvas');
let stream = null;

function startCamera() {
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(s => {
            stream = s;
            video.srcObject = stream;
        })
        .catch(() => {
            Swal.fire('Error', 'Kamera tidak bisa diakses', 'error');
        });
}

function capture(form, inputId) {

    if (!stream) {
        Swal.fire('Peringatan', 'Aktifkan kamera dulu', 'warning');
        return false;
    }

    let ctx = canvas.getContext('2d');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    ctx.drawImage(video, 0, 0);

    let foto = canvas.toDataURL('image/png');

    document.getElementById(inputId).value = foto;

    return true; // 🔥 penting: baru submit POST
}
</script>

{{-- FLASH --}}
@if (session('success'))
<script>
Swal.fire('Berhasil', "{{ session('success') }}", 'success');
</script>
@endif

@if (session('error'))
<script>
Swal.fire('Gagal', "{{ session('error') }}", 'error');
</script>
@endif

@endsection
