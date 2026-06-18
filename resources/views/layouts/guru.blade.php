<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru Panel</title>

    <link rel="icon" type="image/png" href="/img/logo.png">
    <link rel="shortcut icon" href="/img/logo.png">
    <link rel="apple-touch-icon" href="/img/logo.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/feather-icons"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Warna menu sidebar - disamakan dengan bg */
        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            border-radius: 8px;
            color: oklch(45.7% 0.24 277.023);
            transition: all 0.2s ease;
            font-weight: 500;
            text-decoration: none;
        }

        .nav-link:hover {
            background-color: #f3f4f6;
            color: oklch(45.7% 0.24 277.023);
        }

        .nav-link-active {
            background-color: #e5e7eb;
            color: oklch(45.7% 0.24 277.023);
        }

        .nav-link i,
        .nav-link svg {
            width: 20px;
            height: 20px;
        }
    </style>
</head>
@php
    $user = auth()->user();
    $active = fn ($route) => request()->routeIs($route) ? 'nav-link-active' : '';
    $menu = [
        ['url' => route('guru.dashboard'), 'route' => 'guru.dashboard', 'icon' => 'home', 'label' => 'Dashboard'],
        ['url' => route('guru.jadwal'), 'route' => 'guru.jadwal', 'icon' => 'calendar', 'label' => 'Jadwal Mengajar'],
        ['url' => route('guru.absensi'), 'route' => 'guru.absensi', 'icon' => 'clipboard', 'label' => 'Absensi'],
        ['url' => route('guru.laporan'), 'route' => 'guru.laporan', 'icon' => 'bar-chart-2', 'label' => 'Laporan'],
        ['url' => route('guru.profile.edit'), 'route' => 'guru.profile.*', 'icon' => 'user', 'label' => 'Profile'],
    ];
@endphp
<body class="overflow-hidden bg-white">

<div x-data="{ sidebarOpen: false }" class="flex h-screen">
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        class="fixed inset-0 z-40 bg-black/30 lg:hidden"
        @click="sidebarOpen = false"></div>

    <aside
        class="fixed inset-y-0 left-0 z-50 flex flex-col transition-transform duration-300 ease-in-out transform sidebar lg:static w-72 lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        <div class="px-6 py-5 border-b border-slate-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <!-- Logo di sidebar -->
                    <div class="flex-shrink-0 w-10 h-10">
                        <img src="/img/logo.png" alt="Logo" class="object-contain w-full h-full">
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold" style="color: oklch(45.7% 0.24 277.023)">GURU PANEL</h1>
                        <p class="text-xs" style="color: oklch(45.7% 0.24 277.023 / 70%)">Guru Matematika</p>
                    </div>
                </div>
                <button class="lg:hidden" @click="sidebarOpen = false">
                    <i data-feather="x"></i>
                </button>
            </div>
        </div>

        <div class="flex-1 px-4 py-5 overflow-y-auto">
            <nav class="space-y-1">
                @foreach($menu as $item)
                    <a href="{{ $item['url'] }}" class="nav-link {{ $active($item['route']) }}">
                        <i data-feather="{{ $item['icon'] }}" class="w-5 h-5"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </div>

        <div class="p-4 border-t border-slate-200">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center justify-center w-full gap-2 px-4 py-3 text-red-500 transition duration-200 rounded-lg hover:bg-red-50">
                    <i data-feather="log-out" class="w-5 h-5"></i>
                    <span class="font-medium">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="flex flex-col flex-1 h-screen min-w-0">
        <header class="flex items-center justify-between px-4 py-4 bg-white border-b border-gray-100 lg:px-6 shrink-0">
            <button class="lg:hidden" @click="sidebarOpen = true">
                <i data-feather="menu"></i>
            </button>

            <h2 class="text-lg font-semibold">Guru Dashboard</h2>

            <div class="flex items-center gap-3">
                <div class="hidden text-right sm:block">
                    <p class="text-sm font-semibold">{{ $user->name }}</p>
                    <p class="text-xs text-gray-500">{{ ucfirst($user->role) }}</p>
                </div>
                <div class="w-10 h-10 overflow-hidden bg-gray-200 rounded-full">
                    @if($user->foto_profil)
                        <img src="{{ asset('storage/' . $user->foto_profil) }}" class="object-cover w-full h-full">
                    @else
                        <div class="flex items-center justify-center w-full h-full font-bold text-white rounded-full" style="background: oklch(45.7% 0.24 277.023)">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
            </div>
        </header>

        <main class="flex-1 p-4 overflow-y-auto lg:p-6">
            @yield('content')
        </main>
    </div>
</div>

<script>feather.replace();</script>
</body>
</html>
