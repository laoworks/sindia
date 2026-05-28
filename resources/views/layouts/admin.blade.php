<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Admin Dashboard
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <!-- Alpine JS -->
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-white antialiased overflow-hidden">

<div
    x-data="{ sidebarOpen: false }"
    class="h-screen flex overflow-hidden"
>

    <!-- Overlay -->
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        class="fixed inset-0 bg-black/30 z-40 lg:hidden"
        @click="sidebarOpen = false"
    ></div>

    <!-- Sidebar -->
    <aside
        class="
            fixed lg:static inset-y-0 left-0 z-50
            w-72 bg-white border-r border-gray-100
            transform transition-transform duration-300 ease-in-out
            lg:translate-x-0 flex flex-col
        "
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    >

        <!-- Sidebar Header -->
        <div class="px-6 py-6 border-b border-gray-100 shrink-0">

            <div class="flex items-center justify-between">

                <div>

                    <h1
                        class="text-2xl font-bold tracking-tight"
                        style="color: oklch(45.7% 0.24 277.023)"
                    >
                        ABSENSI
                    </h1>

                    <p
                        class="text-sm mt-1"
                        style="color: oklch(45.7% 0.24 277.023 / 70%)"
                    >
                        Administrator Panel
                    </p>

                </div>

                <!-- Close Sidebar -->
                <button
                    class="lg:hidden"
                    @click="sidebarOpen = false"
                    style="color: oklch(45.7% 0.24 277.023)"
                >

                    <i data-feather="x"></i>

                </button>

            </div>

        </div>

        <!-- Menu -->
        <div class="flex-1 overflow-y-auto px-4 py-5 scrollbar-thin">

            <nav class="space-y-1">

    <!-- Dashboard -->
    <a
        href="{{ route('admin.dashboard') }}"
        class="
            flex items-center gap-3
            px-4 py-3 rounded-xl
            text-sm font-medium
            transition-all duration-200
            hover:bg-purple-50
        "
        style="
            color: oklch(45.7% 0.24 277.023);
            {{ request()->routeIs('admin.dashboard')
                ? 'background: oklch(94% 0.03 280);'
                : '' }}
        "
    >

        <i data-feather="home" class="w-[18px] h-[18px]"></i>

        <span>Dashboard</span>

    </a>

    <!-- Data User -->
    <a
        href="{{ route('admin.users.index') }}"
        class="
            flex items-center gap-3
            px-4 py-3 rounded-xl
            text-sm font-medium
            transition-all duration-200
            hover:bg-purple-50
        "
        style="
            color: oklch(45.7% 0.24 277.023);
            {{ request()->routeIs('admin.users.*')
                ? 'background: oklch(94% 0.03 280);'
                : '' }}
        "
    >

        <i data-feather="users" class="w-[18px] h-[18px]"></i>

        <span>Data User</span>

    </a>

    <!-- Data Guru -->
    <a
        href="{{ route('admin.guru.index') }}"
        class="
            flex items-center gap-3
            px-4 py-3 rounded-xl
            text-sm font-medium
            transition-all duration-200
            hover:bg-purple-50
        "
        style="
            color: oklch(45.7% 0.24 277.023);
            {{ request()->routeIs('admin.guru.*')
                ? 'background: oklch(94% 0.03 280);'
                : '' }}
        "
    >

        <i data-feather="user-check" class="w-[18px] h-[18px]"></i>

        <span>Data Guru</span>

    </a>

    <!-- Data Kelas -->
    <a
        href="{{ route('admin.kelas.index') }}"
        class="
            flex items-center gap-3
            px-4 py-3 rounded-xl
            text-sm font-medium
            transition-all duration-200
            hover:bg-purple-50
        "
        style="
            color: oklch(45.7% 0.24 277.023);
            {{ request()->routeIs('admin.kelas.*')
                ? 'background: oklch(94% 0.03 280);'
                : '' }}
        "
    >

        <i data-feather="grid" class="w-[18px] h-[18px]"></i>

        <span>Data Kelas</span>

    </a>

    <!-- Mata Pelajaran -->
    <a
        href="{{ route('admin.mapel.index') }}"
        class="
            flex items-center gap-3
            px-4 py-3 rounded-xl
            text-sm font-medium
            transition-all duration-200
            hover:bg-purple-50
        "
        style="
            color: oklch(45.7% 0.24 277.023);
            {{ request()->routeIs('admin.mapel.*')
                ? 'background: oklch(94% 0.03 280);'
                : '' }}
        "
    >

        <i data-feather="book-open" class="w-[18px] h-[18px]"></i>

        <span>Mata Pelajaran</span>

    </a>

    <!-- Jadwal -->
    <a
        href="{{ route('admin.jadwal.index') }}"
        class="
            flex items-center gap-3
            px-4 py-3 rounded-xl
            text-sm font-medium
            transition-all duration-200
            hover:bg-purple-50
        "
        style="
            color: oklch(45.7% 0.24 277.023);
            {{ request()->routeIs('admin.jadwal.*')
                ? 'background: oklch(94% 0.03 280);'
                : '' }}
        "
    >

        <i data-feather="calendar" class="w-[18px] h-[18px]"></i>

        <span>Jadwal Mengajar</span>

    </a>

    <!-- Absensi -->
    <a
        href="{{ route('admin.absensi.index') }}"
        class="
            flex items-center gap-3
            px-4 py-3 rounded-xl
            text-sm font-medium
            transition-all duration-200
            hover:bg-purple-50
        "
        style="
            color: oklch(45.7% 0.24 277.023);
            {{ request()->routeIs('admin.absensi.*')
                ? 'background: oklch(94% 0.03 280);'
                : '' }}
        "
    >

        <i data-feather="clipboard" class="w-[18px] h-[18px]"></i>

        <span>Data Absensi</span>

    </a>

    <!-- Profile -->
    <a
        href="{{ route('profile.edit') }}"
        class="
            flex items-center gap-3
            px-4 py-3 rounded-xl
            text-sm font-medium
            transition-all duration-200
            hover:bg-purple-50
        "
        style="
            color: oklch(45.7% 0.24 277.023);
            {{ request()->routeIs('profile.edit')
                ? 'background: oklch(94% 0.03 280);'
                : '' }}
        "
    >

        <i data-feather="user" class="w-[18px] h-[18px]"></i>

        <span>Profile</span>

    </a>

    <!-- Pengaturan -->
    <a
        href="{{ route('admin.pengaturan.index') }}"
        class="
            flex items-center gap-3
            px-4 py-3 rounded-xl
            text-sm font-medium
            transition-all duration-200
            hover:bg-purple-50
        "
        style="
            color: oklch(45.7% 0.24 277.023);
            {{ request()->routeIs('admin.pengaturan.*')
                ? 'background: oklch(94% 0.03 280);'
                : '' }}
        "
    >

        <i data-feather="settings" class="w-[18px] h-[18px]"></i>

        <span>Pengaturan</span>

    </a>

