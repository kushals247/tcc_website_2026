<?php
if (!defined('ABSPATH')) exit;
?>
<div id="tc-cookie-banner" class="hidden fixed bottom-0 left-0 right-0 z-50 bg-[#3A3D40] text-white p-4 md:p-6 shadow-2xl" role="region" aria-label="Cookie consent">
    <div class="flex flex-col md:flex-row items-start md:items-center gap-4 max-w-6xl mx-auto">
        <p class="flex-1 text-sm md:text-base">We use cookies to improve your experience and to understand how visitors use our site. By continuing, you accept our use of cookies.</p>
        <div class="flex gap-3 flex-shrink-0">
            <button type="button" id="tc-cookie-accept" class="bg-[#FFCD00] text-[#3A3D40] px-6 py-3 font-medium hover:bg-[#FFD52E] cursor-pointer text-sm">Accept</button>
            <a href="<?php echo esc_url(home_url('/privacy/#cookies')); ?>" class="border border-white text-white px-6 py-3 hover:bg-white/10 text-sm inline-flex items-center">Learn more</a>
        </div>
    </div>
</div>
<script>
(function () {
    var KEY = 'tc_cookie_consent';
    window.tcCookieConsent = function () { try { return localStorage.getItem(KEY); } catch (e) { return null; } };
    function ready(fn) {
        if (document.readyState !== 'loading') fn();
        else document.addEventListener('DOMContentLoaded', fn);
    }
    ready(function () {
        var banner = document.getElementById('tc-cookie-banner');
        if (!banner) return;
        var stored = null;
        try { stored = localStorage.getItem(KEY); } catch (e) {}
        if (stored === null) banner.classList.remove('hidden');
        var btn = document.getElementById('tc-cookie-accept');
        if (btn) {
            btn.addEventListener('click', function () {
                try { localStorage.setItem(KEY, 'accepted'); } catch (e) {}
                banner.classList.add('hidden');
                try { document.dispatchEvent(new CustomEvent('tc:consent-given', { detail: { value: 'accepted' } })); } catch (e) {}
            });
        }
    });
})();
</script>