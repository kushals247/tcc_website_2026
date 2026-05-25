/**
 * T&C Nav Scroll State + Mobile Menu
 *
 * - Toggles `.tc-nav--compact` on `#tc-nav` once the user scrolls past ~80vh.
 * - Handles mobile menu open/close, backdrop, body scroll lock, focus mgmt,
 *   and ESC-to-close.
 * - Respects `prefers-reduced-motion`.
 *
 * ES5-compatible, vanilla JS, no dependencies beyond optional GSAP/ScrollTrigger.
 */
(function () {
    'use strict';

    window.tc = window.tc || {};

    function init() {
        var nav = document.getElementById('tc-nav');
        var toggle = document.getElementById('tc-mobile-menu-toggle');
        var menu = document.getElementById('tc-mobile-menu');
        var closeBtn = document.getElementById('tc-mobile-menu-close');
        var backdrop = document.getElementById('tc-mobile-menu-backdrop');

        var prefersReducedMotion = window.matchMedia &&
            window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        /* ------------------------------------------------------------------
         * 1. Scroll-state transition: add `.tc-nav--compact` past ~80vh
         * ------------------------------------------------------------------ */
        if (nav) {
            var threshold = Math.round(window.innerHeight * 0.8);

            var applyCompact = function (isCompact) {
                if (isCompact) {
                    nav.classList.add('tc-nav--compact');
                    nav.classList.remove('tc-nav--transparent');
                } else {
                    nav.classList.remove('tc-nav--compact');
                    nav.classList.add('tc-nav--transparent');
                }
            };

            if (window.gsap && window.ScrollTrigger) {
                try {
                    window.gsap.registerPlugin(window.ScrollTrigger);
                } catch (e) { /* already registered */ }

                window.ScrollTrigger.create({
                    start: threshold + ' top',
                    end: 'max',
                    onEnter: function () { applyCompact(true); },
                    onLeaveBack: function () { applyCompact(false); },
                    // Reduced-motion: class swap is instant; CSS transitions still smooth.
                    invalidateOnRefresh: true
                });

                // Handle initial load past threshold (deep-link, refresh-while-scrolled).
                applyCompact((window.pageYOffset || document.documentElement.scrollTop) >= threshold);

                // Recompute threshold on resize so it stays at ~80vh.
                var resizeTimer = null;
                window.addEventListener('resize', function () {
                    if (resizeTimer) { clearTimeout(resizeTimer); }
                    resizeTimer = setTimeout(function () {
                        threshold = Math.round(window.innerHeight * 0.8);
                        if (window.ScrollTrigger && window.ScrollTrigger.refresh) {
                            window.ScrollTrigger.refresh();
                        }
                    }, 150);
                });
            } else {
                // Fallback: plain scroll listener if GSAP/ScrollTrigger missing.
                var onScroll = function () {
                    applyCompact((window.pageYOffset || document.documentElement.scrollTop) >= threshold);
                };
                window.addEventListener('scroll', onScroll, { passive: true });
                window.addEventListener('resize', function () {
                    threshold = Math.round(window.innerHeight * 0.8);
                    onScroll();
                });
                onScroll();
            }
        }

        /* ------------------------------------------------------------------
         * 2. Mobile menu open / close
         * ------------------------------------------------------------------ */
        if (!toggle || !menu || !closeBtn || !backdrop) {
            return; // Nothing to wire if mobile menu DOM isn't present.
        }

        var lastFocusedBeforeOpen = null;
        var focusTimer = null;
        var isOpen = false;

        function openMenu() {
            if (isOpen) { return; }
            isOpen = true;

            lastFocusedBeforeOpen = document.activeElement;

            menu.classList.add('is-open');
            menu.setAttribute('aria-hidden', 'false');

            backdrop.classList.add('is-visible');
            backdrop.setAttribute('aria-hidden', 'false');

            toggle.setAttribute('aria-expanded', 'true');

            document.body.style.overflow = 'hidden';

            // Focus close button after transition completes (~350ms).
            if (focusTimer) { clearTimeout(focusTimer); }
            var focusDelay = prefersReducedMotion ? 0 : 350;
            focusTimer = setTimeout(function () {
                if (closeBtn && typeof closeBtn.focus === 'function') {
                    closeBtn.focus();
                }
            }, focusDelay);
        }

        function closeMenu() {
            if (!isOpen) { return; }
            isOpen = false;

            menu.classList.remove('is-open');
            menu.setAttribute('aria-hidden', 'true');

            backdrop.classList.remove('is-visible');
            backdrop.setAttribute('aria-hidden', 'true');

            toggle.setAttribute('aria-expanded', 'false');

            document.body.style.overflow = '';

            if (focusTimer) { clearTimeout(focusTimer); focusTimer = null; }

            // Return focus to the element that opened the menu (the toggle).
            var target = lastFocusedBeforeOpen && typeof lastFocusedBeforeOpen.focus === 'function'
                ? lastFocusedBeforeOpen
                : toggle;
            if (target && typeof target.focus === 'function') {
                target.focus();
            }
            lastFocusedBeforeOpen = null;
        }

        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            if (isOpen) { closeMenu(); } else { openMenu(); }
        });

        closeBtn.addEventListener('click', function (e) {
            e.preventDefault();
            closeMenu();
        });

        backdrop.addEventListener('click', function (e) {
            e.preventDefault();
            closeMenu();
        });

        // ESC to close when open.
        document.addEventListener('keydown', function (e) {
            if (!isOpen) { return; }
            var key = e.key || '';
            if (key === 'Escape' || key === 'Esc' || e.keyCode === 27) {
                closeMenu();
            }
        });

        // Expose minimal API for debugging / programmatic control.
        window.tc.nav = {
            open: openMenu,
            close: closeMenu,
            isOpen: function () { return isOpen; }
        };
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
