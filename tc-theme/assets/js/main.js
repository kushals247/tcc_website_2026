(function () {
    'use strict';

    window.tc = window.tc || {};
    if (typeof console !== 'undefined' && console.log) {
        console.log('tc-theme loaded (v0.2.1)');
    }

    if (typeof window.gsap === 'undefined' || typeof window.ScrollTrigger === 'undefined') {
        return;
    }

    try {
        window.gsap.registerPlugin(window.ScrollTrigger);
    } catch (e) { /* already registered */ }

    var prefersReducedMotion = window.matchMedia &&
        window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) {
        return;
    }

    function isInOrAboveViewport(el) {
        if (!el || !el.getBoundingClientRect) { return false; }
        var rect = el.getBoundingClientRect();
        var vh = window.innerHeight || document.documentElement.clientHeight;
        return rect.top < vh * 0.85;
    }

    function animateHeader(el) {
        window.gsap.from(el, {
            opacity: 0,
            y: 24,
            duration: 0.5,
            ease: 'power2.out',
            immediateRender: false
        });
    }

    function animateCards(batch) {
        window.gsap.from(batch, {
            opacity: 0,
            y: 32,
            duration: 0.6,
            ease: 'power3.out',
            stagger: 0.1,
            immediateRender: false
        });
    }

    function init() {
        var headers = document.querySelectorAll('[data-tc-eco-header]');
        var cards = document.querySelectorAll('[data-tc-eco-card]');

        if (!window.ScrollTrigger || typeof window.ScrollTrigger.batch !== 'function') {
            return;
        }

        if (headers.length) {
            window.ScrollTrigger.batch(headers, {
                start: 'top 85%',
                onEnter: function (batch) { animateHeader(batch); },
                once: true
            });
            for (var h = 0; h < headers.length; h++) {
                if (isInOrAboveViewport(headers[h])) { animateHeader(headers[h]); }
            }
        }

        if (cards.length) {
            window.ScrollTrigger.batch(cards, {
                start: 'top 85%',
                onEnter: function (batch) { animateCards(batch); },
                once: true
            });
            var visibleCards = [];
            for (var c = 0; c < cards.length; c++) {
                if (isInOrAboveViewport(cards[c])) { visibleCards.push(cards[c]); }
            }
            if (visibleCards.length) { animateCards(visibleCards); }
        }

        if (typeof window.ScrollTrigger.refresh === 'function') {
            window.ScrollTrigger.refresh();
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
