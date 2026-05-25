<?php
if (!defined('ABSPATH')) exit;

$image = get_field('pillar_hero_image');
$name = get_field('pillar_hero_name') ?: get_the_title();
$pov = get_field('pillar_hero_pov');

if (!$image && !$name) return;

$image_url = is_array($image) ? $image['url'] : (is_string($image) ? $image : '');
?>
<section class="tc-pillar-hero relative h-[70vh] md:h-[80vh] w-full overflow-hidden flex items-end pb-20 md:pb-24"
         <?php if ($image_url): ?>style="background-image:url('<?php echo esc_url($image_url); ?>');background-size:cover;background-position:center;"<?php endif; ?>>
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent" aria-hidden="true"></div>
    <div class="relative z-10 max-w-5xl mx-auto px-6 text-white w-full">
        <?php if ($name): ?>
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-medium tracking-tight leading-tight"><?php echo esc_html($name); ?></h1>
        <?php endif; ?>
        <?php if ($pov): ?>
            <p class="text-lg md:text-xl mt-4 md:mt-6 font-light italic text-white/85 max-w-2xl"><?php echo esc_html($pov); ?></p>
        <?php endif; ?>
    </div>
    <a href="#tc-pillar-positioning" class="absolute bottom-8 left-1/2 -translate-x-1/2 text-white/70 hover:text-[#FFCD00] transition-colors z-10" aria-label="Scroll down">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
    </a>
</section>