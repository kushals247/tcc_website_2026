(function () {
    'use strict';

    function init() {
        var fab = document.getElementById('tc-whatsapp-fab');
        if (!fab) return;

        var threshold = window.innerHeight * 0.5;

        function check() {
            var scrollY = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollY >= threshold) {
                fab.classList.add('is-visible');
            } else {
                fab.classList.remove('is-visible');
            }
        }

        window.addEventListener('scroll', check, { passive: true });
        window.addEventListener('resize', function () {
            threshold = window.innerHeight * 0.5;
            check();
        });
        check();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
