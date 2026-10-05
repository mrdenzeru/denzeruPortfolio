import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

import { animate, stagger } from 'animejs';

// Always starty at the top on reload
if ('scrollRestoration' in history) {
    history.scrollRestoration= 'manual';
}
window.scrollTo(0,0);

// Also reset when restored from back/forward cache
window.addEventListener('pageshow', (e) => {
    if (e.persisted) window.scrollTo(0, 0);
});


// Navbar — plays immediately on page load
animate('.nav-anim', {
    opacity: [0, 1],
    translateY: [-40, 0],
    ease: 'outBack',
    duration: 800,
});

// Navbar: visible at the top or when scrolling up, hidden when scrolling down
const header = document.getElementById('site-header');

if (header) {
    let lastY = window.scrollY;
    let ticking = false;

    const setHidden = (hidden) => {
        header.style.transform = hidden ? 'translateY(-100%)' : 'translateY(0)';
    };

    window.addEventListener(
        'scroll',
        () => {
            if (ticking) return;
            ticking = true;

            requestAnimationFrame(() => {
                const y = window.scrollY;
                const delta = y - lastY;

                if (y <= 10) {
                    setHidden(false);              // top of the page: always show
                } else if (Math.abs(delta) > 5) {  // ignore tiny jitters
                    setHidden(delta > 0);          // down = hide, up = show
                    lastY = y;
                }

                ticking = false;
            });
        },
        { passive: true }
    );
}

// Back-to-top button: visible after the halfway point, recolors on similar backgrounds
const backToTop = document.getElementById('back-to-top');

if (backToTop) {
    const SHOW_AT = 0.5;              // 0.5 = halfway down the page
    const BUTTON_RGB = [0, 34, 77];   // #00224D, the button's normal color
    const TOLERANCE = 60;             // higher = treats more shades as "similar"
    let isVisible = false;
    let isContrast = false;

    // Parse "rgb(0, 34, 77)" / "rgba(0, 34, 77, 0.5)" into [r, g, b, a]
    const parseColor = (value) => {
        const m = value.match(/[\d.]+/g);
        if (!m || m.length < 3) return null;
        return [Number(m[0]), Number(m[1]), Number(m[2]), m[3] !== undefined ? Number(m[3]) : 1];
    };

    // Find the first solid background color under the button's center
    const getBackgroundUnderButton = () => {
        const rect = backToTop.getBoundingClientRect();
        const x = rect.left + rect.width / 2;
        const y = rect.top + rect.height / 2;

        for (const el of document.elementsFromPoint(x, y)) {
            if (backToTop.contains(el)) continue;           // skip the button itself
            const color = parseColor(getComputedStyle(el).backgroundColor);
            if (color && color[3] > 0.5) return color;      // ignore transparent layers
        }
        return null;
    };

    const isSimilar = (color) => {
        const [r, g, b] = color;
        const distance = Math.hypot(r - BUTTON_RGB[0], g - BUTTON_RGB[1], b - BUTTON_RGB[2]);
        return distance < TOLERANCE;
    };

    const update = () => {
        // Visibility
        const scrollable = document.documentElement.scrollHeight - window.innerHeight;
        const shouldShow = scrollable > 0 && window.scrollY > scrollable * SHOW_AT;
        if (shouldShow !== isVisible) {
            isVisible = shouldShow;
            backToTop.dataset.visible = shouldShow ? 'true' : 'false';
        }

        // Color contrast (only worth checking while visible)
        if (!isVisible) return;
        const bg = getBackgroundUnderButton();
        const shouldContrast = bg ? isSimilar(bg) : false;
        if (shouldContrast !== isContrast) {
            isContrast = shouldContrast;
            backToTop.dataset.contrast = shouldContrast ? 'true' : 'false';
        }
    };

    let ticking = false;
    const onScroll = () => {
        if (ticking) return;
        ticking = true;
        requestAnimationFrame(() => {
            update();
            ticking = false;
        });
    };

    backToTop.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
    update();
}

// Reusable scroll-reveal helper
function scrollReveal(sectionId, targetClass, delay = 0) {
    const section = document.getElementById(sectionId);
    if (!section) return;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        animate(`.${targetClass}`, {
                            opacity: [0, 1],
                            translateY: [30, 0],
                            ease: 'outExpo',
                            duration: 900,
                            delay: stagger(150),
                        });
                    }, delay);
                    observer.disconnect();
                }
            });
        },
        { threshold: 0.05, rootMargin: '0px 0px -100px 0px' }
    );

    observer.observe(section);
}

scrollReveal('footer-contact', 'footer-anim');



