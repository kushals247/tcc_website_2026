<?php
if (!defined('ABSPATH')) exit;
$eyebrow = get_field('subcat_intro_eyebrow') ?: 'EXPLORE THE CATEGORY';
$heading = get_field('subcat_intro_heading');
$body = get_field('subcat_intro_body');

if (!$heading && !$body) return;
?>
<section class="tc-subcat-intro bg-white py-24 md:py-32">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <?php if ($eyebrow): ?>
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($heading): ?>
            <h2 class="text-3xl md:text-5xl font-medium text-[#3A3D40] mb-6 leading-tight"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($body): ?>
            <div class="text-lg text-[#63666A] leading-relaxed"><?php echo wpautop(esc_html($body)); ?></div>
        <?php endif; ?>
    </div>
</section>