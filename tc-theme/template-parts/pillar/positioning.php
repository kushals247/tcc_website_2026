<?php
if (!defined('ABSPATH')) exit;
$eyebrow = get_field('pillar_positioning_eyebrow') ?: 'OUR APPROACH';
$heading = get_field('pillar_positioning_heading');
$body = get_field('pillar_positioning_body');
if (!$heading && !$body) return;
?>
<section id="tc-pillar-positioning" class="tc-pillar-positioning bg-white py-24 md:py-32">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <?php if ($eyebrow): ?>
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($heading): ?>
            <h2 class="text-3xl md:text-5xl font-medium text-[#3A3D40] mb-6 leading-tight"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($body): ?>
            <p class="text-lg text-[#63666A] leading-relaxed"><?php echo esc_html($body); ?></p>
        <?php endif; ?>
    </div>
</section>