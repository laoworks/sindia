@extends('layouts.operator')

@section('content')

<!-- TITLE -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">
        Dashboard Operator
    </h1>
    <p class="text-sm text-gray-500">
        Ringkasan data sistem sekolah
    </p>
</div>

<!-- STATS CARDS -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

    <div class="bg-white rounded-xl shadow-sm border p-5">
        <div class="text-sm text-gray-500">Total Guru</div>
        <div class="text-3xl font-bold text-blue-600 mt-1">
            {{ $guru ?? 0 }}
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border p-5">
        <div class="text-sm text-gray-500">Total Kelas</div>
        <div class="text-3xl font-bold text-green-600 mt-1">
            {{ $kelas ?? 0 }}
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border p-5">
        <div class="text-sm text-gray-500">Mata Pelajaran</div>
        <div class="text-3xl font-bold text-purple-600 mt-1">
            {{ $mapel ?? 0 }}
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border p-5">
        <div class="text-sm text-gray-500">Jadwal Aktif</div>
        <div class="text-3xl font-bold text-orange-600 mt-1">
            {{ $jadwal ?? 0 }}
        </div>
    </div>

</div>

<!-- ANALYTICS -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- CHART -->
    <div class="bg-white rounded-xl shadow-sm border p-6">

        <h2 class="font-semibold text-gray-800 mb-4">
            Aktivitas Absensi (7 Hari Terakhir)
        </h2>

        <canvas id="absensiChart" height="120"></canvas>

    </div>

    <!-- INFO -->
    <div class="bg-white rounded-xl shadow-sm border p-6">

        <h2 class="font-semibold text-gray-800 mb-4">
            Informasi Sistem
        </h2>

        <div class="space-y-3 text-sm">

            <div class="flex justify-between">
                <span class="text-gray-500">Status Server</span>
                <span class="text-green-600 font-semibold">Online</span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">Role Login</span>
                <span class="font-semibold capitalize">
                    {{ auth()->user()->role ?? '-' }}
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">Login sebagai</span>
                <span class="font-semibold">
                    {{ auth()->user()->name ?? '-' }}
                </span>
            </div>

        </div>

    </div>

</div>

@endsection


{{-- ================= CHART SAFE VERSION ================= --}}
@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const el = document.getElementById('absensiChart');
    if (!el) return;

    // SAFE DATA (ANTI ERROR TOKEN)
    const labels = @json($labels ?? []);
    const values = @json($values ?? []);

    new Chart(el, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Absensi',
                data: values,
                backgroundColor: 'rgba(59, 130, 246, 0.6)',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

});
</script>

@endpush
