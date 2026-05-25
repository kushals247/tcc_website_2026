(function () {
    'use strict';

    function init() {
        var marquee = document.querySelector('[data-tc-bp-marquee]');
        var track = document.querySelector('[data-tc-bp-track]');
        if (!marquee || !track) return;

        var touchStartX = null;
        var isPaused = false;

        function pauseAnimation() {
            if (!isPaused) { track.style.animationPlayState = 'paused'; isPaused = true; }
        }
        function resumeAnimation() {
            if (isPaused) { track.style.animationPlayState = 'running'; isPaused = false; }
        }

        marquee.addEventListener('touchstart', function (e) {
            touchStartX = e.touches[0].clientX;
            pauseAnimation();
        }, { passive: true });

        marquee.addEventListener('touchend', function () {
            touchStartX = null;
            setTimeout(resumeAnimation, 2000);
        }, { passive: true });

        marquee.addEventListener('touchcancel', function () {
            touchStartX = null;
            resumeAnimation();
        }, { passive: true });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
