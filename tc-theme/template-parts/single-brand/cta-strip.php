<?php
if (!defined('ABSPATH')) exit;

$brand_title = get_the_title();
$brand_slug = get_post_field('post_name', get_the_ID());
$available_at_tacc = get_field('brand_available_at_tacc');
$tacc_search_url = get_field('brand_tacc_search_url');

$quote_url = add_query_arg('brand', $brand_slug, home_url('/quote/'));

if ($available_at_tacc) {
    $secondary_url = $tacc_search_url ?: ('https://tacc.co.ke/?s=' . rawurlencode($brand_title));
    $secondary_label = 'Browse at TACC &rarr;';
    $secondary_target = ' target="_blank" rel="noopener"';
} else {
    $secondary_url = home_url('/store-locator/');
    $secondary_label = 'Visit a showroom';
    $secondary_target = '';
}
?>
<section class="tc-single-brand-cta bg-[#3A3D40] py-20 md:py-28 text-white">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4">INTERESTED IN <?php echo esc_html(strtoupper($brand_title)); ?>?</p>
        <h2 class="text-3xl md:text-4xl font-medium text-white mb-4">Let&rsquo;s specify it for your project.</h2>
        <p class="text-base md:text-lg text-white/80 mb-10 leading-relaxed">Our team carries the full range and can quote for residential, hospitality, or commercial spec.</p>
        <div class="flex flex-col md:flex-row gap-4 justify-center items-stretch md:items-center">
            <a href="<?php echo esc_url($quote_url); ?>" class="bg-[#FFCD00] text-[#3A3D40] px-8 py-4 font-medium hover:bg-[#FFD52E] transition-colors text-base inline-block">Request a quote</a>
            <a href="<?php echo esc_url($secondary_url); ?>"<?php echo $secondary_target; ?> class="border border-white text-white px-8 py-4 hover:bg-white/10 transition-colors text-base inline-block"><?php echo wp_kses_post($secondary_label); ?></a>
        </div>
    </div>
</section>