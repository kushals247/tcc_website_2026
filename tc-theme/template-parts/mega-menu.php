<?php
/**
 * Mega menu template part.
 * Renders one panel per ecosystem from ACF options + shared backdrop.
 * Triggered by nav-header ecosystem buttons via data-megamenu-trigger.
 */
if (!defined('ABSPATH')) exit;

$ecosystems = function_exists('get_field') ? (get_field('mega_menu_ecosystems', 'option') ?: []) : [];
$shop_by_room_url = function_exists('get_field') ? (get_field('megamenu_shop_by_room_url', 'option') ?: '#shop-by-room') : '#shop-by-room';
$brands_directory_url = function_exists('get_field') ? (get_field('megamenu_brands_directory_url', 'option') ?: home_url('/brands/')) : home_url('/brands/');

if (empty($ecosystems)) return;
?>
<div id="tc-megamenu-backdrop" class="tc-megamenu-backdrop" aria-hidden="true"
     style="position: fixed; inset: 80px 0 0 0; background: rgba(0,0,0,0.4); opacity: 0; pointer-events: none; transition: opacity 200ms ease; z-index: 45;"></div>

<?php foreach ($ecosystems as $eco) :
    $slug = $eco['slug'] ?? '';
    $eyebrow = $eco['eyebrow_label'] ?? '';
    $name = $eco['name'] ?? '';
    $description = $eco['description'] ?? '';
    $explore_url = $eco['explore_all_url'] ?? '#';
    $subcategories = $eco['subcategories'] ?? [];
    $featured_heading = $eco['featured_heading'] ?? 'Featured';
    $featured_items = $eco['featured_items'] ?? [];
    if (!$slug) continue;
?>
<div id="tc-megamenu-<?php echo esc_attr($slug); ?>" class="tc-megamenu-panel" role="dialog" aria-modal="false" aria-labelledby="tc-megamenu-<?php echo esc_attr($slug); ?>-heading"
     style="display: none; position: fixed; top: 80px; left: 0; right: 0; background: #FFFFFF; box-shadow: 0 12px 24px rgba(0,0,0,0.08); z-index: 46; max-height: 75vh; overflow-y: auto; font-family: 'Montserrat', system-ui, sans-serif;">
    <div style="max-width: 1440px; margin: 0 auto; padding: 36px 32px 24px;">
        <div data-tc-megamenu-grid style="display: grid; grid-template-columns: 1fr; gap: 32px;">

            <div>
                <div style="display: inline-block; background: #FFCD00; color: #63666A; padding: 5px 11px; font-size: 10px; letter-spacing: 0.18em; font-weight: 500; text-transform: uppercase; margin-bottom: 14px;"><?php echo esc_html($eyebrow); ?></div>
                <div id="tc-megamenu-<?php echo esc_attr($slug); ?>-heading" style="color: #63666A; font-size: 22px; font-weight: 500; line-height: 1.15; margin-bottom: 10px;"><?php echo esc_html($name); ?></div>
                <div style="color: #63666A; font-size: 12px; line-height: 1.5; opacity: 0.75; margin-bottom: 18px;"><?php echo esc_html($description); ?></div>
                <a href="<?php echo esc_url($explore_url); ?>" style="color: #63666A; font-size: 12px; font-weight: 500; border-bottom: 2px solid #FFCD00; padding-bottom: 2px; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">Explore all of <?php echo esc_html($name); ?> <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4px 24px;">
                <?php foreach ($subcategories as $sub) :
                    $sub_name = $sub['name'] ?? '';
                    $sub_url = $sub['url'] ?? '#';
                    $sub_icon = $sub['icon_slug'] ?? 'point';
                    if (!$sub_name) continue;
                ?>
                <a href="<?php echo esc_url($sub_url); ?>" class="tc-megamenu-subcat" style="display: flex; align-items: center; gap: 10px; padding: 8px 0; color: #63666A; font-size: 13px; font-weight: 500; text-decoration: none;"><i class="ti ti-<?php echo esc_attr($sub_icon); ?>" style="font-size:18px; color: #C0C0C0;" aria-hidden="true"></i><?php echo esc_html($sub_name); ?></a>
                <?php endforeach; ?>
            </div>

            <div style="background: #F5F6F7; padding: 18px;">
                <div style="font-size: 10px; letter-spacing: 0.15em; color: #C0C0C0; margin-bottom: 8px; text-transform: uppercase;">Featured</div>
                <div style="font-size: 14px; font-weight: 500; color: #63666A; margin-bottom: 12px;"><?php echo esc_html($featured_heading); ?></div>
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <?php foreach ($featured_items as $item) :
                        $item_label = $item['label'] ?? '';
                        $item_url = $item['url'] ?? '#';
                        if (!$item_label) continue;
                    ?>
                    <a href="<?php echo esc_url($item_url); ?>" style="background: #FFFFFF; padding: 8px 12px; font-size: 12px; color: #63666A; border: 1px solid #ECECEC; text-decoration: none;"><?php echo esc_html($item_label); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
    <div style="background: #F5F6F7; border-top: 1px solid #ECECEC; padding: 16px 32px;">
        <div style="max-width: 1440px; margin: 0 auto; display: grid; grid-template-columns: 1fr; gap: 16px;" data-tc-megamenu-utility>
            <a href="<?php echo esc_url($shop_by_room_url); ?>" style="display: flex; align-items: center; gap: 10px; color: #63666A; font-size: 13px; font-weight: 500; text-decoration: none;"><i class="ti ti-grid-dots" style="font-size:18px; color: #FFCD00;" aria-hidden="true"></i>Shop by Room <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
            <a href="<?php echo esc_url($brands_directory_url); ?>" style="display: flex; align-items: center; gap: 10px; color: #63666A; font-size: 13px; font-weight: 500; text-decoration: none;"><i class="ti ti-tag" style="font-size:18px; color: #FFCD00;" aria-hidden="true"></i>All brands directory <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
        </div>
    </div>
</div>
<?php endforeach; ?>

<style>
@media (min-width: 1024px) {
    [data-tc-megamenu-grid] { grid-template-columns: 1fr 1.5fr 1.5fr 1fr !important; }
    [data-tc-megamenu-utility] { grid-template-columns: 1fr 1fr !important; }
}
.tc-megamenu-panel.is-open { display: block !important; }
.tc-megamenu-backdrop.is-visible { opacity: 1 !important; pointer-events: auto !important; }
.tc-megamenu-subcat { transition: transform 200ms ease, color 200ms ease; }
.tc-megamenu-subcat:hover { color: #FFCD00 !important; transform: translateX(4px); }
.tc-megamenu-subcat:hover i { color: #FFCD00 !important; }
.tc-megamenu-panel a:focus-visible { outline: 2px solid #FFCD00; outline-offset: 2px; }
</style>