<nav class="bg-white/90 backdrop-blur-md shadow-lg fixed w-full top-0 z-50"
 x-data="{ mobileMenuOpen: false }">

 <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

 <div class="flex justify-between items-center h-16">

 <!-- BRAND WITH LOGO -->
 <div class="flex-shrink-0 flex items-center gap-3">
 <!-- LOGO -->
 <img src="{{ asset('img/logo.png') }}"
 alt="Logo Sekolah"
 class="h-10 w-auto object-contain"
 onerror="this.style.display='none'">

 <!-- BRAND TEXT -->
 <a href="#home"
 class="text-sm sm:text-base md:text-xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent hover:from-indigo-600 hover:to-blue-600 transition">
 SMA Negeri 26 SBB
 </a>
 </div>

 <!-- DESKTOP MENU -->
 <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2">
 <div class="flex items-center space-x-1">
 <a href="#home"
 class="px-3 lg:px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 relative group">
 Home
 <span class="absolute left-0 bottom-0 w-full h-0.5 bg-indigo-600 scale-x-0 group-hover:scale-x-100 transition"></span>
 </a>
 <a href="#about"
 class="px-3 lg:px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 relative group">
 Tentang
 <span class="absolute left-0 bottom-0 w-full h-0.5 bg-indigo-600 scale-x-0 group-hover:scale-x-100 transition"></span>
 </a>
 <a href="#fitur"
 class="px-3 lg:px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 relative group">
 Fitur
 <span class="absolute left-0 bottom-0 w-full h-0.5 bg-indigo-600 scale-x-0 group-hover:scale-x-100 transition"></span>
 </a>
 <a href="#kontak"
 class="px-3 lg:px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 relative group">
 Kontak
 <span class="absolute left-0 bottom-0 w-full h-0.5 bg-indigo-600 scale-x-0 group-hover:scale-x-100 transition"></span>
 </a>
 </div>
 </div>

 <!-- AUTH DESKTOP -->
 <div class="hidden md:flex items-center gap-3">
 <a href="{{ url('/login') }}"
 class="text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-300 px-5 lg:px-7 py-2 shadow-sm transition duration-150 ease-in-out">
 Login
 </a>
 </div>

 <!-- MOBILE MENU BUTTON -->
 <button class="md:hidden p-2 hover:bg-gray-100 transition"
 @click="mobileMenuOpen = !mobileMenuOpen"
 :aria-label="mobileMenuOpen ? 'Tutup menu' : 'Buka menu'">
 <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
 </svg>
 <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
 </svg>
 </button>

 </div>

 </div>

 <!-- MOBILE MENU - TANPA REGISTER -->
 <div x-show="mobileMenuOpen"
 x-transition:enter="transition ease-out duration-200"
 x-transition:enter-start="opacity-0 -translate-y-2"
 x-transition:enter-end="opacity-100 translate-y-0"
 x-transition:leave="transition ease-in duration-150"
 x-transition:leave-start="opacity-100 translate-y-0"
 x-transition:leave-end="opacity-0 -translate-y-2"
 class="md:hidden bg-white/95 backdrop-blur-md border-t shadow-lg"
 style="display: none;">

 <div class="px-4 py-4 space-y-1">
 <!-- Mobile Navigation Links -->
 <a href="#home"
 @click="mobileMenuOpen = false"
 class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition">
 Home
 </a>
 <a href="#about"
 @click="mobileMenuOpen = false"
 class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition">
 Tentang
 </a>
 <a href="#fitur"
 @click="mobileMenuOpen = false"
 class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition">
 Fitur
 </a>
 <a href="#kontak"
 @click="mobileMenuOpen = false"
 class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition">
 Kontak
 </a>

 <!-- Mobile Divider -->
 <div class="border-t border-gray-200 my-3"></div>

 <!-- Mobile Login Button (Tanpa Register) -->
 <div class="pt-2">
 <a href="{{ url('/login') }}"
 @click="mobileMenuOpen = false"
 class="block w-full px-4 py-3 text-center text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition shadow-sm">
 Login
 </a>
 </div>
 </div>
 </div>

</nav>

<!-- Spacing untuk konten di bawah navbar -->
<div class="h-16"></div>

<style>
html {
 scroll-behavior: smooth;
}

/* Mencegah scroll body saat menu mobile terbuka */
body.menu-open {
 overflow: hidden;
}
</style>

<!-- Optional: JavaScript untuk mencegah scroll saat menu terbuka -->
<script>
document.addEventListener('alpine:init', () => {
 // Ini akan otomatis terintegrasi dengan Alpine jika Anda menggunakan framework
 // Atau Anda bisa menambahkan manual:
 document.addEventListener('DOMContentLoaded', () => {
 const navbar = document.querySelector('[x-data]');
 if (navbar && window.Alpine) {
 // Event listener untuk toggle class body saat menu terbuka/tutup
 const observer = new MutationObserver(() => {
 const menuOpen = navbar.__x?.$data?.mobileMenuOpen;
 if (menuOpen) {
 document.body.classList.add('menu-open');
 } else {
 document.body.classList.remove('menu-open');
 }
 });
 observer.observe(navbar, { attributes: true, attributeFilter: ['x-data'] });
 }
 });
});
</script>
