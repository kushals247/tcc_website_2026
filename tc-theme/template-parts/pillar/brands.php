<?php
if (!defined('ABSPATH')) exit;
$eyebrow = get_field('pillar_brands_eyebrow') ?: 'OUR PARTNERS';
$heading = get_field('pillar_brands_heading');
$ecosystem = get_field('pillar_ecosystem_slug');

if (!$ecosystem) return;

// Query brand CPT for brands tagged with this ecosystem (via brand_ecosystems checkbox field)
$brand_query = new WP_Query([
    'post_type' => 'brand',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'meta_query' => [
        [
            'key' => 'brand_ecosystems',
            'value' => '"' . $ecosystem . '"',
            'compare' => 'LIKE',
        ],
    ],
    'meta_key' => 'brand_featured_order',
    'orderby' => ['meta_value_num' => 'ASC', 'title' => 'ASC'],
    'no_found_rows' => true,
]);
$brands = [];
if ($brand_query->have_posts()) {
    while ($brand_query->have_posts()) {
        $brand_query->the_post();
        $bid = get_the_ID();
        $brands[] = [
            'name' => get_the_title(),
            'logo' => get_field('brand_logo', $bid),
            'url' => get_permalink($bid),
            'ecosystems' => get_field('brand_ecosystems', $bid),
        ];
    }
    wp_reset_postdata();
}
if (empty($brands)) return;
?>
<section class="tc-pillar-brands bg-white py-20 md:py-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12">
            <?php if ($eyebrow): ?><p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p><?php endif; ?>
            <?php if ($heading): ?><h3 class="text-2xl md:text-3xl font-medium text-[#3A3D40]"><?php echo esc_html($heading); ?></h3><?php endif; ?>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 items-center justify-items-center">
            <?php foreach ($brands as $brand):
                $logo = $brand['logo'];
                $logo_url = is_array($logo) ? $logo['url'] : (is_string($logo) ? $logo : '');
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