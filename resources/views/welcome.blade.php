@extends('layouts.app')

@section('content')
<!-- Navbar dengan scroll behavior -->
<nav class="bg-white/90 backdrop-blur-md shadow-lg fixed w-full top-0 z-50 left-0" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo/Brand -->
            <div class="flex-shrink-0">
                <a href="#" @click.prevent="document.getElementById('home').scrollIntoView({ behavior: 'smooth' })" class="text-xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent hover:from-blue-600 hover:to-indigo-600 transition-all duration-300 cursor-pointer">
                    SMA Negeri 26
                </a>
            </div>

            <!-- Desktop Navigation Center -->
            <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2">
                <div class="flex items-center space-x-1">
                    <a href="#" @click.prevent="document.getElementById('home').scrollIntoView({ behavior: 'smooth' }); mobileMenuOpen = false" class="relative px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition duration-300 group cursor-pointer">
                        Home
                        <span class="absolute inset-x-0 bottom-0 h-0.5 bg-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </a>
                    <a href="#" @click.prevent="document.getElementById('about').scrollIntoView({ behavior: 'smooth' }); mobileMenuOpen = false" class="relative px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition duration-300 group cursor-pointer">
                        About
                        <span class="absolute inset-x-0 bottom-0 h-0.5 bg-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </a>
                    <a href="#" @click.prevent="document.getElementById('services').scrollIntoView({ behavior: 'smooth' }); mobileMenuOpen = false" class="relative px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition duration-300 group cursor-pointer">
                        Services
                        <span class="absolute inset-x-0 bottom-0 h-0.5 bg-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </a>
                    <a href="#" @click.prevent="document.getElementById('contact').scrollIntoView({ behavior: 'smooth' }); mobileMenuOpen = false" class="relative px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition duration-300 group cursor-pointer">
                        Contact
                        <span class="absolute inset-x-0 bottom-0 h-0.5 bg-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </a>
                </div>
            </div>

            <!-- Right Side Actions (Login & Register tetap ke halaman lain) -->
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ url('/login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 px-4 py-2 transition duration-300">
                    Login
                </a>
                <a href="{{ url('/register') }}" class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white hover:from-indigo-700 hover:to-blue-700 px-5 py-2 rounded-lg text-sm font-medium transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Register
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="relative w-10 h-10 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none transition duration-300">
                    <svg class="h-6 w-6 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="md:hidden bg-white/95 backdrop-blur-md border-t border-gray-100 shadow-xl" @click.away="mobileMenuOpen = false">
        <div class="px-4 pt-3 pb-4 space-y-1">
            <!-- Menu scroll -->
            <a href="#" @click.prevent="document.getElementById('home').scrollIntoView({ behavior: 'smooth' }); mobileMenuOpen = false" class="block px-4 py-3 text-base font-medium text-gray-700 rounded-lg hover:text-blue-600 hover:bg-blue-50 transition duration-300 cursor-pointer">
                Home
            </a>
            <a href="#" @click.prevent="document.getElementById('about').scrollIntoView({ behavior: 'smooth' }); mobileMenuOpen = false" class="block px-4 py-3 text-base font-medium text-gray-700 rounded-lg hover:text-blue-600 hover:bg-blue-50 transition duration-300 cursor-pointer">
                About
            </a>
            <a href="#" @click.prevent="document.getElementById('services').scrollIntoView({ behavior: 'smooth' }); mobileMenuOpen = false" class="block px-4 py-3 text-base font-medium text-gray-700 rounded-lg hover:text-blue-600 hover:bg-blue-50 transition duration-300 cursor-pointer">
                Services
            </a>
            <a href="#" @click.prevent="document.getElementById('contact').scrollIntoView({ behavior: 'smooth' }); mobileMenuOpen = false" class="block px-4 py-3 text-base font-medium text-gray-700 rounded-lg hover:text-blue-600 hover:bg-blue-50 transition duration-300 cursor-pointer">
                Contact
            </a>

            <!-- Login & Register tetap pindah halaman -->
            <div class="border-t border-gray-100 mt-4 pt-4 space-y-2">
                <a href="{{ url('/login') }}" class="block px-4 py-3 text-base font-medium text-gray-700 rounded-lg hover:text-blue-600 hover:bg-blue-50 transition duration-300">
                    Login
                </a>
                <a href="{{ url('/register') }}" class="block text-center bg-gradient-to-r from-indigo-800 to-blue-600 text-white hover:from-indigo-700 hover:to-blue-700 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-300 shadow-md">
                    Register
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Spacing untuk fixed navbar -->
<div class="h-16"></div>

<!-- Section Home (menampilkan konten welcome) -->
<section id="home" class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Selamat Datang di SMA Negeri 26</h1>
                <p class="text-gray-600">Ini adalah section Home. Konten selamat datang ada di sini.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section About -->
<section id="about" class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Tentang SMA Negeri 26</h1>
                <p class="text-gray-600">Informasi tentang sekolah, visi misi, dan sejarah singkat.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section Services -->
<section id="services" class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Layanan Kami</h1>
                <p class="text-gray-600">Fasilitas, ekstrakurikuler, dan layanan pendidikan yang tersedia.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section Contact -->
<section id="contact" class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Kontak Kami</h1>
                <p class="text-gray-600">Alamat, nomor telepon, email, dan peta lokasi.</p>
            </div>
        </div>
    </div>
</section>

<style>
    html {
        scroll-behavior: smooth;
    }

    @media (max-width: 768px) {
        .backdrop-blur-md {
            backdrop-filter: blur(10px);
        }
    }
</style>
@endsection
