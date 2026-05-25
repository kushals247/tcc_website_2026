<?php
/**
 * Shop by Room template part.
 * 6-room cross-ecosystem section. Pulls from ACF on home page; defaults to 6 placeholder names.
 */
if (!defined('ABSPATH')) exit;

$eyebrow = function_exists('get_field') ? (get_field('shop_by_room_eyebrow') ?: 'Shop by room') : 'Shop by room';
$heading = function_exists('get_field') ? (get_field('shop_by_room_heading') ?: 'Find what you need by space.') : 'Find what you need by space.';
$intro = function_exists('get_field') ? get_field('shop_by_room_intro') : '';
$tiles = function_exists('get_field') ? (get_field('room_tiles') ?: []) : [];

if (empty($tiles)) {
    $defaults = ['Bathroom', 'Kitchen', 'Living Room', 'Bedroom', 'Office', 'Outdoor'];
    foreach ($defaults as $name) {
        $tiles[] = ['name' => $name, 'image' => null, 'url' => '#', 'description' => ''];
    }
}
?>
<section id="shop-by-room" class="tc-sbr" style="padding: 96px 24px; background: #FFFFFF; color: #63666A; font-family: 'Montserrat', system-ui, sans-serif;">
    <div style="max-width: 1200px; margin: 0 auto;">

        <div class="tc-sbr__header" style="text-align: center; max-width: 640px; margin: 0 auto 56px;" data-tc-sbr-header>
            <div style="display: inline-block; background: #FFCD00; color: #63666A; padding: 7px 14px; font-size: 11px; letter-spacing: 0.18em; font-weight: 500; text-transform: uppercase; margin-bottom: 20px;"><?php echo esc_html($eyebrow); ?></div>
            <h2 style="font-size: clamp(28px, 4vw, 40px); font-weight: 500; line-height: 1.1; margin: 0 0 16px; color: #63666A;"><?php echo esc_html($heading); ?></h2>
            <?php if ($intro) : ?><p style="font-size: 16px; line-height: 1.6; margin: 0; color: #63666A; opacity: 0.75;"><?php echo esc_html($intro); ?></p><?php endif; ?>
        </div>

        <div class="tc-sbr__grid" style="display: grid; grid-template-columns: 1fr; gap: 14px;" data-tc-sbr-grid>
            <?php foreach ($tiles as $i => $tile) :
                $name = $tile['name'] ?? '';
                $url = $tile['url'] ?? '#';
                $img = (is_array($tile['image'] ?? null) && !empty($tile['image']['url'])) ? $tile['image']['url'] : '';
            ?>
            <a href="<?php echo esc_url($url); ?>" class="tc-sbr__tile" data-tc-sbr-tile aria-label="<?php echo esc_attr($name); ?>"
               style="position: relative; aspect-ratio: 1/1; display: block; overflow: hidden; <?php echo $img ? 'background-image: linear-gradient(rgba(99,102,106,0.55), rgba(99,102,106,0.55)), url(' . esc_url($img) . ');' : 'background-color: #63666A;'; ?> background-size: cover; background-position: center; text-decoration: none; transition: transform 300ms ease, box-shadow 300ms ease;">
                <div style="position: absolute; inset: 0; padding: 24px; display: flex; flex-direction: column; justify-content: flex-end; color: #FFFFFF;">
                    <div style="font-size: 22px; font-weight: 500; line-height: 1.2;"><?php echo esc_html($name); ?></div>
                    <div class="tc-sbr__hover" style="opacity: 0; transform: translateY(8px); transition: opacity 200ms ease, transform 200ms ease; font-size: 12px; font-weight: 500; color: #FFCD00; margin-top: 6px;">Explore →</div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
@media (min-width: 600px) { .tc-sbr__grid { grid-template-columns: 1fr 1fr !important; } }
@media (min-width: 900px) { .tc-sbr__grid { grid-template-columns: 1fr 1fr 1fr !important; } }
.tc-sbr__tile:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.08); }
.tc-sbr__tile:hover .tc-sbr__hover { opacity: 1 !important; transform: translateY(0) !important; }
.tc-sbr__tile:focus-visible { outline: 2px solid #FFCD00; outline-offset: 2px; }
@media (prefers-reduced-motion: reduce) { .tc-sbr__tile, .tc-sbr__hover { transition: none !important; } }
</style>