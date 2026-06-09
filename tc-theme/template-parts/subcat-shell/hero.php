<?php
if (!defined('ABSPATH')) exit;

$image = get_field('subcat_hero_image');
$eyebrow = get_field('subcat_hero_eyebrow') ?: 'EXPLORE THE CATEGORY';
$name = get_field('subcat_name') ?: get_the_title();
$subline = get_field('subcat_hero_subline');

// Build breadcrumb from IA structure context (eco / L1 / L2)
$breadcrumb_html = '';
if (function_exists('tc_get_ia_context_for_page')) {
    $ctx = tc_get_ia_context_for_page();
    if ($ctx) {
        $eco = tc_get_ia_ecosystem($ctx['eco_slug']);
        if ($eco) {
            $parts = [];
            $parts[] = '<a href="' . esc_url(home_url('/' . $ctx['eco_slug'] . '/')) . '" class="hover:text-[#FFCD00] transition-colors">' . esc_html($eco['name']) . '</a>';
            if (!empty($ctx['l1_slug'])) {
                $l1 = tc_get_ia_l1($ctx['eco_slug'], $ctx['l1_slug']);
                if (!empty($ctx['l2_slug'])) {
                    $parts[] = '<a href="' . esc_url(home_url('/' . $ctx['eco_slug'] . '/' . $ctx['l1_slug'] . '/')) . '" class="hover:text-[#FFCD00] transition-colors">' . esc_html($l1['name']) . '</a>';
                } else {
                    $parts[] = '<span>' . esc_html($l1['name']) . '</span>';
                }
            }
            $breadcrumb_html = implode(' <span class="mx-2">/</span> ', $parts);
        }
    }
}
// Fall back to legacy subcat_parent_ecosystem field if IA context didn't resolve
if (!$breadcrumb_html) {
    $parent = get_field('subcat_parent_ecosystem');
    $ecosystem_names = [
        'structure-essentials' => 'Structure Essentials',
        'surfaces-finishes' => 'Surfaces & Finishes',
        'softs-decor' => 'Softs & Decor',
    ];
    $parent_name = $ecosystem_names[$parent] ?? '';
    if ($parent_name) {
        $breadcrumb_html = '<a href="' . esc_url(home_url('/' . $parent . '/')) . '" class="hover:text-[#FFCD00] transition-colors">' . esc_html($parent_name) . '</a>';
    }
}

$image_url = is_array($image) ? ($image['url'] ?? '') : (is_string($image) ? $image : '');
if (!$image_url) {
    $image_url = function_exists('get_field') ? (get_field('default_header_image', 'option') ?: '') : '';
}
?>
<section class="tc-subcat-hero relative h-[40vh] md:h-[50vh] w-full overflow-hidden flex items-end"
         <?php if ($image_url): ?>style="background-image:url('<?php echo esc_url($image_url); ?>');background-size:cover;background-position:center;"<?php else: ?>style="background-color:#63666A;"<?php endif; ?>>
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent" aria-hidden="true"></div>
    <?php if ($breadcrumb_html): ?>
        <div class="absolute top-6 md:top-8 left-6 md:left-10 z-10 text-white/85 text-sm tracking-wide">
            <?php echo $breadcrumb_html; ?>
        </div>
    <?php endif; ?>
    <div class="relative z-10 max-w-5xl mx-auto px-6 pb-12 md:pb-16 w-full">
        <?php if ($eyebrow): ?>
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-3"><?php echo esc_html($eyebrow); ?></p>
        <?php endif; ?>
        <h1 class="text-4xl md:text-6xl font-medium text-white leading-tight"><?php echo esc_html($name); ?></h1>
        <?php if ($subline): ?>
            <p class="text-base md:text-lg text-white/85 mt-3 max-w-2xl"><?php echo esc_html($subline); ?></p>
        <?php endif; ?>
    </div>
</section>
