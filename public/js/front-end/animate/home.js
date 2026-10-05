// public/js/front-end/animate/home.js
document.addEventListener('DOMContentLoaded', () => {

    const { animate, stagger, utils, onScroll } = anime;

    const reducedMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
    const noHoverQuery = window.matchMedia('(hover: none)');
    const prefersReducedMotion = () => reducedMotionQuery.matches;

    // Put elements straight into their final (visible) state, no animation.
    function showFinal(targets) {
        const list = typeof targets === 'string' ? document.querySelectorAll(targets) : targets;
        Array.from(list).forEach((el) => {
            el.style.opacity = '1';
            el.style.transform = 'none';
        });
    }

    // ------------------------------------------------------------------
    // Hero entrance
    // ------------------------------------------------------------------
    if (prefersReducedMotion()) {
        showFinal('.hero-anim');
    } else {
        animate('.hero-anim', {
            opacity: [0, 1],
            translateY: [30, 0],
            ease: 'outExpo',
            duration: 900,
            delay: stagger(150),
        });
    }

    // ------------------------------------------------------------------
    // Reusable scroll-reveal helper
    // ------------------------------------------------------------------
    function scrollReveal(sectionId, targetClass, delay = 0) {
        const section = document.getElementById(sectionId);
        if (!section) return;

        if (prefersReducedMotion()) {
            showFinal(`.${targetClass}`);
            return;
        }

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

    scrollReveal('about', 'about-anim');
    scrollReveal('services', 'services-anim');
    scrollReveal('recent-works', 'works-anim');
    scrollReveal('testimonials', 'testimonials-anim');
    scrollReveal('blogs', 'blogs-anim');

    // ------------------------------------------------------------------
    // Random parallax (anime.js onScroll, synced to scroll position)
    //
    // 1. Decorative shapes are spawned at random positions / sizes / colors inside a
    //    clipped layer behind each section's content (no horizontal overflow possible).
    // 2. Selected images/cards get a small random drift.
    // 3. Anything with data-parallax="<px>" also gets one (omit the number for a random amount).
    //
    // Every element gets its own random distance and direction on each page load.
    // Parallax never touches elements that carry a reveal class (about-anim, works-anim, ...),
    // so it can't fight the reveal's transform.
    // ------------------------------------------------------------------

    // Tweak these:
    const PARALLAX_SECTIONS = [
        // dark: true = the section has a dark background, so use lighter/subtler shapes
        { id: 'hero',         shapes: 6, dark: false },
        { id: 'about',        shapes: 4, dark: false },
        { id: 'services',     shapes: 4, dark: false },
        { id: 'recent-works', shapes: 5, dark: true  },
        { id: 'testimonials', shapes: 4, dark: false },
        { id: 'blogs',        shapes: 3, dark: false },
    ];

    const PARALLAX_ITEMS = [
        // range: [min, max] px of drift either way; each element picks a random value in it
        { section: 'services',     selector: '#services img',                              range: [6, 14] },
        { section: 'recent-works', selector: '#recent-works .work-card > div:first-child', range: [8, 16] },
        { section: 'testimonials', selector: '#testimonials .rounded-full.bg-gray-300',    range: [4, 10] },
        { section: 'blogs',        selector: '#blogs .blogs-anim > div:first-child',       range: [8, 18] },
    ];

    const SHAPE_SIZE = [90, 260];   // px
    const SHAPE_TRAVEL = [40, 140]; // px of vertical drift either way
    const SHAPE_DRIFT_X = 30;       // px of sideways drift either way (clipped by the layer)

    const LIGHT_PALETTE = [
        { color: '#FFC30B', min: 0.25, max: 0.55 },
        { color: '#00224D', min: 0.06, max: 0.16 },
    ];
    const DARK_PALETTE = [
        { color: '#FFC30B', min: 0.10, max: 0.25 },
        { color: '#FFFFFF', min: 0.03, max: 0.08 },
    ];

    const randomSign = () => (utils.random(0, 1, 2) < 0.5 ? -1 : 1);

    // One linear animation per element, driven by how far its section has scrolled through the viewport.
    function attachParallax(el, section, props) {
        animate(el, {
            ...props,
            ease: 'linear',
            autoplay: onScroll({ target: section, sync: true }),
        });
    }

    function createShapeLayer(host, { count, dark }) {
        if (getComputedStyle(host).position === 'static') host.style.position = 'relative';
        host.style.isolation = 'isolate'; // keeps the z-index:-1 layer above the host's bg, below its content

        const layer = document.createElement('div');
        layer.setAttribute('aria-hidden', 'true');
        layer.dataset.parallaxLayer = '';
        Object.assign(layer.style, {
            position: 'absolute',
            inset: '0',
            overflow: 'hidden',
            pointerEvents: 'none',
            zIndex: '-1',
        });

        const palette = dark ? DARK_PALETTE : LIGHT_PALETTE;
        const touch = noHoverQuery.matches;
        const amount = touch ? Math.max(Math.ceil(count / 2), 1) : count;
        const scale = touch ? 0.5 : 1;
        const shapes = [];

        for (let i = 0; i < amount; i++) {
            const tone = palette[Math.floor(utils.random(0, palette.length - 0.001, 3))];
            const size = utils.random(SHAPE_SIZE[0], SHAPE_SIZE[1], 0);

            const shape = document.createElement('span');
            Object.assign(shape.style, {
                position: 'absolute',
                left: `${utils.random(-5, 95, 1)}%`,
                top: `${utils.random(0, 90, 1)}%`,
                width: `${size}px`,
                height: `${size}px`,
                borderRadius: '9999px',
                background: tone.color,
                opacity: String(utils.random(tone.min, tone.max, 2)),
                filter: `blur(${utils.random(2, 10, 0)}px)`,
                willChange: 'transform',
            });

            layer.appendChild(shape);
            shapes.push({
                el: shape,
                dy: randomSign() * utils.random(SHAPE_TRAVEL[0], SHAPE_TRAVEL[1], 0) * scale,
                dx: randomSign() * utils.random(0, SHAPE_DRIFT_X, 0) * scale,
                s0: utils.random(0.85, 1, 2),
                s1: utils.random(1, 1.25, 2),
            });
        }

        host.prepend(layer);
        return shapes;
    }

    function initParallax() {
        const reduced = prefersReducedMotion();
        const touchFactor = noHoverQuery.matches ? 0.5 : 1;

        // 1) Random decorative shapes
        PARALLAX_SECTIONS.forEach(({ id, shapes, dark }) => {
            const host = document.getElementById(id);
            if (!host) return;

            const created = createShapeLayer(host, { count: shapes, dark });
            if (reduced) return; // shapes stay as static decoration

            created.forEach(({ el, dy, dx, s0, s1 }) => {
                attachParallax(el, host, {
                    y: [-dy, dy],
                    x: [-dx, dx],
                    scale: [s0, s1],
                });
            });
        });

        if (reduced) return;

        // 2) Random drift for existing images / cards
        PARALLAX_ITEMS.forEach(({ section, selector, range }) => {
            const host = document.getElementById(section);
            if (!host) return;

            host.querySelectorAll(selector).forEach((el) => {
                const d = randomSign() * utils.random(range[0], range[1], 0) * touchFactor;
                attachParallax(el, host, { y: [-d, d] });
            });
        });

        // 3) Manual hooks: <div data-parallax="20"> (px) or <div data-parallax> (random 8-20px)
        document.querySelectorAll('[data-parallax]').forEach((el) => {
            const host = el.closest('[id]') || document.body;
            const manual = parseFloat(el.dataset.parallax);
            const amount = Number.isNaN(manual) ? utils.random(8, 20, 0) : manual;
            const d = randomSign() * amount * touchFactor;
            attachParallax(el, host, { y: [-d, d] });
        });
    }

    initParallax();

    // ------------------------------------------------------------------
    // Recent works — filter tabs (used by the Alpine tabs in recent-projects.blade.php)
    // Only cards that are currently displayed are animated; Alpine's x-show hides the rest.
    // ------------------------------------------------------------------
    function visibleWorkCards(scopeSelector) {
        return Array.from(document.querySelectorAll(`${scopeSelector} .work-card`)).filter(
            (el) => el.offsetParent !== null
        );
    }

    function animateWorks(scopeSelector = '#works-grid') {
        const cards = visibleWorkCards(scopeSelector);
        if (!cards.length) return;

        if (prefersReducedMotion()) {
            showFinal(cards);
            return;
        }

        cards.forEach((el) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
        });

        animate(cards, {
            opacity: [0, 1],
            translateY: [20, 0],
            ease: 'outExpo',
            duration: 700,
            delay: stagger(80),
        });
    }

    function fadeOutWorks(scopeSelector = '#works-grid') {
        return new Promise((resolve) => {
            const cards = visibleWorkCards(scopeSelector);
            if (prefersReducedMotion() || !cards.length) return resolve();

            animate(cards, {
                opacity: [1, 0],
                ease: 'outQuad',
                duration: 250,
                delay: stagger(20),
                onComplete: resolve,
            });
        });
    }

    window.animateWorks = animateWorks;
    window.fadeOutWorks = fadeOutWorks;

    // ------------------------------------------------------------------
    // Logo cloud — scroll-triggered blur + scale reveal
    // ------------------------------------------------------------------
    function logoReveal(sectionId, targetClass) {
        const section = document.getElementById(sectionId);
        if (!section) return;

        const target = section.querySelector(`.${targetClass}`);
        if (!target) return;

        if (prefersReducedMotion()) return; // leave the marquee as authored

        target.style.opacity = '0';
        target.style.filter = 'blur(10px)';
        target.style.transform = 'scale(0.92)';

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        animate(target, {
                            opacity: [0, 0.6], // fades to the marquee's own opacity-60, not full opacity
                            scale: [0.92, 1],
                            filter: ['blur(10px)', 'blur(0px)'],
                            ease: 'outQuart',
                            duration: 1100,
                        });
                        observer.disconnect();
                    }
                });
            },
            { threshold: 0.05, rootMargin: '0px 0px -100px 0px' }
        );

        observer.observe(section);
    }

    logoReveal('logo-cloud', 'logo-anim');

});
