<?php
if (!defined('ABSPATH')) exit;
$eyebrow = get_field('subcat_brands_eyebrow') ?: 'OUR PARTNERS';
$heading = get_field('subcat_brands_heading') ?: 'Brands we carry for this category';
$ecosystem = get_field('subcat_parent_ecosystem');

$home_id = get_option('page_on_front');
$all_brands = $home_id ? get_field('brand_strip_logos', $home_id) : null;
if (!$all_brands || !$ecosystem) return;

$brands = array_filter($all_brands, function($b) use ($ecosystem) {
    $ecos = $b['ecosystems'] ?? [];
    return is_array($ecos) && in_array($ecosystem, $ecos, true);
});

if (empty($brands)) return;
?>
<section class="tc-subcat-brands bg-white py-20 md:py-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12">
            <?php if ($eyebrow): ?>
                <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p>
            <?php endif; ?>
            <?php if ($heading): ?>
                <h3 class="text-2xl md:text-3xl font-medium text-[#3A3D40]"><?php echo esc_html($heading); ?></h3>
            <?php endif; ?>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 items-center justify-items-center">
            <?php foreach ($brands as $brand):
                $logo = $brand['logo'] ?? null;
                $logo_url = is_array($logo) ? ($logo['url'] ?? '') : (is_string($logo) ? $logo : '');
                $name = $brand['name'] ?? '';
                $url = $brand['url'] ?? '';
                if (!$logo_url) continue;
                $img = '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr($name) . '" class="max-h-12 w-auto grayscale hover:grayscale-0 opacity-70 hover:opacity-100 transition-all duration-300" loading="lazy">';
            ?>
                <?php if ($url): ?>
                    <a href="<?php echo esc_url($url); ?>" rel="noopener" target="_blank" aria-label="<?php echo esc_attr($name); ?>"><?php echo $img; ?></a>
                <?php else: ?>
                    <?php echo $img; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>