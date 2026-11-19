/**
 * HelpDesk RAG - Landing Page Interactions & Animations
 * Exclusivo para views/publico/index.php (Aislado de app.js)
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Navbar Glassmorphism Scroll Effect
    const navbar = document.querySelector('.rs-navbar');
    const handleScroll = () => {
        if (!navbar) return;
        if (window.scrollY > 25) {
            navbar.classList.add('is-scrolled');
        } else {
            navbar.classList.remove('is-scrolled');
        }
    };
    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();

    // 2. Mobile Menu Toggle
    const menuToggle = document.getElementById('rs-mobile-toggle');
    if (menuToggle && navbar) {
        menuToggle.addEventListener('click', () => {
            navbar.classList.toggle('mobile-open');
        });

        const navLinks = navbar.querySelector('.rs-nav-links');
        if (navLinks) {
            navLinks.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    navbar.classList.remove('mobile-open');
                });
            });
        }
    }

    // 3. Scroll Reveal Animations (IntersectionObserver)
    const revealElements = document.querySelectorAll('.rs-reveal');
    if ('IntersectionObserver' in window) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px'
        });

        revealElements.forEach(el => revealObserver.observe(el));
    } else {
        revealElements.forEach(el => el.classList.add('is-visible'));
    }

    // 4. Interactive Tabs en Bloque RAG (Sin RAG vs Con RAG)
    const tabButtons = document.querySelectorAll('.rs-tab-btn');
    const tabPanes = document.querySelectorAll('.rs-tab-pane');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('data-tab');

            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabPanes.forEach(pane => pane.classList.remove('active'));

            button.classList.add('active');
            const targetPane = document.getElementById(targetId);
            if (targetPane) {
                targetPane.classList.add('active');
            }
        });
    });

    // 5. Micro-Tilt 3D y Efecto Spotlight en Mockup del Hero
    const mockup = document.querySelector('.rs-mockup-window');
    const mockupWrapper = document.querySelector('.rs-hero-mockup-wrapper');
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (mockup && mockupWrapper && !prefersReducedMotion && window.innerWidth > 992) {
        mockupWrapper.addEventListener('mousemove', (e) => {
            const rect = mockup.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const xPercent = (x / rect.width) * 100;
            const yPercent = (y / rect.height) * 100;

            const rotateX = ((y / rect.height) - 0.5) * -4; // Max 2deg a 3deg
            const rotateY = ((x / rect.width) - 0.5) * 4;

            mockup.style.setProperty('--mouse-x', `${xPercent}%`);
            mockup.style.setProperty('--mouse-y', `${yPercent}%`);
            mockup.style.transform = `perspective(1000px) rotateX(${rotateX.toFixed(2)}deg) rotateY(${rotateY.toFixed(2)}deg) translateY(-2px)`;
        });

        mockupWrapper.addEventListener('mouseleave', () => {
            mockup.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0px)';
        });
    }

    // 6. Scroll suave para anclas
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#' || targetId === '') return;
            const targetEl = document.querySelector(targetId);
            if (targetEl) {
                e.preventDefault();
                targetEl.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
