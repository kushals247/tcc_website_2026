<?php
/**
 * Mega menu template part — PIM-driven.
 * Reads IA structure from tc_get_ia_structure() and renders one panel per ecosystem.
 * Each panel shows L1 sub-cats in a 4-column grid with their L2 children listed.
 * Featured items + utility bar still come from ACF mega_menu_ecosystems options.
 */
if (!defined('ABSPATH')) exit;
if (!function_exists('tc_get_ia_structure')) return;

$ia = tc_get_ia_structure();
$acf_eco_data = function_exists('get_field') ? (get_field('mega_menu_ecosystems', 'option') ?: []) : [];
// Index ACF data by slug for fast lookup of featured items per ecosystem
$acf_by_slug = [];
foreach ($acf_eco_data as $row) {
    if (!empty($row['slug'])) $acf_by_slug[$row['slug']] = $row;
}

$shop_by_room_url = function_exists('get_field') ? (get_field('megamenu_shop_by_room_url', 'option') ?: '#shop-by-room') : '#shop-by-room';
$brands_directory_url = function_exists('get_field') ? (get_field('megamenu_brands_directory_url', 'option') ?: home_url('/brands/')) : home_url('/brands/');

// Trigger button uses short slugs (structure/surfaces/softs) per nav-header. Map them.
$trigger_slug_map = [
    'structure-essentials' => 'structure',
    'surfaces-finishes'    => 'surfaces',
    'softs-decor'          => 'softs',
];
?>
<div id="tc-megamenu-backdrop" class="tc-megamenu-backdrop" aria-hidden="true"
     style="position: fixed; inset: 80px 0 0 0; background: rgba(0,0,0,0.4); opacity: 0; pointer-events: none; transition: opacity 200ms ease; z-index: 45;"></div>

<?php foreach ($ia as $eco_slug => $eco):
    $trigger_slug = $trigger_slug_map[$eco_slug] ?? $eco_slug;
    $acf_row = $acf_by_slug[$trigger_slug] ?? ($acf_by_slug[$eco_slug] ?? []);
    $featured_heading = $acf_row['featured_heading'] ?? 'Featured';
    $featured_items = $acf_row['featured_items'] ?? [];
    $explore_all_url = home_url('/' . $eco_slug . '/');
    $l1_items = $eco['l1'];
