// public/js/front-end/animate/about.js
document.addEventListener('DOMContentLoaded', () => {

    const { animate, stagger, createAnimatable, utils } = anime;

    // ------------------------------------------------------------------
    // Motion preferences
    // ------------------------------------------------------------------
    const reducedMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
    const noHoverQuery = window.matchMedia('(hover: none)');
    const prefersReducedMotion = () => reducedMotionQuery.matches;

    // Put elements straight into their final (visible) state, no animation.
    function showFinal(targets) {
        let list;
        if (typeof targets === 'string') list = document.querySelectorAll(targets);
        else if (targets instanceof Element) list = [targets];
        else list = targets || [];

        Array.from(list).forEach((el) => {
            el.style.opacity = '1';
            el.style.transform = 'none';
            el.style.filter = 'none';
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
    function scrollReveal(sectionId, targetClass, delay = 0, options = {}) {
        const section = document.getElementById(sectionId);
        if (!section) return;

        const selector = `.${targetClass}`;

        if (prefersReducedMotion()) {
            showFinal(selector);
            return;
        }

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            animate(selector, {
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
            { threshold: 0.05, rootMargin: '0px 0px -100px 0px', ...options }
        );

        observer.observe(section);
    }

    scrollReveal('about', 'about-anim');

    // The experience track is very tall, so a ratio threshold would fire late; threshold 0 fires on first contact.
    scrollReveal('exp-track', 'exp-anim', 0, { threshold: 0 });

    // ------------------------------------------------------------------
    // Experience — scroll-pinned card stepper
    //
    // Layout contract (see experience.blade.php / skills-split.blade.php):
    //   track height = 200dvh + (cards - 1) * vhPerCard
    //   pinnedDistance = track height - 2 * viewport height
    //   -> card switching is complete exactly when Skills starts to cover the pinned section.
    // ------------------------------------------------------------------
    function initExpSteps() {
        const track = document.getElementById('exp-track');
        const box = document.getElementById('exp-box');
        if (!track || !box) return;

        const steps = track.querySelectorAll('.exp-step');
        const dots = document.querySelectorAll('#exp-dots .exp-dot');
        const stepCount = steps.length;
        if (!stepCount) return;

        let currentIndex = -1;

        // Scroll distance over which cards switch (excludes the pin's own 100dvh and the overlap 100dvh)
        function getPinnedDistance() {
            return Math.max(track.offsetHeight - window.innerHeight * 2, 0);
        }

        // Scroll distance between two consecutive cards
        function getStepScroll() {
            return getPinnedDistance() / Math.max(stepCount - 1, 1);
        }

        // Size the box once to the tallest card so the layout never shifts
        function sizeBox() {
            let maxHeight = 0;
            steps.forEach((step) => {
                const card = step.querySelector(':scope > div:not(.exp-circle)');
                if (card) maxHeight = Math.max(maxHeight, card.offsetHeight);
            });
            box.style.height = maxHeight + 'px';
        }

        function showStep(activeIndex) {
            steps.forEach((step, i) => {
                const isActive = i === activeIndex;
                step.style.opacity = isActive ? '1' : '0';
                step.style.filter = isActive ? 'blur(0px)' : 'blur(6px)';
                step.style.transform = isActive ? 'scale(1)' : 'scale(0.96)';
            });

            // Sync the pagination dots
            dots.forEach((dot, i) => {
                const isActive = i === activeIndex;
                dot.dataset.active = isActive ? 'true' : 'false';
                dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
            });
        }

        function updateActiveStep() {
            const rect = track.getBoundingClientRect();
            const pinnedDistance = getPinnedDistance();
            const stepScroll = getStepScroll();
            const scrolled = Math.min(Math.max(-rect.top, 0), pinnedDistance);

            const activeIndex =
                stepScroll > 0
                    ? Math.min(Math.round(scrolled / stepScroll), stepCount - 1)
                    : 0;

            if (activeIndex === currentIndex) return;
            currentIndex = activeIndex;
            showStep(activeIndex);
        }

        // Click a dot -> scroll to where that card becomes fully active
        function goToStep(index) {
            const trackTop = track.getBoundingClientRect().top + window.scrollY;
            const target = trackTop + index * getStepScroll();
            window.scrollTo({
                top: target,
                behavior: prefersReducedMotion() ? 'auto' : 'smooth',
            });
        }

        dots.forEach((dot) => {
            dot.addEventListener('click', () => goToStep(Number(dot.dataset.index)));
        });

        const stepTransition = prefersReducedMotion()
            ? 'none'
            : 'opacity 0.5s ease, filter 0.5s ease, transform 0.5s ease';

        steps.forEach((step) => {
            step.style.transition = stepTransition;
        });

        sizeBox();
        window.addEventListener('load', sizeBox);
        window.addEventListener('resize', () => {
            sizeBox();
            updateActiveStep();
        });
        window.addEventListener('scroll', updateActiveStep, { passive: true });
        updateActiveStep();
    }

    initExpSteps();

    // ------------------------------------------------------------------
    // Experience -> Skills hand-off: as Skills slides up over the pinned
    // Experience section, Experience blurs/fades so focus shifts to Skills.
    // Scroll-linked (progress 0 -> 1 across the 100dvh overlap zone).
    // Skipped for reduced motion.
    // ------------------------------------------------------------------
    function initExpOverlapBlur() {
        if (prefersReducedMotion()) return;

        const track = document.getElementById('exp-track');
        const pinned = track?.querySelector(':scope > section');
        if (!track || !pinned) return;

        const MAX_BLUR = 8;      // px of blur when fully covered
        const MIN_OPACITY = 0.4; // opacity when fully covered
        const MIN_SCALE = 0.97;  // slight push-back when fully covered

        let ticking = false;

        function update() {
            ticking = false;

            const vh = window.innerHeight;
            const pinnedDistance = Math.max(track.offsetHeight - vh * 2, 0);
            const scrolled = -track.getBoundingClientRect().top;
            const raw = utils.clamp((scrolled - pinnedDistance) / vh, 0, 1);

            if (raw === 0) {
                pinned.style.filter = '';
                pinned.style.opacity = '';
                pinned.style.transform = '';
                pinned.style.willChange = '';
                return;
            }

            // Ease-in so the blur builds gently, then deepens as Skills takes over
            const p = raw * raw;

            pinned.style.willChange = 'filter, opacity, transform';
            pinned.style.filter = `blur(${(p * MAX_BLUR).toFixed(2)}px)`;
            pinned.style.opacity = String(1 - p * (1 - MIN_OPACITY));
            pinned.style.transform = `scale(${(1 - p * (1 - MIN_SCALE)).toFixed(4)})`;
        }

        function onScroll() {
            if (ticking) return;
            ticking = true;
            requestAnimationFrame(update);
        }

        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', onScroll);
        update();
    }

    initExpOverlapBlur();

    // ------------------------------------------------------------------
    // Settle: if scrolling stops while Skills is only part-way over
    // Experience, finish the cover (scrolling down) or pull it back
    // (scrolling up), so Skills never rests with a strip of Experience
    // showing above it. Not scroll-snap; it only reacts after scrolling idles.
    // ------------------------------------------------------------------
    function initCoverSettle() {
        if (prefersReducedMotion()) return;

        const expTrack = document.getElementById('exp-track');
        if (!expTrack) return;

        let lastY = window.scrollY;
        let direction = 1;
        let timer = null;
        let settling = false;

        function settle() {
            const vh = window.innerHeight;
            const expTop = expTrack.getBoundingClientRect().top + window.scrollY;
            const coverStart = expTop + Math.max(expTrack.offsetHeight - vh * 2, 0);
            const coverEnd = coverStart + vh;
            const y = window.scrollY;

            // Only act while the cover is in progress
            if (y <= coverStart + 2 || y >= coverEnd - 1) return;

            settling = true;
            window.scrollTo({ top: direction > 0 ? coverEnd : coverStart, behavior: 'smooth' });
            setTimeout(() => { settling = false; }, 800);
        }

        window.addEventListener(
            'scroll',
            () => {
                const y = window.scrollY;
                if (!settling && y !== lastY) direction = y > lastY ? 1 : -1;
                lastY = y;

                clearTimeout(timer);
                if (!settling) timer = setTimeout(settle, 140);
            },
            { passive: true }
        );
    }

    initCoverSettle();

    // ------------------------------------------------------------------
    // Experience section — circles drift toward/away from the cursor
    // (skipped for reduced motion and touch / no-hover devices)
    // ------------------------------------------------------------------
    function initExpCircleParallax() {
        if (prefersReducedMotion() || noHoverQuery.matches) return;

        const box = document.getElementById('exp-box');
        if (!box) return;

        const INTENSITY = 0.35;
        const MAX_TRAVEL = 0.5;
        const DURATION = 100;
        const EASE = 'out(2)';

        let bounds = box.getBoundingClientRect();
        const refreshBounds = () => (bounds = box.getBoundingClientRect());

        window.addEventListener('resize', refreshBounds);
        window.addEventListener('scroll', refreshBounds, { passive: true });

        const readFactor = (value, fallback) => {
            const n = parseFloat(value);
            return Number.isNaN(n) ? fallback : n;
        };

        const circles = Array.from(document.querySelectorAll('.exp-circle')).map((el) => ({
            animatable: createAnimatable(el, {
                x: DURATION,
                y: DURATION,
                ease: EASE,
            }),
            factorX: readFactor(el.dataset.factorX, 0.3),
            factorY: readFactor(el.dataset.factorY, 0.3),
        }));

        if (!circles.length) return;

        window.addEventListener('mousemove', (e) => {
            const maxX = (bounds.width / 2) * MAX_TRAVEL;
            const maxY = (bounds.height / 2) * MAX_TRAVEL;
            const relX = utils.clamp(e.clientX - bounds.left - bounds.width / 2, -maxX, maxX);
            const relY = utils.clamp(e.clientY - bounds.top - bounds.height / 2, -maxY, maxY);

            circles.forEach(({ animatable, factorX, factorY }) => {
                animatable.x(relX * factorX * INTENSITY).y(relY * factorY * INTENSITY);
            });
        });
    }

    initExpCircleParallax();

    // ------------------------------------------------------------------
    // Skills section — logo/name fade-in + level dot fill
    // (single trigger: the IntersectionObserver below)
    // ------------------------------------------------------------------
    function animateSkillBars(scopeSelector = '#skills') {
        const items = document.querySelectorAll(
            `${scopeSelector} .skill-logo, ${scopeSelector} .skill-name`
        );
        const dots = document.querySelectorAll(`${scopeSelector} .skill-dot`);

        if (prefersReducedMotion()) {
            showFinal(items);
            showFinal(dots);
            return;
        }

        if (items.length) {
            items.forEach((el) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(10px)';
            });

            animate(items, {
                opacity: [0, 1],
                translateY: [10, 0],
                ease: 'outExpo',
                duration: 700,
                delay: stagger(40),
            });
        }

        if (dots.length) {
            dots.forEach((dot) => {
                dot.style.opacity = '0';
                dot.style.transform = 'scaleX(0.3)';
            });

            animate(dots, {
                opacity: [0, 1],
                scaleX: [0.3, 1],
                ease: 'outExpo',
                duration: 600,
                delay: stagger(40),
            });
        }
    }

    function fadeOutSkills(scopeSelector) {
        return new Promise((resolve) => {
            if (prefersReducedMotion()) return resolve();

            const target = document.querySelectorAll(
                `${scopeSelector} .skill-logo, ${scopeSelector} .skill-name, ${scopeSelector} .skill-dot`
            );
            if (!target.length) return resolve();

            animate(target, {
                opacity: [1, 0],
                ease: 'outQuad',
                duration: 250,
                delay: stagger(15),
                onComplete: resolve,
            });
        });
    }

    window.animateSkillBars = animateSkillBars;
    window.fadeOutSkills = fadeOutSkills;

    (function () {
        const section = document.getElementById('skills');
        if (!section) return;

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        animateSkillBars('#developer-skills-grid');
                        observer.disconnect();
                    }
                });
            },
            { threshold: 0.2 }
        );

        observer.observe(section);
    })();

    // ------------------------------------------------------------------
    // About image — blur + scale entrance
    // ------------------------------------------------------------------
    function aboutImageReveal() {
        const section = document.getElementById('about');
        const img = section?.querySelector('.about-img');
        if (!img) return;

        if (prefersReducedMotion()) {
            showFinal(img);
            return;
        }

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        animate(img, {
                            opacity: [0, 1],
                            scale: [0.95, 1],
                            filter: ['blur(24px)', 'blur(0px)'],
                            ease: 'outQuart',
                            duration: 1200,
                        });
                        observer.disconnect();
                    }
                });
            },
            { threshold: 0.05, rootMargin: '0px 0px -100px 0px' }
        );

        observer.observe(section);
    }

    aboutImageReveal();

});
