<!-- Footer -->
<footer class="bg-gray-900 text-gray-300 py-8">
 <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
 <div class="flex flex-col md:flex-row items-center justify-between gap-4">

 <!-- Brand -->
 <div class="text-center md:text-left">
 <h2 class="text-lg font-semibold text-white">
 SMA Negeri 26
 </h2>
 <p class="text-sm text-gray-400 mt-1">
 Membangun generasi unggul dan berprestasi.
 </p>
 </div>

 <!-- Navigation Footer -->
 <div class="flex items-center gap-6 text-sm">
 <a href="#"
 @click.prevent="document.getElementById('home').scrollIntoView({ behavior: 'smooth' })"
 class="hover:text-white transition duration-300">
 Home
 </a>

 <a href="#"
 @click.prevent="document.getElementById('about').scrollIntoView({ behavior: 'smooth' })"
 class="hover:text-white transition duration-300">
 About
 </a>

 <a href="#"
 @click.prevent="document.getElementById('services').scrollIntoView({ behavior: 'smooth' })"
 class="hover:text-white transition duration-300">
 Services
 </a>

 <a href="#"
 @click.prevent="document.getElementById('contact').scrollIntoView({ behavior: 'smooth' })"
 class="hover:text-white transition duration-300">
 Contact
 </a>
 </div>
 </div>

 <!-- Bottom -->
 <div class="border-t border-gray-800 mt-6 pt-6 text-center text-sm text-gray-500">
 © {{ date('Y') }} SMA Negeri 26. All rights reserved.
 </div>
 </div>
</footer>
