<?php
if (!defined('ABSPATH')) exit;

$image = get_field('about_hero_image');
$eyebrow = get_field('about_hero_eyebrow') ?: 'OUR STORY';
$headline = get_field('about_hero_headline') ?: get_the_title();
$subline = get_field('about_hero_subline');

if (!$image && !$headline) return;

$image_url = is_array($image) ? ($image['url'] ?? '') : (is_string($image) ? $image : '');
?>
<section class="tc-about-hero relative h-[40vh] md:h-[50vh] w-full overflow-hidden flex items-end"
         <?php if ($image_url): ?>style="background-image:url('<?php echo esc_url($image_url); ?>');background-size:cover;background-position:center;"<?php endif; ?>>
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent" aria-hidden="true"></div>
    <div class="relative z-10 max-w-5xl mx-auto px-6 pb-12 md:pb-16 w-full">
        <?php if ($eyebrow): ?>
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-3"><?php echo esc_html($eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($headline): ?>
            <h1 class="text-4xl md:text-6xl font-medium text-white leading-tight"><?php echo esc_html($headline); ?></h1>
        <?php endif; ?>
        <?php if ($subline): ?>
            <p class="text-base md:text-lg text-white/85 mt-3 max-w-2xl"><?php echo esc_html($subline); ?></p>
        <?php endif; ?>
    </div>
</section>
