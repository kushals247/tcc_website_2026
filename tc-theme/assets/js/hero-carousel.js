/**
 * T&C Hero Carousel
 * Slide rotation, dot navigation, touch swipe, entrance animation.
 * ES5-compatible, vanilla JS, GSAP-enhanced.
 */
(function () {
    'use strict';

    function initHeroCarousel() {
        var hero = document.getElementById('tc-hero');
        if (!hero) {
            return;
        }

        var slides = hero.querySelectorAll('.tc-hero__slide');
        if (!slides || slides.length === 0) {
            return;
        }

        var dotsContainer = hero.querySelector('[data-tc-hero-dots]');
        var dots = dotsContainer ? dotsContainer.querySelectorAll('[data-dot-index]') : [];
        var eyebrow = hero.querySelector('[data-tc-eyebrow]');
        var headline = hero.querySelector('[data-tc-headline]');
        var subheadline = hero.querySelector('[data-tc-subheadline]');
        var ctas = hero.querySelector('[data-tc-ctas]');

        var autoplaySecondsAttr = hero.getAttribute('data-autoplay-seconds');
        var autoplaySeconds = parseInt(autoplaySecondsAttr, 10);
        if (isNaN(autoplaySeconds) || autoplaySeconds <= 0) {
            autoplaySeconds = 6;
        }
        var autoplayMs = autoplaySeconds * 1000;

        var hasGsap = (typeof window.gsap !== 'undefined' && window.gsap !== null);
        var reducedMotionQuery = window.matchMedia ? window.matchMedia('(prefers-reduced-motion: reduce)') : null;
        var prefersReducedMotion = reducedMotionQuery ? reducedMotionQuery.matches : false;

        var ACTIVE_DOT_COLOR = '#FFCD00';
        var INACTIVE_DOT_COLOR = '#E0E0E0';

        var currentIndex = 0;
        var rotateTimer = null;
        var pauseTimer = null;
        var isPaused = false;

        function clearRotateTimer() {
            if (rotateTimer) {
                clearTimeout(rotateTimer);
                rotateTimer = null;
            }
        }

        function clearPauseTimer() {
            if (pauseTimer) {
                clearTimeout(pauseTimer);
                pauseTimer = null;
            }
        }

        function scheduleNext() {
            clearRotateTimer();
            if (isPaused) {
                return;
            }
            rotateTimer = setTimeout(function () {
                goToSlide((currentIndex + 1) % slides.length);
            }, autoplayMs);
        }

        function updateDots(index) {
            if (!dots || dots.length === 0) {
                return;
            }
            for (var i = 0; i < dots.length; i++) {
                if (i === index) {
                    dots[i].style.backgroundColor = ACTIVE_DOT_COLOR;
                    dots[i].setAttribute('aria-current', 'true');
                } else {
                    dots[i].style.backgroundColor = INACTIVE_DOT_COLOR;
                    dots[i].removeAttribute('aria-current');
                }
            }
        }

        function updateSlideOpacity(index) {
            for (var i = 0; i < slides.length; i++) {
                slides[i].style.opacity = (i === index) ? '1' : '0';
            }
        }

        function swapEyebrowText(index) {
            if (!eyebrow) {
                return;
            }
            var slide = slides[index];
            if (!slide) {
                return;
            }
            var newText = slide.getAttribute('data-eyebrow');
            if (newText === null) {
                return;
            }

            if (prefersReducedMotion || !hasGsap) {
                eyebrow.textContent = newText;
                return;
            }

            window.gsap.killTweensOf(eyebrow);
            window.gsap.to(eyebrow, {
                opacity: 0,
                duration: 0.2,
                ease: 'power1.out',
                onComplete: function () {
                    eyebrow.textContent = newText;
                    window.gsap.to(eyebrow, {
                        opacity: 1,
                        duration: 0.3,
                        ease: 'power1.out'
                    });
                }
            });
        }

        function goToSlide(index) {
            if (index < 0 || index >= slides.length) {
                return;
            }
            currentIndex = index;
            updateSlideOpacity(index);
            updateDots(index);
            swapEyebrowText(index);
            scheduleNext();
        }

        function pause() {
            isPaused = true;
            clearRotateTimer();
        }

        function resume() {
            isPaused = false;
            scheduleNext();
        }

        function pauseFor(ms) {
            pause();
            clearPauseTimer();
            pauseTimer = setTimeout(function () {
                pauseTimer = null;
                resume();
            }, ms);
        }

        // Initial state: slide 0 visible, others hidden, dots set
        updateSlideOpacity(0);
        updateDots(0);

        // Hover pause/resume
        hero.addEventListener('mouseenter', function () {
            clearPauseTimer();
            pause();
        });
        hero.addEventListener('mouseleave', function () {
            resume();
        });

        // Dot click navigation
        if (dots && dots.length > 0) {
            for (var d = 0; d < dots.length; d++) {
                (function (dot) {
                    dot.addEventListener('click', function (e) {
                        e.preventDefault();
                        var idxAttr = dot.getAttribute('data-dot-index');
                        var idx = parseInt(idxAttr, 10);
                        if (isNaN(idx)) {
                            return;
                        }
                        goToSlide(idx);
                        pauseFor(8000);
                    });
                }(dots[d]));
            }
        }

        // Touch swipe navigation
        var touchStartX = null;
        var touchStartY = null;
        var SWIPE_THRESHOLD = 50;

        hero.addEventListener('touchstart', function (e) {
            if (!e.touches || e.touches.length === 0) {
                return;
            }
            touchStartX = e.touches[0].clientX;
            touchStartY = e.touches[0].clientY;
            pause();
        }, { passive: true });

        hero.addEventListener('touchend', function (e) {
            if (touchStartX === null) {
                pauseFor(8000);
                return;
            }
            var changedTouch = (e.changedTouches && e.changedTouches.length > 0) ? e.changedTouches[0] : null;
            if (!changedTouch) {
                touchStartX = null;
                touchStartY = null;
                pauseFor(8000);
                return;
            }
            var dx = changedTouch.clientX - touchStartX;
            var dy = changedTouch.clientY - touchStartY;
            touchStartX = null;
            touchStartY = null;

            if (Math.abs(dx) > SWIPE_THRESHOLD && Math.abs(dx) > Math.abs(dy)) {
                if (dx < 0) {
                    // swipe left -> next
                    goToSlide((currentIndex + 1) % slides.length);
                } else {
                    // swipe right -> prev
                    goToSlide((currentIndex - 1 + slides.length) % slides.length);
                }
            }
            pauseFor(8000);
        }, { passive: true });

        hero.addEventListener('touchcancel', function () {
            touchStartX = null;
            touchStartY = null;
            pauseFor(8000);
        }, { passive: true });

        // Entrance animation
        function runEntranceAnimation() {
            if (prefersReducedMotion) {
                // CSS reduced-motion media query handles opacity:1 !important
                scheduleNext();
                return;
            }

            if (!hasGsap) {
                // Fallback: just show elements
                if (eyebrow) { eyebrow.style.opacity = '1'; eyebrow.style.transform = 'none'; }
                if (headline) { headline.style.opacity = '1'; headline.style.transform = 'none'; }
                if (subheadline) { subheadline.style.opacity = '1'; subheadline.style.transform = 'none'; }
                if (ctas) { ctas.style.opacity = '1'; ctas.style.transform = 'none'; }
                scheduleNext();
                return;
            }

            setTimeout(function () {
                var tl = window.gsap.timeline({
                    onComplete: function () {
                        scheduleNext();
                    }
                });

                if (eyebrow) {
                    tl.to(eyebrow, {
                        opacity: 1,
                        y: 0,
                        duration: 0.4,
                        ease: 'power2.out'
                    }, 0);
                }
                if (headline) {
                    tl.to(headline, {
                        opacity: 1,
                        y: 0,
                        duration: 0.5,
                        ease: 'power2.out'
                    }, 0.1);
                }
                if (subheadline) {
                    tl.to(subheadline, {
                        opacity: 1,
                        y: 0,
                        duration: 0.4,
                        ease: 'power2.out'
                    }, 0.2);
                }
                if (ctas) {
                    tl.to(ctas, {
                        opacity: 1,
                        y: 0,
                        duration: 0.4,
                        ease: 'power2.out'
                    }, 0.3);
                }

                // If no elements got added to the timeline, still schedule rotation
                if (!eyebrow && !headline && !subheadline && !ctas) {
                    scheduleNext();
                }
            }, 200);
        }

        runEntranceAnimation();

        // Expose for debugging
        window.tc = window.tc || {};
        window.tc.heroCarousel = {
            goTo: goToSlide,
            pause: pause,
            resume: resume,
            getCurrentIndex: function () { return currentIndex; }
        };
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initHeroCarousel);
    } else {
        initHeroCarousel();
    }
}());
