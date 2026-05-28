<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Sekolah</title>

    <!-- FAVICON - Logo di samping nama website -->
    <link rel="icon" type="image/png" href="/img/logo.png">
    <link rel="shortcut icon" href="/img/logo.png">
    <link rel="apple-touch-icon" href="/img/logo.png">

    <!-- Untuk mendukung berbagai ukuran -->
    <link rel="icon" type="image/png" sizes="16x16" href="/img/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/logo.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/logo.png">


    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-blue-50 flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white/90 backdrop-blur-md shadow-xl rounded-2xl p-8 border">

        <!-- HEADER WITH LOGO -->
        <div class="text-center mb-6">

            <!-- LOGO SECTION -->
            <div class="flex justify-center mb-4">
    <img src="{{ asset('img/logo.png') }}"
         alt="Logo Sekolah"
         class="h-28 w-auto object-contain"
         onerror="this.style.display='none'">
</div>

            <h1 class="text-2xl font-bold text-gray-800">
                Sistem Informasi Sekolah
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                SMA Negeri 26 SBB
            </p>

        </div>

        <!-- SESSION STATUS -->
        @if(session('status'))
            <div class="mb-4 text-sm text-green-600 bg-green-50 p-3 rounded-lg">
                {{ session('status') }}
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">

            @csrf

            <!-- LOGIN -->
            <div>

                <label class="block text-sm font-medium text-gray-700">
                    Email atau NIP
                </label>

                <input
                    type="text"
                    name="login"
                    value="{{ old('login') }}"
                    required
                    autofocus
                    class="mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                >

                @error('login')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror

            </div>

            <!-- PASSWORD -->
            <div>

                <label class="block text-sm font-medium text-gray-700">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    required
                    class="mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                >

                @error('password')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror

            </div>

            <!-- REMEMBER -->
            <div class="flex items-center">

                <input
                    type="checkbox"
                    name="remember"
                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                >

                <span class="ml-2 text-sm text-gray-600">
                    Remember me
                </span>

            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 rounded-xl font-medium hover:bg-indigo-700 transition">

                Login

            </button>

        </form>

    </div>

</body>
</html>
