(function () {
    'use strict';

    window.tc = window.tc || {};

    function init() {
        var triggers = document.querySelectorAll('[data-megamenu-trigger]');
        var panels = document.querySelectorAll('.tc-megamenu-panel');
        var backdrop = document.getElementById('tc-megamenu-backdrop');
        if (!triggers.length || !panels.length) return;

        var openPanel = null;
        var openTrigger = null;
        var lastFocused = null;
        var prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        function panelById(slug) { return document.getElementById('tc-megamenu-' + slug); }

        function closeAll() {
            for (var i = 0; i < panels.length; i++) {
                panels[i].classList.remove('is-open');
                panels[i].setAttribute('aria-modal', 'false');
            }
            if (backdrop) backdrop.classList.remove('is-visible');
            for (var t = 0; t < triggers.length; t++) {
                triggers[t].setAttribute('aria-expanded', 'false');
                triggers[t].classList.remove('is-open');
            }
            if (lastFocused && typeof lastFocused.focus === 'function') {
                lastFocused.focus();
            }
            openPanel = null;
            openTrigger = null;
        }

        function openFor(slug, trigger) {
            var panel = panelById(slug);
            if (!panel) return;
            if (openPanel && openPanel !== panel) {
                openPanel.classList.remove('is-open');
                openPanel.setAttribute('aria-modal', 'false');
                if (openTrigger) {
                    openTrigger.setAttribute('aria-expanded', 'false');
                    openTrigger.classList.remove('is-open');
                }
            }
            lastFocused = document.activeElement;
            panel.classList.add('is-open');
            panel.setAttribute('aria-modal', 'true');
            if (backdrop) backdrop.classList.add('is-visible');
            if (trigger) {
                trigger.setAttribute('aria-expanded', 'true');
                trigger.classList.add('is-open');
            }
            openPanel = panel;
            openTrigger = trigger;
            if (window.gsap && !prefersReducedMotion) {
                try { window.gsap.killTweensOf(panel.querySelectorAll('.tc-megamenu-subcat')); } catch (e) {}
                window.gsap.from(panel.querySelectorAll('.tc-megamenu-subcat'), {
                    opacity: 0, x: -10, duration: 0.3, stagger: 0.03, delay: 0.15, ease: 'power2.out'
                });
            }
            var firstFocusable = panel.querySelector('a, button');
            if (firstFocusable && typeof firstFocusable.focus === 'function') {
                setTimeout(function () { firstFocusable.focus(); }, 100);
            }
        }

        for (var i = 0; i < triggers.length; i++) {
            (function (trigger) {
                trigger.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var slug = trigger.getAttribute('data-megamenu-trigger');
                    if (openTrigger === trigger) {
                        closeAll();
                    } else {
                        openFor(slug, trigger);
                    }
                });
            })(triggers[i]);
        }

        if (backdrop) {
            backdrop.addEventListener('click', closeAll);
        }

        document.addEventListener('keydown', function (e) {
            if (!openPanel) return;
            var key = e.key || '';
            if (key === 'Escape' || key === 'Esc' || e.keyCode === 27) {
                closeAll();
            }
        });

        document.addEventListener('click', function (e) {
            if (!openPanel) return;
            if (openPanel.contains(e.target)) return;
            if (openTrigger && openTrigger.contains(e.target)) return;
            closeAll();
        });

        window.tc.megaMenu = { open: openFor, close: closeAll };
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
