(function () {
    'use strict';

    function init() {
        var root = document.getElementById('tc-testimonials');
        if (!root) return;

        var quotes = root.querySelectorAll('.tc-tm__quote');
        var dots = root.querySelectorAll('[data-dot-index]');
        if (quotes.length < 2) return;

        var autoplaySec = parseInt(root.getAttribute('data-autoplay-seconds'), 10) || 8;
        var current = 0;
        var timer = null;
        var paused = false;

        var prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        function showQuote(idx) {
            for (var i = 0; i < quotes.length; i++) {
                quotes[i].style.opacity = (i === idx) ? '1' : '0';
            }
            for (var d = 0; d < dots.length; d++) {
                dots[d].style.background = (d === idx) ? '#FFCD00' : 'rgba(255,255,255,0.3)';
            }
            current = idx;
        }

        function advance() {
            if (paused) return;
            showQuote((current + 1) % quotes.length);
        }

        function startAutoplay() {
            stopAutoplay();
            timer = setInterval(advance, autoplaySec * 1000);
        }

        function stopAutoplay() {
            if (timer) { clearInterval(timer); timer = null; }
        }

        function pauseFor(ms) {
            stopAutoplay();
            setTimeout(startAutoplay, ms);
        }

        for (var k = 0; k < dots.length; k++) {
            (function (dot) {
                dot.addEventListener('click', function () {
                    var i = parseInt(dot.getAttribute('data-dot-index'), 10);
                    showQuote(i);
                    pauseFor(8000);
                });
            })(dots[k]);
        }

        root.addEventListener('mouseenter', function () { paused = true; });
        root.addEventListener('mouseleave', function () { paused = false; });

        var touchStartX = null;
        root.addEventListener('touchstart', function (e) { touchStartX = e.touches[0].clientX; }, { passive: true });
        root.addEventListener('touchend', function (e) {
            if (touchStartX === null) return;
            var dx = e.changedTouches[0].clientX - touchStartX;
            if (Math.abs(dx) > 50) {
                var next = dx < 0 ? (current + 1) % quotes.length : (current - 1 + quotes.length) % quotes.length;
                showQuote(next);
                pauseFor(8000);
            }
            touchStartX = null;
        }, { passive: true });

        startAutoplay();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
