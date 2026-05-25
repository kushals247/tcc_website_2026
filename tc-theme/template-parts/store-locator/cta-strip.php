<?php
if (!defined('ABSPATH')) exit;

$eyebrow = get_field('locator_cta_eyebrow');
$heading = get_field('locator_cta_heading');
$body = get_field('locator_cta_body');

$wa_raw = get_field('nav_whatsapp_number', 'options');
$wa_digits = $wa_raw ? preg_replace('/\D+/', '', $wa_raw) : '';
?>
<section class="tc-locator-cta bg-[#3A3D40] py-20 text-white">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <?php if ($eyebrow): ?>
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($heading): ?>
            <h2 class="text-3xl md:text-4xl font-medium text-white mb-4"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($body): ?>
            <p class="text-base md:text-lg text-white/80 mb-10 leading-relaxed"><?php echo esc_html($body); ?></p>
        <?php endif; ?>
        <div class="flex flex-col md:flex-row gap-4 justify-center">
            <?php if ($wa_digits): ?>
                <a href="https://wa.me/<?php echo esc_attr($wa_digits); ?>" target="_blank" rel="noopener" class="bg-[#FFCD00] text-[#3A3D40] px-8 py-4 font-medium hover:bg-[#FFD52E] transition-colors inline-block">WhatsApp us</a>
            <?php endif; ?>
            <a href="<?php echo esc_url(home_url('/quote/')); ?>" class="<?php echo $wa_digits ? 'border border-white text-white px-8 py-4 hover:bg-white/10' : 'bg-[#FFCD00] text-[#3A3D40] px-8 py-4 font-medium hover:bg-[#FFD52E]'; ?> transition-colors inline-block">Request a quote</a>
        </div>
    </div>
</section>