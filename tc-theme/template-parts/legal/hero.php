<?php
if (!defined('ABSPATH')) exit;
$eyebrow = get_field('legal_eyebrow') ?: 'LEGAL';
$subline = get_field('legal_subline');
$last_updated = get_field('legal_last_updated') ?: '2026-05-25';
?>
<section class="tc-legal-hero bg-[#F5F6F7] py-12 md:py-16">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <div class="text-[#FFCD00] uppercase tracking-widest text-sm font-medium mb-4"><?php echo esc_html($eyebrow); ?></div>
        <h1 class="text-4xl md:text-5xl font-medium text-[#3A3D40] mb-3"><?php the_title(); ?></h1>
        <?php if ($subline): ?>
            <p class="italic text-[#63666A] text-lg mb-4"><?php echo esc_html($subline); ?></p>
        <?php endif; ?>
        <p class="text-sm text-[#63666A]">Last updated: <?php echo esc_html($last_updated); ?></p>
    </div>
</section>