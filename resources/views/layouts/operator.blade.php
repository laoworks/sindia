<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Operator Panel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <aside class="w-64 bg-emerald-900 text-white p-5">

        <h1 class="text-2xl font-bold mb-8">
            Operator
        </h1>

        <nav class="space-y-2">

            <a href="{{ route('operator.dashboard') }}"
               class="block px-4 py-2 rounded hover:bg-emerald-800">
                Dashboard
            </a>

            <a href="#"
               class="block px-4 py-2 rounded hover:bg-emerald-800">
                Kelola Absensi
            </a>

        </nav>

    </aside>

    <main class="flex-1 p-6">
        @yield('content')
    </main>

</div>

</body>
</html>
