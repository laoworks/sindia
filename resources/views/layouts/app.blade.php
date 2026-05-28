<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- FAVICON - Logo di samping nama website -->
    <link rel="icon" type="image/png" href="/img/logo.png">
    <link rel="shortcut icon" href="/img/logo.png">
    <link rel="apple-touch-icon" href="/img/logo.png">

    <!-- Untuk mendukung berbagai ukuran -->
    <link rel="icon" type="image/png" sizes="16x16" href="/img/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/logo.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/logo.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <x-navbar></x-navbar>

        <main>
            @yield('content')
        </main>

        <x-footer />
    </div>

    @stack('scripts')
</body>
</html>
