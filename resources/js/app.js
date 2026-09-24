import './bootstrap';

import { animate, stagger } from 'animejs';

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