?>
<div id="tc-megamenu-<?php echo esc_attr($trigger_slug); ?>" class="tc-megamenu-panel" role="dialog" aria-modal="false" aria-labelledby="tc-megamenu-<?php echo esc_attr($trigger_slug); ?>-heading"
     style="display: none; position: fixed; top: 80px; left: 0; right: 0; background: #FFFFFF; box-shadow: 0 12px 24px rgba(0,0,0,0.08); z-index: 46; max-height: 80vh; overflow-y: auto; font-family: 'Montserrat', system-ui, sans-serif;">
    <div style="max-width: 1440px; margin: 0 auto; padding: 28px 32px;">
        <div style="display: grid; grid-template-columns: 1fr; gap: 16px; margin-bottom: 24px; padding-bottom: 18px; border-bottom: 1px solid #ECECEC;" data-tc-megamenu-header>
            <div>
                <div style="display: inline-block; background: #FFCD00; color: #63666A; padding: 5px 11px; font-size: 10px; letter-spacing: 0.18em; font-weight: 500; text-transform: uppercase; margin-bottom: 10px;"><?php echo esc_html($eco['eyebrow']); ?></div>
                <div id="tc-megamenu-<?php echo esc_attr($trigger_slug); ?>-heading" style="color: #63666A; font-size: 22px; font-weight: 500; line-height: 1.15; margin-bottom: 6px;"><?php echo esc_html($eco['name']); ?></div>
                <div style="color: #63666A; font-size: 12px; line-height: 1.5; opacity: 0.75; margin-bottom: 12px; max-width: 360px;"><?php echo esc_html($eco['description']); ?></div>
                <a href="<?php echo esc_url($explore_all_url); ?>" style="color: #63666A; font-size: 12px; font-weight: 500; border-bottom: 2px solid #FFCD00; padding-bottom: 2px; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">Explore all of <?php echo esc_html($eco['name']); ?> <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
            </div>
            <?php if (!empty($featured_items)): ?>
            <div style="background: #F5F6F7; padding: 14px;">
                <div style="font-size: 10px; letter-spacing: 0.15em; color: #C0C0C0; margin-bottom: 6px; text-transform: uppercase;">Featured</div>
                <div style="font-size: 13px; font-weight: 500; color: #63666A; margin-bottom: 10px;"><?php echo esc_html($featured_heading); ?></div>
                <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                    <?php foreach ($featured_items as $item): $item_label = $item['label'] ?? ''; $item_url = $item['url'] ?? '#'; if (!$item_label) continue; ?>
                    <a href="<?php echo esc_url($item_url); ?>" style="background: #FFFFFF; padding: 6px 10px; font-size: 11px; color: #63666A; border: 1px solid #ECECEC; text-decoration: none;"><?php echo esc_html($item_label); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div data-tc-megamenu-l1grid style="display: grid; grid-template-columns: 1fr; gap: 22px 28px;">
            <?php foreach ($l1_items as $l1_slug => $l1):
                $l1_url = home_url('/' . $eco_slug . '/' . $l1_slug . '/');
                $l2_items = $l1['l2'];
                $l2_count = count($l2_items);
                $max_visible = 6;
                $l2_visible = $l2_count > $max_visible ? array_slice($l2_items, 0, $max_visible, true) : $l2_items;
                $l2_remaining = $l2_count > $max_visible ? $l2_count - $max_visible : 0;
            ?>
            <div class="tc-megamenu-l1">
                <a href="<?php echo esc_url($l1_url); ?>" class="tc-megamenu-l1-head" style="display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 500; color: #63666A; text-decoration: none; padding-bottom: 6px; margin-bottom: 8px; border-bottom: 1px solid #ECECEC;">
                    <i class="ti ti-<?php echo esc_attr($l1['icon']); ?>" style="font-size:16px; color: #FFCD00;" aria-hidden="true"></i><?php echo esc_html($l1['name']); ?>
                </a>
                <?php if ($l2_count > 0): ?>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 4px;">
                    <?php foreach ($l2_visible as $l2_slug => $l2): ?>
                    <li><a href="<?php echo esc_url(home_url('/' . $eco_slug . '/' . $l1_slug . '/' . $l2_slug . '/')); ?>" class="tc-megamenu-l2" style="color: #63666A; font-size: 12px; line-height: 1.6; text-decoration: none; opacity: 0.85;"><?php echo esc_html($l2['name']); ?></a></li>
                    <?php endforeach; ?>
                    <?php if ($l2_remaining > 0): ?>
                    <li><a href="<?php echo esc_url($l1_url); ?>" style="color: #FFCD00; font-size: 11px; font-weight: 500; line-height: 1.6; text-decoration: none;">+ <?php echo (int)$l2_remaining; ?> more →</a></li>
                    <?php endif; ?>
                </ul>
                <?php else: ?>
                <a href="<?php echo esc_url($l1_url); ?>" style="color: #FFCD00; font-size: 11px; font-weight: 500; text-decoration: none;">Browse →</a>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
    <div style="background: #F5F6F7; border-top: 1px solid #ECECEC; padding: 14px 32px;">
        <div style="max-width: 1440px; margin: 0 auto; display: grid; grid-template-columns: 1fr; gap: 12px;" data-tc-megamenu-utility>
            <a href="<?php echo esc_url($shop_by_room_url); ?>" style="display: flex; align-items: center; gap: 10px; color: #63666A; font-size: 13px; font-weight: 500; text-decoration: none;"><i class="ti ti-grid-dots" style="font-size:18px; color: #FFCD00;" aria-hidden="true"></i>Shop by Room <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
            <a href="<?php echo esc_url($brands_directory_url); ?>" style="display: flex; align-items: center; gap: 10px; color: #63666A; font-size: 13px; font-weight: 500; text-decoration: none;"><i class="ti ti-tag" style="font-size:18px; color: #FFCD00;" aria-hidden="true"></i>All brands directory <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
        </div>
    </div>
</div>
<?php endforeach; ?>

<style>
@media (min-width: 768px) {
    [data-tc-megamenu-header] { grid-template-columns: 1.4fr 1fr !important; align-items: start; gap: 32px !important; }
    [data-tc-megamenu-l1grid] { grid-template-columns: 1fr 1fr !important; }
    [data-tc-megamenu-utility] { grid-template-columns: 1fr 1fr !important; }
}
@media (min-width: 1024px) {
    [data-tc-megamenu-l1grid] { grid-template-columns: 1fr 1fr 1fr 1fr !important; }
}
.tc-megamenu-panel.is-open { display: block !important; }
.tc-megamenu-backdrop.is-visible { opacity: 1 !important; pointer-events: auto !important; }
.tc-megamenu-l1-head:hover { color: #FFCD00 !important; }
.tc-megamenu-l2:hover { color: #FFCD00 !important; opacity: 1 !important; }
.tc-megamenu-panel a:focus-visible { outline: 2px solid #FFCD00; outline-offset: 2px; }
</style>
