<?php
if (!defined('ABSPATH')) exit;

$hero_image    = get_field('quote_hero_image');
$hero_eyebrow  = get_field('quote_hero_eyebrow') ?: 'REQUEST A QUOTE';
$hero_headline = get_field('quote_hero_headline') ?: 'Tell us about your project.';
$hero_subline  = get_field('quote_hero_subline');

$image_url = is_array($hero_image) ? ($hero_image['url'] ?? '') : (is_string($hero_image) ? $hero_image : '');
?>
<section class="tc-quote-hero relative h-[40vh] md:h-[50vh] w-full overflow-hidden flex items-end"
         <?php if ($image_url): ?>style="background-image:url('<?php echo esc_url($image_url); ?>');background-size:cover;background-position:center;"<?php else: ?>style="background-color:#3A3D40;"<?php endif; ?>>
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent" aria-hidden="true"></div>
    <div class="relative z-10 max-w-5xl mx-auto px-6 pb-12 md:pb-16 w-full">
        <?php if ($hero_eyebrow): ?>
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-3"><?php echo esc_html($hero_eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($hero_headline): ?>
            <h1 class="text-4xl md:text-6xl font-medium text-white leading-tight"><?php echo esc_html($hero_headline); ?></h1>
        <?php endif; ?>
        <?php if ($hero_subline): ?>
            <p class="text-base md:text-lg text-white/85 mt-3 max-w-2xl"><?php echo esc_html($hero_subline); ?></p>
        <?php endif; ?>
    </div>
</section>
