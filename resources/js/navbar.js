// Navbar functionality
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuOpenIcon = document.getElementById('menu-open-icon');
    const menuCloseIcon = document.getElementById('menu-close-icon');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            const isHidden = mobileMenu.classList.contains('hidden');

            if (isHidden) {
                mobileMenu.classList.remove('hidden');
                if (menuOpenIcon) menuOpenIcon.classList.add('hidden');
                if (menuCloseIcon) menuCloseIcon.classList.remove('hidden');
                // Update ARIA attribute
                mobileMenuButton.setAttribute('aria-expanded', 'true');
            } else {
                mobileMenu.classList.add('hidden');
                if (menuOpenIcon) menuOpenIcon.classList.remove('hidden');
                if (menuCloseIcon) menuCloseIcon.classList.add('hidden');
                // Update ARIA attribute
                mobileMenuButton.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // Profile dropdown toggle
    const profileButton = document.getElementById('profile-button');
    const profileMenu = document.getElementById('profile-menu');

    if (profileButton && profileMenu) {
        profileButton.addEventListener('click', function(event) {
            event.stopPropagation();
            profileMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (profileButton && profileMenu &&
                !profileButton.contains(event.target) &&
                !profileMenu.contains(event.target)) {
                profileMenu.classList.add('hidden');
            }
        });

        // Close dropdown on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && profileMenu && !profileMenu.classList.contains('hidden')) {
                profileMenu.classList.add('hidden');
            }
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId && targetId !== '#') {
                e.preventDefault();
                const target = document.querySelector(targetId);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    // Update URL without jumping
                    history.pushState(null, null, targetId);
                    // Close mobile menu if open
                    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                        if (menuOpenIcon) menuOpenIcon.classList.remove('hidden');
                        if (menuCloseIcon) menuCloseIcon.classList.add('hidden');
                    }
                }
            }
        });
    });

    // Active link highlighting
    const currentLocation = window.location.pathname;
    const navLinks = document.querySelectorAll('nav a:not([href^="#"])');

    navLinks.forEach(link => {
        const linkPath = new URL(link.href).pathname;
        if (linkPath === currentLocation && linkPath !== '/') {
            // Remove active class from all links
            navLinks.forEach(l => {
                l.classList.remove('bg-gray-950/50', 'text-white');
                l.classList.add('text-gray-300', 'hover:bg-white/5');
            });
            // Add active class to current link
            link.classList.add('bg-gray-950/50', 'text-white');
            link.classList.remove('text-gray-300', 'hover:bg-white/5');
        }
    });

    // Handle window resize - close mobile menu on desktop view
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            if (window.innerWidth >= 640) { // sm breakpoint
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    if (menuOpenIcon) menuOpenIcon.classList.remove('hidden');
                    if (menuCloseIcon) menuCloseIcon.classList.add('hidden');
                }
            }
        }, 250);
    });
});
