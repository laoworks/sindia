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



    <title>Operator Panel</title>

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

        <!-- HEADER -->
        <div class="px-5 py-4 border-b border-gray-100">

            <div class="flex items-center justify-between">

                <div>

                    <h1 class="text-xl font-bold"
                        style="color: oklch(45.7% 0.24 277.023)">
                        OPERATOR PANEL
                    </h1>

                    <!-- PROFILE SIDEBAR -->
                    <div class="flex items-center gap-3 mt-3">





                    </div>

                </div>

                <button class="lg:hidden" @click="sidebarOpen = false">
                    <i data-feather="x"></i>
                </button>

            </div>

        </div>

        @php
            $active = function($route) {
                return request()->routeIs($route)
                    ? 'background: oklch(87% 0.065 274.039); font-weight:600;'
                    : '';
            };
        @endphp

        <!-- MENU -->
        <div class="flex-1 overflow-y-auto px-3 py-3">

            <nav class="space-y-1">

                <a href="{{ route('operator.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition"
                   style="color: oklch(45.7% 0.24 277.023); {{ $active('operator.dashboard') }}">

                    <i data-feather="home" class="w-5 h-5"></i>
                    <span>Dashboard</span>

                </a>

                <a href="{{ route('operator.absensi.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition"
                   style="color: oklch(45.7% 0.24 277.023); {{ $active('operator.absensi.*') }}">

                    <i data-feather="clipboard" class="w-5 h-5"></i>
                    <span>Kelola Absensi</span>

                </a>

                <a href="{{ route('operator.jadwal.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition"
                   style="color: oklch(45.7% 0.24 277.023); {{ $active('operator.jadwal.*') }}">

                    <i data-feather="calendar" class="w-5 h-5"></i>
                    <span>Data Jadwal</span>

                </a>

                <a href="{{ route('operator.guru.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition"
                   style="color: oklch(45.7% 0.24 277.023); {{ $active('operator.guru.*') }}">

                    <i data-feather="users" class="w-5 h-5"></i>
                    <span>Data Guru</span>

                </a>

                <a href="{{ route('operator.kelas.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition"
                   style="color: oklch(45.7% 0.24 277.023); {{ $active('operator.kelas.*') }}">

                    <i data-feather="grid" class="w-5 h-5"></i>
                    <span>Data Kelas</span>

                </a>

                <a href="{{ route('operator.mapel.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition"
                   style="color: oklch(45.7% 0.24 277.023); {{ $active('operator.mapel.*') }}">

                    <i data-feather="book-open" class="w-5 h-5"></i>
                    <span>Mata Pelajaran</span>

                </a>

                <a href="{{ route('operator.profile.edit') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition"
                   style="color: oklch(45.7% 0.24 277.023); {{ $active('operator.profile.*') }}">

                    <i data-feather="user" class="w-5 h-5"></i>
                    <span>Profile</span>

                </a>

            </nav>

        </div>

        <!-- FOOTER -->
        <div class="p-3 border-t border-gray-100">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl hover:bg-red-50 text-red-500">

                    <i data-feather="log-out" class="w-5 h-5"></i>
                    <span>Logout</span>

                </button>
            </form>

        </div>

    </aside>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col min-w-0 h-screen">

        <!-- TOPBAR -->
        <header class="bg-white border-b border-gray-100 px-4 lg:px-6 py-4 flex items-center justify-between">

            <button class="lg:hidden" @click="sidebarOpen = true">
                <i data-feather="menu"></i>
            </button>

            <h2 class="text-lg font-semibold">
                Operator Dashboard
            </h2>

            <!-- USER TOPBAR -->
            <div class="flex items-center gap-3">

                <div class="hidden sm:block text-right">
                    <p class="font-semibold">{{ $user->name }}</p>
                    <p class="text-xs text-gray-500">{{ ucfirst($user->role) }}</p>
                </div>

                <!-- AVATAR -->
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

@stack('scripts')

</body>
</html>
