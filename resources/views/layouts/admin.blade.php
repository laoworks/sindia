<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="icon" type="image/png" href="/img/logo.png">
    <link rel="shortcut icon" href="/img/logo.png">
    <link rel="apple-touch-icon" href="/img/logo.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Warna menu sidebar - disamakan dengan bg */
        .nav-link {
            color: oklch(45.7% 0.24 277.023);
        }

        .nav-link:hover {
            background-color: #f3f4f6;
            color: oklch(45.7% 0.24 277.023);
        }

        .nav-link-active {
            background-color: #e5e7eb;
            color: oklch(45.7% 0.24 277.023);
        }
    </style>
</head>
@php
    $user = auth()->user();
    $active = fn ($route) => request()->routeIs($route) ? 'nav-link-active' : '';
    $menu = [
        ['url' => route('admin.dashboard'), 'route' => 'admin.dashboard', 'icon' => 'home', 'label' => 'Dashboard'],
        ['url' => route('admin.users.index'), 'route' => 'admin.users.*', 'icon' => 'users', 'label' => 'Data User'],
        ['url' => route('admin.guru.index'), 'route' => 'admin.guru.*', 'icon' => 'user-check', 'label' => 'Data Guru'],
        ['url' => route('admin.kelas.index'), 'route' => 'admin.kelas.*', 'icon' => 'grid', 'label' => 'Data Kelas'],
        ['url' => route('admin.mapel.index'), 'route' => 'admin.mapel.*', 'icon' => 'book-open', 'label' => 'Mata Pelajaran'],
        ['url' => route('admin.jadwal.index'), 'route' => 'admin.jadwal.*', 'icon' => 'calendar', 'label' => 'Jadwal Mengajar'],
        ['url' => route('admin.absensi.index'), 'route' => 'admin.absensi.*', 'icon' => 'clipboard', 'label' => 'Data Absensi'],
        ['url' => route('profile.edit'), 'route' => 'profile.edit', 'icon' => 'user', 'label' => 'Profile'],

    ];
@endphp
<body class="overflow-hidden antialiased bg-white">

<div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        class="fixed inset-0 z-40 bg-black/30 lg:hidden"
        @click="sidebarOpen = false"></div>

    <aside
        class="fixed inset-y-0 left-0 z-50 flex flex-col transition-transform duration-300 ease-in-out transform sidebar lg:static w-72 lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        <div class="px-6 py-6 border-b border-slate-200 shrink-0">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <!-- Logo di sidebar -->
                    <div class="flex-shrink-0 w-10 h-10">
                        <img src="/img/logo.png" alt="Logo" class="object-contain w-full h-full">
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight" style="color: oklch(45.7% 0.24 277.023)">SMA Negeri 26 SBB</h1>
                        <p class="mt-1 text-sm" style="color: oklch(45.7% 0.24 277.023 / 70%)">Administrator Panel</p>
                    </div>
                </div>
                <button class="lg:hidden" @click="sidebarOpen = false" style="color: oklch(45.7% 0.24 277.023)">
                    <i data-feather="x"></i>
                </button>
            </div>
        </div>

        <div class="flex-1 px-4 py-5 overflow-y-auto">
            <nav class="space-y-1">
                @foreach($menu as $item)
                    <a href="{{ $item['url'] }}" class="nav-link flex items-center gap-3 px-4 py-2 rounded-lg transition duration-200 {{ $active($item['route']) }}">
                        <i data-feather="{{ $item['icon'] }}" class="w-[18px] h-[18px]"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </div>

        <div class="p-4 border-t border-slate-200 shrink-0">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center justify-center w-full gap-3 px-4 py-3 transition duration-200 hover:bg-red-50" style="color: #dc2626">
                    <i data-feather="log-out" class="w-5 h-5"></i>
                    <span class="font-medium">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="flex flex-col flex-1 h-screen min-w-0">
        <header class="flex items-center justify-between px-4 py-4 bg-white border-b border-gray-100 lg:px-6 shrink-0">
            <button class="lg:hidden" @click="sidebarOpen = true" style="color: oklch(45.7% 0.24 277.023)">
                <i data-feather="menu"></i>
            </button>

            <h2 class="text-lg font-semibold" style="color: oklch(45.7% 0.24 277.023)">Dashboard Admin</h2>

            <div class="flex items-center gap-3">
                <div class="hidden text-right sm:block">
                    <p class="text-sm font-semibold" style="color: oklch(45.7% 0.24 277.023)">{{ $user->name }}</p>
                    <p class="text-xs" style="color: oklch(45.7% 0.24 277.023 / 70%)">Administrator</p>
                </div>
                @if($user->foto_profil)
                    <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="{{ $user->name }}" class="object-cover w-10 h-10 border border-gray-200 rounded-full">
                @else
                    <div class="flex items-center justify-center w-10 h-10 text-sm font-bold text-white rounded-full" style="background: oklch(45.7% 0.24 277.023)">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
            </div>
        </header>

        <main class="flex-1 p-4 overflow-y-auto bg-white lg:p-6">
            @yield('content')
        </main>
    </div>
</div>

<script>feather.replace();</script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: @json(session('success')),
        confirmButtonColor: '#6d28d9',
        timer: 3000,
        timerProgressBar: true,
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: @json(session('error')),
        confirmButtonColor: '#ef4444',
    });
</script>
@endif

@if($errors->any())
<script>
    Swal.fire({
        icon: 'warning',
        title: 'Validasi Gagal',
        html: @json('<div style="text-align:left;">' . collect($errors->all())->map(fn ($e) => '• ' . $e)->implode('<br>') . '</div>'),
        confirmButtonColor: '#f59e0b',
    });
</script>
@endif

@stack('scripts')
</body>
</html>
