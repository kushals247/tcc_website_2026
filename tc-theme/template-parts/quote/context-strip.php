<?php
/**
 * Quote Page - Context strip (smart prefill from URL params).
 * Hidden by default. JS reveals it if any prefill param matches a known map.
 * Also pre-fills hidden CF7 field `prefill_context` so the value reaches the enquiry email.
 */
if (!defined('ABSPATH')) exit;

$brand_posts = get_posts([
    'post_type'   => 'brand',
    'numberposts' => -1,
    'post_status' => 'publish',
]);
$brand_map = [];
foreach ($brand_posts as $b) {
    $brand_map[$b->post_name] = $b->post_title;
}

$subcat_pages = get_posts([
    'post_type'   => 'page',
    'numberposts' => -1,
    'post_status' => 'publish',
    'meta_query'  => [[
        'key'   => '_wp_page_template',
        'value' => 'page-subcat-shell.php',
    ]],
]);
$subcat_map = [];
foreach ($subcat_pages as $p) {
    $subcat_map[$p->post_name] = $p->post_title;
}
?>
<section id="tc-quote-context" class="tc-quote-context bg-[#F5F6F7] py-6 hidden">
    <div class="max-w-5xl mx-auto px-6 text-center text-sm text-[#63666A]">
        <span>Quote request for:</span>
        <span id="tc-quote-context-chips" class="inline-flex flex-wrap gap-2 ml-2 justify-center"></span>
    </div>
</section>
<script>
(function() {
    var ECO = {
        'structure-essentials': 'Structure Essentials',
        'surfaces-finishes':    'Surfaces & Finishes',
        'softs-decor':          'Softs & Decor'
    };
    var BRANDS  = <?php echo wp_json_encode($brand_map); ?>;
    var SUBCATS = <?php echo wp_json_encode($subcat_map); ?>;
    var p = new URLSearchParams(window.location.search);
    var chips = [];
    var ctxParts = [];

    function addChip(label, value) {
        chips.push('<span class="inline-block px-3 py-1 bg-white border border-[#ECECEC] text-[#3A3D40] text-sm">' + label + ': <strong class="font-medium">' + value + '</strong></span>');
    }

    if (p.has('brand') && BRANDS[p.get('brand')]) {
        addChip('Brand', BRANDS[p.get('brand')]);
        ctxParts.push('brand=' + p.get('brand'));
    }
    if (p.has('ecosystem') && ECO[p.get('ecosystem')]) {
        addChip('Ecosystem', ECO[p.get('ecosystem')]);
        ctxParts.push('ecosystem=' + p.get('ecosystem'));
        document.addEventListener('DOMContentLoaded', function() {
            var slug  = p.get('ecosystem');
            var label = ECO[slug];
            if (label) {
                document.querySelectorAll('.wpcf7-checkbox input[type=checkbox]').forEach(function(cb) {
                    if (cb.value === label) cb.checked = true;
                });
            }
        });
    }
    if (p.has('subcat') && SUBCATS[p.get('subcat')]) {
        addChip('Sub-category', SUBCATS[p.get('subcat')]);
        ctxParts.push('subcat=' + p.get('subcat'));
        document.addEventListener('DOMContentLoaded', function() {
            var ta = document.querySelector('[name="your-categories"]');
            if (ta && !ta.value) ta.value = "I'm interested in " + SUBCATS[p.get('subcat')] + ".";
        });
    }
    if (p.has('article')) {
        addChip('From article', p.get('article'));
        ctxParts.push('article=' + p.get('article'));
        document.addEventListener('DOMContentLoaded', function() {
            var msg = document.querySelector('[name="your-message"]');
            if (msg && !msg.value) msg.value = 'I read your article and wanted to discuss further.';
        });
    }
    if (chips.length) {
        var box = document.getElementById('tc-quote-context-chips');
        if (box) box.innerHTML = chips.join('');
        var sec = document.getElementById('tc-quote-context');
        if (sec) sec.classList.remove('hidden');
        document.addEventListener('DOMContentLoaded', function() {
            var hidden = document.querySelector('[name="prefill_context"]');
            if (hidden) hidden.value = ctxParts.join('&');
        });
    }
})();
</script>