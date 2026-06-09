<?php
if (!defined('ABSPATH')) exit;

$image = get_field('legal_hero_image');
$eyebrow = get_field('legal_eyebrow') ?: 'LEGAL';
$subline = get_field('legal_subline');
$last_updated = get_field('legal_last_updated') ?: '';

$image_url = is_array($image) ? ($image['url'] ?? '') : (is_string($image) ? $image : '');
if (!$image_url) {
    $image_url = function_exists('get_field') ? (get_field('default_header_image', 'option') ?: '') : '';
}
?>
<section class="tc-legal-hero relative h-[40vh] md:h-[50vh] w-full overflow-hidden flex items-end"
         <?php if ($image_url): ?>style="background-image:url('<?php echo esc_url($image_url); ?>');background-size:cover;background-position:center;"<?php else: ?>style="background-color:#63666A;"<?php endif; ?>>
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent" aria-hidden="true"></div>
    <div class="relative z-10 max-w-5xl mx-auto px-6 pb-12 md:pb-16 w-full">
        <?php if ($eyebrow): ?>
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-3"><?php echo esc_html($eyebrow); ?></p>
        <?php endif; ?>
        <h1 class="text-4xl md:text-6xl font-medium text-white leading-tight"><?php the_title(); ?></h1>
        <?php if ($subline): ?>
            <p class="text-base md:text-lg text-white/85 mt-3 max-w-2xl"><?php echo esc_html($subline); ?></p>
        <?php endif; ?>
        <?php if ($last_updated): ?>
            <p class="text-sm text-white/70 mt-3">Last updated: <?php echo esc_html($last_updated); ?></p>
        <?php endif; ?>
    </div>
</section>
