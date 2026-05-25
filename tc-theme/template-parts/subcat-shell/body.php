<?php
if (!defined('ABSPATH')) exit;
$eyebrow = get_field('subcat_body_eyebrow') ?: 'COMING SOON';
$heading = get_field('subcat_body_heading');
$paragraphs = get_field('subcat_body_paragraphs');
$applications = get_field('subcat_applications');
$back_label = get_field('subcat_back_link_label');
$parent = get_field('subcat_parent_ecosystem');
$name = get_field('subcat_name') ?: get_the_title();

$ecosystem_names = [
    'structure-essentials' => 'Structure Essentials',
    'surfaces-finishes' => 'Surfaces & Finishes',
    'softs-decor' => 'Softs & Decor',
];
$parent_name = $ecosystem_names[$parent] ?? 'ecosystem';
$parent_url = $parent ? home_url('/' . $parent . '/') : home_url('/');
$quote_url = home_url('/quote/?subcat=' . urlencode($parent . '/' . sanitize_title($name)));

if (!$back_label) {
    $back_label = '&larr; Back to ' . esc_html($parent_name);
}
?>
<section class="tc-subcat-body bg-white py-20 md:py-32">
    <div class="max-w-3xl mx-auto px-6">
        <?php if ($eyebrow): ?><p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p><?php endif; ?>
        <?php if ($heading): ?><h2 class="text-3xl md:text-4xl font-medium text-[#3A3D40] mb-6"><?php echo esc_html($heading); ?></h2><?php endif; ?>
        <?php if ($paragraphs): ?>
            <div class="text-lg text-[#63666A] leading-relaxed mb-10 space-y-4"><?php echo wpautop(esc_html($paragraphs)); ?></div>
        <?php endif; ?>
        <?php if ($applications && !empty($applications)): ?>
            <h3 class="text-sm tracking-[0.15em] uppercase text-[#3A3D40] font-medium mb-4">Typical applications</h3>
            <ul class="list-none space-y-2 mb-10">
                <?php foreach ($applications as $app): if (empty($app['text'])) continue; ?>
                    <li class="text-base text-[#63666A] flex items-start"><span class="text-[#FFCD00] mr-3">&bull;</span><?php echo esc_html($app['text']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <div class="flex flex-col md:flex-row gap-4 mb-12">
            <a href="<?php echo esc_url($quote_url); ?>" class="bg-[#FFCD00] text-[#3A3D40] px-8 py-4 font-medium hover:bg-[#FFD52E] transition-colors text-base inline-block text-center">Request a quote</a>
            <a href="<?php echo esc_url(home_url('/store-locator/')); ?>" class="border border-[#63666A] text-[#63666A] px-8 py-4 hover:bg-[#F5F6F7] transition-colors text-base inline-block text-center">Visit a showroom</a>
        </div>
        <a href="<?php echo esc_url($parent_url); ?>" class="text-sm text-[#63666A] hover:text-[#FFCD00] transition-colors inline-block"><?php echo wp_kses_post($back_label); ?></a>
    </div>
</section>