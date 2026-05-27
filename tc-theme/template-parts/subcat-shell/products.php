<?php
if (!defined('ABSPATH')) exit;
$shortcode = get_field('subcat_products_shortcode');
$name = get_field('subcat_name') ?: get_the_title();

$wa_raw = get_field('nav_whatsapp_number', 'options');
$wa_digits = $wa_raw ? preg_replace('/\D+/', '', $wa_raw) : '';
?>
<section class="tc-subcat-products bg-[#F5F6F7] py-20 md:py-24">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-2xl md:text-3xl font-medium text-[#3A3D40] mb-8 text-center">Browse <?php echo esc_html($name); ?></h2>
        <?php if (!empty(trim((string) $shortcode))): ?>
            <div class="tc-subcat-products-wrapper">
                <?php echo do_shortcode($shortcode); ?>
            </div>
        <?php else: ?>
            <div class="max-w-2xl mx-auto bg-white border border-[#ECECEC] p-10 md:p-14 text-center">
                <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4">CATALOGUE</p>
                <h3 class="text-2xl md:text-3xl font-medium text-[#3A3D40] mb-4">Products coming online soon.</h3>
                <p class="text-base text-[#63666A] leading-relaxed mb-8">We&rsquo;re loading this category onto the website. In the meantime, our specification team can quote against drawings or BOQ within one business day.</p>
                <div class="flex flex-col md:flex-row gap-4 justify-center">
                    <a href="<?php echo esc_url(home_url('/quote/')); ?>" class="bg-[#FFCD00] text-[#3A3D40] px-8 py-4 font-medium hover:bg-[#FFD52E] transition-colors inline-block">Request a quote</a>
                    <?php if ($wa_digits): ?>
                        <a href="https://wa.me/<?php echo esc_attr($wa_digits); ?>" target="_blank" rel="noopener" class="border border-[#63666A] text-[#63666A] px-8 py-4 hover:bg-[#ECECEC] transition-colors inline-block">Speak via WhatsApp</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>