<?php
if (!defined('ABSPATH')) exit;
$eyebrow = get_field('pillar_cta_eyebrow') ?: 'NEXT STEP';
$heading = get_field('pillar_cta_heading') ?: 'Ready to start your project?';
$body = get_field('pillar_cta_body');
$ecosystem = get_field('pillar_ecosystem_slug');
$quote_url = home_url('/quote/' . ($ecosystem ? '?ecosystem=' . urlencode($ecosystem) : ''));
?>
<section class="tc-pillar-cta-strip bg-[#3A3D40] py-20 md:py-28 text-white">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <?php if ($eyebrow): ?><p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p><?php endif; ?>
        <?php if ($heading): ?><h2 class="text-3xl md:text-4xl font-medium mb-4"><?php echo esc_html($heading); ?></h2><?php endif; ?>
        <?php if ($body): ?><p class="text-base md:text-lg text-white/80 mb-10 max-w-xl mx-auto leading-relaxed"><?php echo esc_html($body); ?></p><?php endif; ?>
        <div class="flex flex-col md:flex-row gap-4 justify-center items-stretch md:items-center">
            <a href="<?php echo esc_url($quote_url); ?>" class="bg-[#FFCD00] text-[#3A3D40] px-8 py-4 font-medium hover:bg-[#FFD52E] transition-colors text-base inline-block">Speak to our team</a>
            <a href="<?php echo esc_url(home_url('/store-locator/')); ?>" class="border border-white text-white px-8 py-4 hover:bg-white/10 transition-colors text-base inline-block">Visit a showroom</a>
        </div>
    </div>
</section>