</nav>

        </div>

        <!-- Footer -->
        <div class="p-4 border-t border-gray-100 shrink-0">

            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="
                        w-full flex items-center justify-center gap-3
                        px-4 py-3 rounded-2xl
                        transition duration-200
                        hover:bg-red-50
                    "
                    style="color: #dc2626"
                >

                    <i data-feather="log-out" class="w-5 h-5"></i>

                    <span class="font-medium">
                        Logout
                    </span>

                </button>

            </form>

        </div>

    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col min-w-0 h-screen">

        <!-- Topbar -->
        <header
            class="
                bg-white border-b border-gray-100
                px-4 lg:px-6 py-4
                flex items-center justify-between
                shrink-0
            "
        >

            <!-- Mobile Menu -->
            <button
                class="lg:hidden"
                @click="sidebarOpen = true"
                style="color: oklch(45.7% 0.24 277.023)"
            >

                <i data-feather="menu"></i>

            </button>

            <!-- Title -->
            <div>

                <h2
                    class="text-lg font-semibold"
                    style="color: oklch(45.7% 0.24 277.023)"
                >
                    Dashboard Admin
                </h2>

            </div>

            <!-- User -->
            <div class="flex items-center gap-3">

                <div class="hidden sm:block text-right">

                    <p
                        class="font-semibold text-sm"
                        style="color: oklch(45.7% 0.24 277.023)"
                    >
                        {{ auth()->user()->name }}
                    </p>

                    <p
                        class="text-xs"
                        style="color: oklch(45.7% 0.24 277.023 / 70%)"
                    >
                        Administrator
                    </p>

                </div>

                <!-- Avatar -->
                <div>

                    @if(auth()->user()->foto_profil)

                        <img
                            src="{{ asset('storage/' . auth()->user()->foto_profil) }}"
                            alt="{{ auth()->user()->name }}"
                            class="w-10 h-10 rounded-2xl object-cover border border-gray-200"
                        >

                    @else

                        <div
                            class="
                                w-10 h-10 rounded-2xl
                                flex items-center justify-center
                                text-white font-bold text-sm
                            "
                            style="background: oklch(45.7% 0.24 277.023)"
                        >

                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                        </div>

                    @endif

                </div>

            </div>

        </header>

        <!-- Content -->
        <main
            class="
                flex-1 overflow-y-auto
                p-4 lg:p-6
                bg-white
            "
        >

            @yield('content')

        </main>

    </div>

</div>

<!-- Feather Replace -->
<script>

    feather.replace();

</script>

<!-- SweetAlert Success -->
@if(session('success'))

<script>

    Swal.fire({

        icon: 'success',

        title: 'Berhasil',

        text: '{{ session('success') }}',

        confirmButtonColor: '#6d28d9',

        timer: 3000,

        timerProgressBar: true,

    });

</script>

@endif

<!-- SweetAlert Error -->
@if(session('error'))

<script>

    Swal.fire({

        icon: 'error',

        title: 'Gagal',

        text: '{{ session('error') }}',

        confirmButtonColor: '#ef4444',

    });

</script>

@endif

<!-- Validation Error -->
@if($errors->any())

<script>

    Swal.fire({

        icon: 'warning',

        title: 'Validasi Gagal',

        html: `
            <div style="text-align:left;">
                @foreach($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        `,

        confirmButtonColor: '#f59e0b',

    });

</script>

@endif

<!-- Stack Scripts -->
@stack('scripts')

</body>
</html>
