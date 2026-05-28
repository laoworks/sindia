@extends('layouts.app')

@section('content')

<!-- HERO -->
<section id="home" class="py-16 md:py-20 bg-gradient-to-br from-indigo-50 via-white to-blue-50 scroll-animate">

    <div class="max-w-6xl mx-auto px-4 md:px-6">

        <div class="grid md:grid-cols-2 gap-8 md:gap-12 items-center">

            <!-- TEXT -->
            <div class="scroll-animate" data-delay="0">

                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-4">
                    Sistem Informasi Sekolah
                </h1>

                <p class="text-gray-600 text-base md:text-lg mb-6 leading-relaxed">
                    Kelola data guru, jadwal, absensi, dan laporan sekolah dalam satu sistem yang mudah digunakan.
                </p>

                <div class="flex flex-wrap gap-3">

                    <a href="{{ url('/login') }}"
                       class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 transition text-sm md:text-base">
                        Login
                    </a>

                    <a href="#fitur"
                       class="border border-gray-300 text-gray-700 px-5 py-2.5 rounded-lg hover:bg-gray-50 transition text-sm md:text-base">
                        Lihat Fitur
                    </a>

                </div>

            </div>

            <!-- CARD PREVIEW DASHBOARD -->
            <div class="bg-white rounded-lg shadow-lg p-5 border border-gray-100 scroll-animate" data-delay="200">

                <div class="border-b border-gray-100 pb-3 mb-4">
                    <div class="font-semibold text-gray-800">Dashboard</div>
                    <div class="text-xs text-gray-400">Data sekolah hari ini</div>
                </div>

                <!-- CSS ILUSTRASI GRAFIK -->
                <div class="mb-5 bg-gray-50 rounded-lg p-4">
                    <div class="flex items-end justify-center gap-3 h-32">
                        <div class="flex flex-col items-center gap-1">
                            <div class="w-12 bg-indigo-200 rounded-t" style="height: 35px;"></div>
                            <span class="text-[10px] text-gray-400">Guru</span>
                        </div>
                        <div class="flex flex-col items-center gap-1">
                            <div class="w-12 bg-indigo-300 rounded-t" style="height: 55px;"></div>
                            <span class="text-[10px] text-gray-400">Siswa</span>
                        </div>
                        <div class="flex flex-col items-center gap-1">
                            <div class="w-12 bg-indigo-400 rounded-t" style="height: 25px;"></div>
                            <span class="text-[10px] text-gray-400">Kelas</span>
                        </div>
                        <div class="flex flex-col items-center gap-1">
                            <div class="w-12 bg-indigo-500 rounded-t" style="height: 45px;"></div>
                            <span class="text-[10px] text-gray-400">Absensi</span>
                        </div>
                    </div>

                    <!-- Garis bantu -->
                    <div class="relative mt-2">
                        <div class="border-t border-gray-200"></div>
                    </div>
                </div>


                </div>



            </div>

        </div>

    </div>

</section>

<!-- ABOUT -->
<section id="about" class="py-16 bg-white border-t border-gray-100 scroll-animate">

    <div class="max-w-4xl mx-auto px-4 text-center">

        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">
            Tentang Sistem Ini
        </h2>

        <p class="text-gray-500 leading-relaxed text-sm md:text-base">
            Dibangun untuk membantu sekolah dalam mengelola data guru, jadwal pelajaran, absensi siswa, dan pembuatan laporan.
            Sistem ini dapat diakses oleh Admin, Guru, dan Kepala Sekolah sesuai dengan hak akses masing-masing.
        </p>

    </div>

</section>

