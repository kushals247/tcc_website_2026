<?php
if (!defined('ABSPATH')) exit;

$eyebrow = get_field('about_manuf_eyebrow');
$heading = get_field('about_manuf_heading');
$intro = get_field('about_manuf_intro');
$brands = get_field('about_manuf_brands');

if (!$brands) return;
?>
<section class="tc-about-manuf bg-white py-20 md:py-24">
    <div class="text-center max-w-3xl mx-auto px-6">
        <img src="<?php echo esc_url(tc_original_asset('logo', 'white')); ?>" alt="T&amp;C Original Products" class="mx-auto mb-6 h-20 md:h-24 w-auto" loading="lazy">
        <?php if ($eyebrow): ?>
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($heading): ?>
            <h2 class="text-3xl md:text-4xl font-medium text-[#3A3D40] mb-4"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($intro): ?>
            <p class="text-base text-[#63666A] leading-relaxed"><?php echo esc_html($intro); ?></p>
        <?php endif; ?>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3.5 max-w-6xl mx-auto px-6 mt-12">
        <?php foreach ($brands as $brand):
            $logo = $brand['logo_image'] ?? null;
            $logo_url = is_array($logo) ? ($logo['url'] ?? '') : (is_string($logo) ? $logo : '');
            $logo_alt = is_array($logo) && !empty($logo['alt']) ? $logo['alt'] : ($brand['name'] ?? '');
            $name = $brand['name'] ?? '';
            $desc = $brand['description'] ?? '';
        ?>
            <div class="border border-[#ECECEC] p-6 hover:border-[#FFCD00] transition-all duration-300" data-reveal="card">
                <?php if ($logo_url): ?>
                    <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($logo_alt); ?>" class="max-h-12 mb-4" loading="lazy">
                <?php endif; ?>
                <?php if ($name): ?><h3 class="text-xl font-medium text-[#3A3D40] mb-2"><?php echo esc_html($name); ?></h3><?php endif; ?>
                <?php if ($desc): ?><p class="text-sm text-[#63666A] leading-relaxed"><?php echo esc_html($desc); ?></p><?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>