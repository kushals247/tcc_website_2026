<?php
/**
 * Consent-gated GA4 + event tracking.
 * Loads ONLY after user accepts the cookie banner.
 * Wires up: quote_cta_click, mega_menu_open, form_submit, scroll_depth, outbound_click, article_read.
 */
if (!defined('ABSPATH')) exit;
if (is_admin()) return;

if (!function_exists('get_field')) return;
$enabled = get_field('ts_analytics_enabled', 'tc-theme-settings');
$ga_id   = trim((string) get_field('ts_analytics_ga4_id', 'tc-theme-settings'));
if (!$enabled || empty($ga_id)) return;
?>
<script id="tc-analytics-loader">
(function () {
    var GA_ID = <?php echo wp_json_encode($ga_id); ?>;
    var loaded = false;

    function loadGA() {
        if (loaded) return;
        loaded = true;
        var s = document.createElement('script');
        s.async = true;
        s.src = 'https://www.googletagmanager.com/gtag/js?id=' + encodeURIComponent(GA_ID);
        document.head.appendChild(s);
        window.dataLayer = window.dataLayer || [];
        function gtag() { window.dataLayer.push(arguments); }
        window.gtag = gtag;
        gtag('js', new Date());
        gtag('config', GA_ID, { 'anonymize_ip': true, 'send_page_view': true });
        wireEventListeners();
    }

    function track(name, params) {
        if (window.gtag) window.gtag('event', name, params || {});
    }

    function wireEventListeners() {
        // Quote CTA clicks — auto-detect any link to /quote/
        document.querySelectorAll('a[href*="/quote/"]').forEach(function (el) {
            el.addEventListener('click', function () {
                var source = el.getAttribute('data-tc-source')
                    || el.closest('section')?.className?.match(/tc-[a-z-]+/)?.[0]
                    || 'unknown';
                var label = (el.textContent || '').trim().substring(0, 40);
                track('quote_cta_click', { source: source, label: label });
            });
        });

        // Mega menu open
        document.querySelectorAll('[data-tc-event="mega-menu-open"], [aria-controls="tc-megamenu-panel"]').forEach(function (el) {
            el.addEventListener('click', function () {
                track('mega_menu_open', { ecosystem: el.getAttribute('data-ecosystem') || el.textContent.trim() });
            });
        });

        // Outbound clicks (TACC + WhatsApp + brand sites)
        document.addEventListener('click', function (e) {
            var a = e.target.closest('a');
            if (!a) return;
            var href = a.getAttribute('href') || '';
            if (/wa\.me\//.test(href)) track('outbound_whatsapp', {});
            else if (/tacc\.co\.ke/.test(href)) track('outbound_tacc', {});
            else if (a.target === '_blank' && /^https?:\/\//.test(href) && href.indexOf(window.location.host) === -1) {
                track('outbound_click', { domain: (function () { try { return new URL(href).hostname; } catch (e) { return 'unknown'; } })() });
            }
        }, { passive: true });

        // CF7 form submission events
        document.addEventListener('wpcf7mailsent', function (e) {
            track('form_submit', { form_id: e.detail && e.detail.contactFormId, status: 'sent' });
        });
        document.addEventListener('wpcf7invalid', function (e) {
            track('form_invalid', { form_id: e.detail && e.detail.contactFormId });
        });

        // Scroll depth (25/50/75/100)
        var depths = [25, 50, 75, 100];
        var hit = {};
        function checkScrollDepth() {
            var h = document.documentElement;
            var pct = Math.floor(((h.scrollTop || document.body.scrollTop) + window.innerHeight) / h.scrollHeight * 100);
            depths.forEach(function (d) {
                if (pct >= d && !hit[d]) { hit[d] = true; track('scroll_depth', { depth: d }); }
            });
        }
        window.addEventListener('scroll', checkScrollDepth, { passive: true });
        checkScrollDepth();

        // Article read (30s dwell on single posts)
        if (document.body.classList.contains('single-post') || document.querySelector('.tc-single-article')) {
            setTimeout(function () { track('article_read', {}); }, 30000);
        }
    }

    function checkConsent() {
        try {
            return localStorage.getItem('tc_cookie_consent') === 'accepted';
        } catch (e) { return false; }
    }

    if (checkConsent()) {
        loadGA();
    } else {
        document.addEventListener('tc:consent-given', loadGA, { once: true });
        // Also listen for direct localStorage event in case banner script doesn't dispatch
        document.addEventListener('click', function (e) {
            if (e.target && (e.target.id === 'tc-cookie-accept' || e.target.closest('#tc-cookie-accept'))) {
                setTimeout(function () { if (checkConsent()) loadGA(); }, 50);
            }
        });
    }
})();
</script>