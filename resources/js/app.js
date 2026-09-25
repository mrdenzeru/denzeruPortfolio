import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

import { animate, stagger, createAnimatable, utils } from 'animejs';

// Hero — plays immediately on page load
animate('.hero-anim', {
    opacity: [0, 1],
    translateY: [30, 0],
    ease: 'outExpo',
    duration: 900,
    delay: stagger(150),
});

// Navbar — plays immediately on page load
animate('.nav-anim', {
    opacity: [0, 1],
    translateY: [-40, 0],
    ease: 'outBack',
    duration: 800,
});

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

scrollReveal('about', 'about-anim');
scrollReveal('services', 'services-anim');
scrollReveal('recent-works', 'works-anim');
scrollReveal('testimonials', 'testimonials-anim');
scrollReveal('blogs', 'blogs-anim');
scrollReveal('footer-contact', 'footer-anim');


// Logo cloud — scroll-triggered blur + scale reveal
function logoReveal(sectionId, targetClass) {
    const section = document.getElementById(sectionId);
    if (!section) return;

    const target = section.querySelector(`.${targetClass}`);
    if (!target) return;

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


function initExpSteps() {
    const track = document.getElementById('exp-track');
    const box = document.getElementById('exp-box');
    if (!track || !box) return;

    const steps = track.querySelectorAll('.exp-step');
    const stepCount = steps.length;

    function setBoxHeight(index) {
        const activeEl = steps[index].querySelector(':scope > div'); // the inner card
        if (activeEl) {
            box.style.height = activeEl.offsetHeight + 'px';
        }
    }

    function updateActiveStep() {
        const rect = track.getBoundingClientRect();
        const trackHeight = track.offsetHeight;
        const viewportCenter = window.innerHeight / 2;

        const scrolled = -rect.top + viewportCenter;
        const progress = Math.min(Math.max(scrolled / trackHeight, 0), 0.999);
        const activeIndex = Math.floor(progress * stepCount);

        steps.forEach((step, i) => {
            if (i === activeIndex) {
                if (step.dataset.shown !== 'true') {
                    step.style.opacity = '1';
                    step.style.filter = 'blur(0px)';
                    step.style.transform = 'scale(1)';
                    step.dataset.shown = 'true';
                    setBoxHeight(i);
                }
            } else {
                step.style.opacity = '0';
                step.style.filter = 'blur(6px)';
                step.style.transform = 'scale(0.96)';
                step.dataset.shown = 'false';
            }
        });
    }

    steps.forEach((step) => {
        step.style.transition = 'opacity 0.5s ease, filter 0.5s ease, transform 0.5s ease';
    });

    // Set initial height before first scroll calculation
    setBoxHeight(0);

    window.addEventListener('scroll', updateActiveStep);
    updateActiveStep();
}

initExpSteps();

// Add createAnimatable and utils to your existing animejs import at the top of app.js:
// import { animate, stagger, createAnimatable, utils } from 'animejs';

// Experience section — circles drift toward/away from the cursor, each at its own
// speed and direction (set per-circle via data-factor-x / data-factor-y in the Blade file).
function initExpCircleParallax() {
    const box = document.getElementById('exp-box');
    if (!box) return;

    let bounds = box.getBoundingClientRect();
    const refreshBounds = () => (bounds = box.getBoundingClientRect());

    window.addEventListener('resize', refreshBounds);
    window.addEventListener('scroll', refreshBounds, { passive: true });

    const circles = Array.from(document.querySelectorAll('.exp-circle')).map((el) => ({
        animatable: createAnimatable(el, {
            x: 0,
            y: 0,
            ease: 'out(4)',
        }),
        factorX: parseFloat(el.dataset.factorX) || 0.3,
        factorY: parseFloat(el.dataset.factorY) || 0.3,
    }));

    if (!circles.length) return;

    window.addEventListener('mousemove', (e) => {
        const hw = bounds.width / 2;
        const hh = bounds.height / 2;
        const relX = utils.clamp(e.clientX - bounds.left - hw, -hw, hw);
        const relY = utils.clamp(e.clientY - bounds.top - hh, -hh, hh);

        circles.forEach(({ animatable, factorX, factorY }) => {
            animatable.x(relX * factorX).y(relY * factorY);
        });
    });
}

initExpCircleParallax();


// Skills section — fade-in reveal on scroll (reuses the existing helper)
scrollReveal('skills', 'skills-anim');

// Animated progress bar fill for the skills section.
// scopeSelector limits it to one grid at a time (e.g. '#dev-skills-grid'),
// so switching tabs replays the fill for just the newly shown bars.
function animateSkillBars(scopeSelector = '#skills') {
    const bars = document.querySelectorAll(`${scopeSelector} .skill-bar-fill`);
    if (!bars.length) return;

    bars.forEach((bar) => {
        bar.style.width = '0%';
    });

    animate(bars, {
        width: (el) => `${el.dataset.level}%`,
        ease: 'outExpo',
        duration: 900,
        delay: stagger(100),
    });
}

// Expose it so the Alpine x-init / @click handlers in skills-split.blade.php can call it
window.animateSkillBars = animateSkillBars;

// Trigger the developer grid's bars once when the section first scrolls into view
// (the designer grid's bars get animated the first time that tab is clicked, via
// the @click handler already wired up in the Blade file).
(function () {
    const section = document.getElementById('skills');
    if (!section) return;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    animateSkillBars('#dev-skills-grid');
                    observer.disconnect();
                }
            });
        },
        { threshold: 0.2 }
    );

    observer.observe(section);
})();
