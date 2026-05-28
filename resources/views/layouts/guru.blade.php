<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Guru Panel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FEATHER ICON -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- ALPINE -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="bg-white overflow-hidden">

<div
    x-data="{ sidebarOpen: false }"
    class="h-screen flex"
>

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
        <div class="px-6 py-5 border-b border-gray-100 shrink-0">

            <div class="flex items-center justify-between">

                <div>

                    <h1
                        class="text-2xl font-bold"
                        style="color: oklch(45.7% 0.24 277.023)"
                    >
                        GURU PANEL
                    </h1>

                    <p
                        class="text-sm mt-1"
                        style="color: oklch(45.7% 0.24 277.023 / 70%)"
                    >
                        {{ auth()->user()->name }}
                    </p>

                </div>

                <!-- CLOSE MOBILE -->
                <button
                    class="lg:hidden"
                    @click="sidebarOpen = false"
                    style="color: oklch(45.7% 0.24 277.023)"
                >

                    <i data-feather="x"></i>

                </button>

            </div>

        </div>

        <!-- MENU -->
        <div class="flex-1 overflow-y-auto px-4 py-5">

            <nav class="space-y-2">

                <!-- DASHBOARD -->
                <a
                    href="{{ route('guru.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200
                    {{ request()->routeIs('guru.dashboard') ? '' : 'hover:bg-gray-50' }}"
                    style="
                        color: oklch(45.7% 0.24 277.023);
                        background:
                        {{ request()->routeIs('guru.dashboard')
                            ? 'oklch(87% 0.065 274.039)'
                            : 'transparent'
                        }};
                    "
                >

                    <i data-feather="home" class="w-5 h-5"></i>

                    <span class="font-semibold">
                        Dashboard
                    </span>

                </a>

                <!-- JADWAL -->
                <a
                    href="{{ route('guru.jadwal') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200
                    {{ request()->routeIs('guru.jadwal') ? '' : 'hover:bg-gray-50' }}"
                    style="
                        color: oklch(45.7% 0.24 277.023);
                        background:
                        {{ request()->routeIs('guru.jadwal')
                            ? 'oklch(87% 0.065 274.039)'
                            : 'transparent'
                        }};
                    "
                >

                    <i data-feather="calendar" class="w-5 h-5"></i>

                    <span class="font-medium">
                        Jadwal Mengajar
                    </span>

                </a>

                <!-- ABSENSI -->
                <a
                    href="{{ route('guru.absensi') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200
                    {{ request()->routeIs('guru.absensi') ? '' : 'hover:bg-gray-50' }}"
                    style="
                        color: oklch(45.7% 0.24 277.023);
                        background:
                        {{ request()->routeIs('guru.absensi')
                            ? 'oklch(87% 0.065 274.039)'
                            : 'transparent'
                        }};
                    "
                >

                    <i data-feather="clipboard" class="w-5 h-5"></i>

                    <span class="font-medium">
                        Absensi
                    </span>

                </a>

                <!-- LAPORAN -->
                <a
                    href="{{ route('guru.laporan') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200
                    {{ request()->routeIs('guru.laporan') ? '' : 'hover:bg-gray-50' }}"
                    style="
                        color: oklch(45.7% 0.24 277.023);
                        background:
                        {{ request()->routeIs('guru.laporan')
                            ? 'oklch(87% 0.065 274.039)'
                            : 'transparent'
                        }};
                    "
                >

                    <i data-feather="bar-chart-2" class="w-5 h-5"></i>

                    <span class="font-medium">
                        Laporan
                    </span>

                </a>

              <!-- PROFILE -->
<a
    href="{{ route('guru.profile.edit') }}"
    class="
        flex items-center gap-3
        px-4 py-3 rounded-2xl
        transition duration-200
        {{ request()->routeIs('guru.profile.*') ? '' : 'hover:bg-purple-50' }}
    "
    style="
        color: oklch(45.7% 0.24 277.023);
        background:
        {{ request()->routeIs('guru.profile.*')
            ? 'oklch(94% 0.03 280)'
            : 'transparent'
        }};
    "
>

    <i data-feather="user" class="w-5 h-5"></i>

    <span class="font-medium">
        Profile
    </span>

</a>

            </nav>

        </div>

        <!-- FOOTER -->
        <div class="p-4 border-t border-gray-100 shrink-0">

            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-2xl transition-all duration-200 hover:bg-red-50 text-red-500"
                >

                    <i data-feather="log-out" class="w-5 h-5"></i>

                    <span class="font-medium">
                        Logout
                    </span>

                </button>

            </form>

        </div>

    </aside>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col min-w-0 h-screen">

        <!-- TOPBAR -->
        <header class="bg-white border-b border-gray-100 px-4 lg:px-6 py-4 flex items-center justify-between shrink-0">

            <!-- MOBILE MENU -->
            <button
                class="lg:hidden"
                @click="sidebarOpen = true"
                style="color: oklch(45.7% 0.24 277.023)"
            >

                <i data-feather="menu"></i>

            </button>

            <!-- TITLE -->
            <div>

                <h2
                    class="text-lg font-semibold"
                    style="color: oklch(45.7% 0.24 277.023)"
                >
                    Guru Dashboard
                </h2>

            </div>

            <!-- USER -->
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
                        {{ ucfirst(auth()->user()->role) }}
                    </p>

                </div>

                <div
                    class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-bold"
                    style="background: oklch(45.7% 0.24 277.023)"
                >

                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

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