<!-- FITUR -->
<section id="fitur" class="py-16 bg-gray-50 border-t border-gray-100">

    <div class="max-w-6xl mx-auto px-4">

        <div class="text-center mb-10 scroll-animate">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">
                Fitur
            </h2>
            <p class="text-gray-500 text-sm">
                Beberapa fitur yang tersedia di sistem ini
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">

            <div class="bg-white rounded-lg border border-gray-100 p-5 shadow-sm hover:shadow-md transition scroll-animate" data-delay="0">
                <div class="font-semibold text-gray-800 mb-2 text-lg">Data Guru</div>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Kelola data guru, mata pelajaran, dan riwayat mengajar.
                </p>
            </div>

            <div class="bg-white rounded-lg border border-gray-100 p-5 shadow-sm hover:shadow-md transition scroll-animate" data-delay="100">
                <div class="font-semibold text-gray-800 mb-2 text-lg">Absensi</div>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Rekap absensi harian dan bulanan untuk guru maupun siswa.
                </p>
            </div>

            <div class="bg-white rounded-lg border border-gray-100 p-5 shadow-sm hover:shadow-md transition scroll-animate" data-delay="200">
                <div class="font-semibold text-gray-800 mb-2 text-lg">Jadwal</div>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Atur jadwal pelajaran dengan tampilan yang rapi dan mudah dibaca.
                </p>
            </div>

            <div class="bg-white rounded-lg border border-gray-100 p-5 shadow-sm hover:shadow-md transition scroll-animate" data-delay="0">
                <div class="font-semibold text-gray-800 mb-2 text-lg">Laporan</div>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Cetak laporan data sekolah dalam format PDF atau Excel.
                </p>
            </div>

            <div class="bg-white rounded-lg border border-gray-100 p-5 shadow-sm hover:shadow-md transition scroll-animate" data-delay="100">
                <div class="font-semibold text-gray-800 mb-2 text-lg">Manajemen User</div>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Atur hak akses pengguna berdasarkan peran masing-masing.
                </p>
            </div>

            <div class="bg-white rounded-lg border border-gray-100 p-5 shadow-sm hover:shadow-md transition scroll-animate" data-delay="200">
                <div class="font-semibold text-gray-800 mb-2 text-lg">Kelas & Siswa</div>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Data kelas dan siswa terintegrasi dengan sistem absensi.
                </p>
            </div>

        </div>

    </div>

</section>

<!-- KONTAK -->
<section id="kontak" class="py-16 bg-white border-t border-gray-100 scroll-animate">

    <div class="max-w-3xl mx-auto px-4 text-center">

        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">
            Kontak
        </h2>

        <p class="text-gray-500 text-sm md:text-base mb-5">
            Untuk informasi lebih lanjut, silakan hubungi kami.
        </p>

        <div class="bg-gray-50 rounded-lg p-5 inline-block mx-auto">
            <div class="text-gray-600 text-sm space-y-2">
                <div>Email: admin@sekolah.sch.id</div>
                <div>Telepon: (021) 1234-5678</div>
                <div>Alamat: Jl. Pendidikan No. 123, Kota Contoh</div>
            </div>
        </div>

    </div>

</section>

<style>
html {
    scroll-behavior: smooth;
}

/* Animasi Scroll */
.scroll-animate {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.7s ease-out, transform 0.7s ease-out;
}

.scroll-animate.visible {
    opacity: 1;
    transform: translateY(0);
}

/* Efek tambahan untuk kartu fitur */
.scroll-animate:hover {
    transition: all 0.3s ease;
}
</style>

<script>
// Animasi Scroll tanpa mengubah tampilan
document.addEventListener('DOMContentLoaded', function() {
    const animatedElements = document.querySelectorAll('.scroll-animate');

    // Function to check if element is in viewport
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        const windowHeight = window.innerHeight || document.documentElement.clientHeight;
        const threshold = 100; // Trigger animation slightly before element enters viewport

        return rect.top <= windowHeight - threshold && rect.bottom >= 0;
    }

    // Function to add visible class with delay support
    function checkAndAnimate() {
        animatedElements.forEach((el, index) => {
            if (isElementInViewport(el) && !el.classList.contains('visible')) {
                // Get delay from data-delay attribute
                const delay = el.getAttribute('data-delay');
                const delayTime = delay ? parseInt(delay) : 0;

                setTimeout(() => {
                    el.classList.add('visible');
                }, delayTime);
            }
        });
    }

    // Initial check
    checkAndAnimate();

    // Check on scroll with throttle for performance
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        if (scrollTimeout) {
            clearTimeout(scrollTimeout);
        }
        scrollTimeout = setTimeout(checkAndAnimate, 50);
    });

    // Check on resize
    window.addEventListener('resize', function() {
        checkAndAnimate();
    });

    // Also check for any elements that might become visible after page load
    setTimeout(checkAndAnimate, 100);
});
</script>

@endsection
