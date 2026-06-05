<?php
/**
 * Brand Partners auto-scrolling logo strip.
 * CSS keyframe marquee, doubled list for seamless loop. Pause on hover.
 */
if (!defined('ABSPATH')) exit;

$view_all_url = function_exists('get_field') ? (get_field('brand_strip_view_all_url') ?: home_url('/brands/')) : home_url('/brands/');
// Query brand CPT for featured-on-homepage brands, ordered by featured_order then alphabetical
$featured_query = new WP_Query([
    'post_type' => 'brand',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'meta_query' => [
        [
            'key' => 'brand_featured_on_homepage',
            'value' => '1',
            'compare' => '=',
        ],
    ],
    'meta_key' => 'brand_featured_order',
    'orderby' => ['meta_value_num' => 'ASC', 'title' => 'ASC'],
    'no_found_rows' => true,
]);
$logos = [];
if ($featured_query->have_posts()) {
    while ($featured_query->have_posts()) {
        $featured_query->the_post();
        $bid = get_the_ID();
        $logo_url = get_field('brand_logo', $bid);
        // Use brand's CPT permalink (the /our-brands/{slug}/ page)
        $logos[] = [
            'name' => get_the_title(),
            'logo' => is_string($logo_url) && $logo_url ? ['url' => $logo_url] : null,
            'url' => get_permalink($bid),
            'keep_color' => false,
        ];
    }
    wp_reset_postdata();
}
// Fallback: legacy ACF repeater (kept for backwards compatibility; safe to remove later)
if (empty($logos)) {
    $legacy = function_exists('get_field') ? (get_field('brand_strip_logos') ?: []) : [];
    if (!empty($legacy)) {
        foreach ($legacy as $row) {
            $url = is_array($row['url'] ?? null) ? ($row['url']['url'] ?? '#') : ($row['url'] ?? '#');
            $logos[] = ['name' => $row['name'] ?? '', 'logo' => is_array($row['logo'] ?? null) && !empty($row['logo']['url']) ? $row['logo'] : (is_string($row['logo'] ?? null) && $row['logo'] ? ['url' => $row['logo']] : null), 'url' => $url, 'keep_color' => false];
        }
    }
}
if (empty($logos)) return;
$doubled = array_merge($logos, $logos);
?>
<section class="tc-bp" style="background: #F5F6F7; padding: 48px 0 64px; font-family: 'Montserrat', system-ui, sans-serif;">
    <div style="max-width: 1440px; margin: 0 auto; padding: 0 32px 24px; display: flex; align-items: baseline; justify-content: space-between;">
        <div style="font-size: 10px; letter-spacing: 0.15em; color: #63666A; opacity: 0.6; text-transform: uppercase;">Trusted by</div>
        <a href="<?php echo esc_url($view_all_url); ?>" style="font-size: 12px; color: #63666A; font-weight: 500; border-bottom: 2px solid #FFCD00; padding-bottom: 2px; text-decoration: none;">View all brands →</a>
    </div>
    <div class="tc-bp__marquee" data-tc-bp-marquee style="overflow: hidden; position: relative; width: 100%;">
        <div class="tc-bp__track" data-tc-bp-track style="display: flex; align-items: center; gap: 80px; padding: 0 40px; animation: tc-bp-scroll 40s linear infinite; width: max-content;">
            <?php foreach ($doubled as $brand) :
                $name = $brand['name'] ?? '';
                $url = $brand['url'] ?? '#';
                $logo = (is_array($brand['logo'] ?? null) && !empty($brand['logo']['url'])) ? $brand['logo']['url'] : '';
                $keep_color = !empty($brand['keep_color']);
            ?>
            <a href="<?php echo esc_url($url); ?>" class="tc-bp__logo" aria-label="<?php echo esc_attr($name); ?>"
               style="display: inline-flex; align-items: center; height: 40px; flex-shrink: 0; text-decoration: none; <?php echo $keep_color ? '' : 'filter: grayscale(100%); opacity: 0.6;'; ?> transition: filter 200ms ease, opacity 200ms ease, transform 200ms ease;">
                <?php if ($logo) : ?>
                    <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr($name); ?>" style="max-height: 40px; width: auto;">
                <?php else : ?>
                    <span style="font-size: 18px; color: #63666A; font-weight: 500; letter-spacing: 0.02em;"><?php echo esc_html($name); ?></span>
                <?php endif; ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
@keyframes tc-bp-scroll {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
}
.tc-bp__marquee:hover .tc-bp__track { animation-play-state: paused; }
.tc-bp__logo:hover { filter: grayscale(0%) !important; opacity: 1 !important; transform: scale(1.08); }
.tc-bp__logo:focus-visible { outline: 2px solid #FFCD00; outline-offset: 2px; }
@media (prefers-reduced-motion: reduce) {
    .tc-bp__track { animation: none !important; }
    .tc-bp__logo { filter: grayscale(0%) !important; opacity: 1 !important; }
}
</style>