<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- FAVICON - Logo di samping nama website -->
    <link rel="icon" type="image/png" href="/img/logo.png">
    <link rel="shortcut icon" href="/img/logo.png">
    <link rel="apple-touch-icon" href="/img/logo.png">

    <!-- Untuk mendukung berbagai ukuran -->
    <link rel="icon" type="image/png" sizes="16x16" href="/img/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/logo.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/logo.png">



    <title>Guru Panel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/feather-icons"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

@php
    $user = auth()->user();
@endphp

<body class="bg-white overflow-hidden">

<div x-data="{ sidebarOpen: false }" class="h-screen flex">

    <!-- OVERLAY -->
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        class="fixed inset-0 bg-black/30 z-40 lg:hidden"
        @click="sidebarOpen = false"
    ></div>

   <!-- SIDEBAR -->
<aside
    class="fixed lg:static inset-y-0 left-0 z-50
           w-72 bg-white border-r border-gray-100
           transform transition-transform duration-300 ease-in-out
           lg:translate-x-0 flex flex-col"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
>

    @php
        $user = auth()->user();
    @endphp

    <!-- HEADER (SAMA STYLE OPERATOR) -->
    <div class="px-6 py-5 border-b border-gray-100">

        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-2xl font-bold"
                    style="color: oklch(45.7% 0.24 277.023)">
                    GURU PANEL
                </h1>

                <!-- PROFILE MINI -->
                <div class="flex items-center gap-3 mt-3">





                </div>

            </div>

            <button class="lg:hidden"
                    @click="sidebarOpen = false">
                <i data-feather="x"></i>
            </button>

        </div>

    </div>

    <!-- MENU (DISESUAIKAN STYLE OPERATOR) -->
    <div class="flex-1 overflow-y-auto px-4 py-5">

        <nav class="space-y-2">

            <!-- DASHBOARD -->
            <a href="{{ route('guru.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all
               {{ request()->routeIs('guru.dashboard') ? '' : 'hover:bg-gray-50' }}"
               style="color: oklch(45.7% 0.24 277.023);
               background: {{ request()->routeIs('guru.dashboard') ? 'oklch(87% 0.065 274.039)' : 'transparent' }};">

                <i data-feather="home" class="w-5 h-5"></i>
                <span class="font-semibold">Dashboard</span>

            </a>

            <!-- JADWAL -->
            <a href="{{ route('guru.jadwal') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all
               {{ request()->routeIs('guru.jadwal') ? '' : 'hover:bg-gray-50' }}"
               style="color: oklch(45.7% 0.24 277.023);
               background: {{ request()->routeIs('guru.jadwal') ? 'oklch(87% 0.065 274.039)' : 'transparent' }};">

                <i data-feather="calendar" class="w-5 h-5"></i>
                <span class="font-medium">Jadwal Mengajar</span>

            </a>

            <!-- ABSENSI -->
            <a href="{{ route('guru.absensi') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all
               {{ request()->routeIs('guru.absensi') ? '' : 'hover:bg-gray-50' }}"
               style="color: oklch(45.7% 0.24 277.023);
               background: {{ request()->routeIs('guru.absensi') ? 'oklch(87% 0.065 274.039)' : 'transparent' }};">

                <i data-feather="clipboard" class="w-5 h-5"></i>
                <span class="font-medium">Absensi</span>

            </a>

            <!-- LAPORAN -->
            <a href="{{ route('guru.laporan') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all
               {{ request()->routeIs('guru.laporan') ? '' : 'hover:bg-gray-50' }}"
               style="color: oklch(45.7% 0.24 277.023);
               background: {{ request()->routeIs('guru.laporan') ? 'oklch(87% 0.065 274.039)' : 'transparent' }};">

                <i data-feather="bar-chart-2" class="w-5 h-5"></i>
                <span class="font-medium">Laporan</span>

            </a>

            <!-- PROFILE -->
            <a href="{{ route('guru.profile.edit') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all
               {{ request()->routeIs('guru.profile.*') ? '' : 'hover:bg-gray-50' }}"
               style="color: oklch(45.7% 0.24 277.023);
               background: {{ request()->routeIs('guru.profile.*') ? 'oklch(87% 0.065 274.039)' : 'transparent' }};">

                <i data-feather="user" class="w-5 h-5"></i>
                <span class="font-medium">Profile</span>

            </a>

        </nav>

    </div>

    <!-- FOOTER (SAMA STYLE OPERATOR) -->
    <div class="p-4 border-t border-gray-100">

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-2xl hover:bg-red-50 text-red-500">

                <i data-feather="log-out" class="w-5 h-5"></i>
                <span class="font-medium">Logout</span>

            </button>

        </form>

    </div>

</aside>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col min-w-0 h-screen">

        <!-- TOPBAR -->
        <header class="bg-white border-b border-gray-100 px-4 lg:px-6 py-4 flex items-center justify-between shrink-0">

            <button class="lg:hidden" @click="sidebarOpen = true">
                <i data-feather="menu"></i>
            </button>

            <h2 class="text-lg font-semibold">
                Guru Dashboard
            </h2>

            <div class="flex items-center gap-3">

                <div class="hidden sm:block text-right">
                    <p class="font-semibold text-sm">{{ $user->name }}</p>
                    <p class="text-xs text-gray-500">{{ ucfirst($user->role) }}</p>
                </div>

                <div class="w-10 h-10 rounded-xl overflow-hidden bg-gray-200">

                    @if($user->foto_profil)
                        <img src="{{ asset('storage/' . $user->foto_profil) }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-white font-bold"
                             style="background: oklch(45.7% 0.24 277.023)">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif

                </div>

            </div>

        </header>

        <!-- CONTENT -->
        <main class="flex-1 overflow-y-auto p-4 lg:p-6">
            @yield('content')
        </main>

    </div>

</div>

<script>
    feather.replace()
</script>

</body>
</html>
