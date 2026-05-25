<?php
/**
 * Featured Products / Collections template part.
 * 3-tile grid, card style matching ecosystem cards. ACF-curated.
 */
if (!defined('ABSPATH')) exit;

$eyebrow = function_exists('get_field') ? (get_field('featured_eyebrow') ?: 'Featured') : 'Featured';
$heading = function_exists('get_field') ? (get_field('featured_heading') ?: 'Solutions for every project.') : 'Solutions for every project.';
$intro = function_exists('get_field') ? get_field('featured_intro') : '';
$items = function_exists('get_field') ? (get_field('featured_items') ?: []) : [];

if (empty($items)) {
    $items = [
        ['image' => null, 'name' => 'Bathroom Renovation', 'description' => 'Transform your bathroom with premium tiles and fittings.', 'link_url' => '#', 'link_label' => 'Learn more'],
        ['image' => null, 'name' => 'Kitchen Solutions', 'description' => 'Complete kitchen design from cabinets to countertops.', 'link_url' => '#', 'link_label' => 'Learn more'],
        ['image' => null, 'name' => 'Outdoor Living', 'description' => 'Furniture, rugs and decor for your outdoor spaces.', 'link_url' => '#', 'link_label' => 'Learn more'],
    ];
}
?>
<section id="featured" class="tc-featured" style="padding: 96px 24px; background: #FFFFFF; color: #63666A; font-family: 'Montserrat', system-ui, sans-serif;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div class="tc-featured__header" style="text-align: center; max-width: 640px; margin: 0 auto 56px;" data-tc-featured-header>
            <div style="display: inline-block; background: #FFCD00; color: #63666A; padding: 7px 14px; font-size: 11px; letter-spacing: 0.18em; font-weight: 500; text-transform: uppercase; margin-bottom: 20px;"><?php echo esc_html($eyebrow); ?></div>
            <h2 style="font-size: clamp(28px, 4vw, 40px); font-weight: 500; line-height: 1.1; margin: 0 0 16px; color: #63666A;"><?php echo esc_html($heading); ?></h2>
            <?php if ($intro) : ?><p style="font-size: 16px; line-height: 1.6; margin: 0; color: #63666A; opacity: 0.75;"><?php echo esc_html($intro); ?></p><?php endif; ?>
        </div>
        <div class="tc-featured__grid" style="display: grid; grid-template-columns: 1fr; gap: 14px;" data-tc-featured-grid>
            <?php foreach ($items as $i => $item) :
                $name = $item['name'] ?? '';
                $desc = $item['description'] ?? '';
                $url = is_array($item['link_url'] ?? null) ? ($item['link_url']['url'] ?? '#') : ($item['link_url'] ?? '#');
                $label = $item['link_label'] ?: 'Learn more';
                $img = (is_array($item['image'] ?? null) && !empty($item['image']['url'])) ? $item['image']['url'] : '';
            ?>
            <a href="<?php echo esc_url($url); ?>" class="tc-featured__card" data-tc-featured-card aria-label="<?php echo esc_attr($name . ' - ' . $desc); ?>"
               style="display: flex; flex-direction: column; background: #FFFFFF; border: 1px solid #ECECEC; text-decoration: none; color: #63666A; overflow: hidden; transition: border-color 200ms ease, transform 200ms ease, box-shadow 200ms ease;">
                <div class="tc-featured__img" style="width: 100%; aspect-ratio: 4/3; background-color: #F5F6F7; <?php echo $img ? 'background-image: url(' . esc_url($img) . ');' : ''; ?> background-size: cover; background-position: center; transition: transform 300ms ease;"></div>
                <div style="padding: 22px;">
                    <div style="font-size: 18px; font-weight: 500; color: #63666A; margin-bottom: 8px;"><?php echo esc_html($name); ?></div>
                    <p style="font-size: 12px; line-height: 1.5; color: #63666A; opacity: 0.75; margin: 0 0 14px;"><?php echo esc_html($desc); ?></p>
                    <span style="font-size: 13px; font-weight: 500; color: #63666A; border-bottom: 2px solid #FFCD00; padding-bottom: 2px; display: inline-flex; align-items: center; gap: 4px;"><?php echo esc_html($label); ?> <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<style>
@media (min-width: 600px) { .tc-featured__grid { grid-template-columns: 1fr 1fr !important; } }
@media (min-width: 900px) { .tc-featured__grid { grid-template-columns: 1fr 1fr 1fr !important; } }
@media (hover: hover) { .tc-featured__card:hover { border-color: #FFCD00 !important; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.08); } .tc-featured__card:hover .tc-featured__img { transform: scale(1.03); } }
.tc-featured__card:focus-visible { outline: 2px solid #FFCD00; outline-offset: 2px; }
@media (prefers-reduced-motion: reduce) { .tc-featured__card, .tc-featured__img { transition: none !important; } }
</style>