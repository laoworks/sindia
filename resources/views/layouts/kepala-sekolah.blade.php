<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kepala Sekolah</title>

    <link rel="icon" type="image/png" href="/img/logo.png">
    <link rel="shortcut icon" href="/img/logo.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/feather-icons"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
@php
    $user = auth()->user();
    $active = fn ($route) => request()->routeIs($route) ? 'nav-link-dark-active' : '';
    $menu = [
        ['url' => route('kepala.dashboard'), 'route' => 'kepala.dashboard', 'icon' => 'home', 'label' => 'Dashboard'],
        ['url' => route('kepala.absensi.index'), 'route' => 'kepala.absensi.*', 'icon' => 'clipboard', 'label' => 'Laporan Absensi'],
    ];
@endphp
<body class="bg-slate-50 overflow-hidden">

<div x-data="{ sidebarOpen: false }" class="flex h-screen">
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        class="fixed inset-0 z-40 bg-black/30 lg:hidden"
        @click="sidebarOpen = false"></div>

    <aside
        class="fixed inset-y-0 left-0 z-50 flex w-72 transform flex-col bg-purple-900 text-white transition-transform duration-300 ease-in-out lg:static lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        <div class="border-b border-white/10 px-6 py-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.25em] text-purple-200">Panel</p>
                    <h1 class="mt-2 text-2xl font-bold">Kepala Sekolah</h1>
                    <p class="mt-1 text-sm text-purple-100/80">Monitoring absensi guru</p>
                </div>
                <button class="lg:hidden" @click="sidebarOpen = false">
                    <i data-feather="x" class="h-5 w-5"></i>
                </button>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto px-4 py-5">
            <nav class="space-y-2">
                @foreach($menu as $item)
                    <a href="{{ $item['url'] }}" class="nav-link-dark {{ $active($item['route']) }}">
                        <i data-feather="{{ $item['icon'] }}" class="h-5 w-5"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </div>

        <div class="border-t border-white/10 px-4 py-4">
            <div class="mb-4 bg-white/10 px-4 py-3">
                <p class="text-sm font-semibold">{{ $user->name }}</p>
                <p class="text-xs text-purple-100/80">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex w-full items-center justify-center gap-2 bg-white px-4 py-3 text-sm font-semibold text-purple-800 transition hover:bg-purple-50">
                    <i data-feather="log-out" class="h-4 w-4"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="flex min-w-0 flex-1 flex-col">
        <header class="flex items-center justify-between border-b border-slate-200 bg-white px-4 py-4 lg:px-6">
            <button class="lg:hidden" @click="sidebarOpen = true">
                <i data-feather="menu" class="h-5 w-5 text-slate-700"></i>
            </button>

            <div>
                <h2 class="text-lg font-semibold text-slate-900">Kepala Sekolah</h2>
                <p class="text-xs text-slate-500">Ringkasan pemantauan kehadiran guru</p>
            </div>

            <div class="hidden text-right sm:block">
                <p class="text-sm font-semibold text-slate-800">{{ $user->name }}</p>
                <p class="text-xs text-slate-500">{{ now()->translatedFormat('d F Y') }}</p>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-4 lg:p-6">
            @yield('content')
        </main>
    </div>
</div>

<script>feather.replace();</script>
</body>
</html>
