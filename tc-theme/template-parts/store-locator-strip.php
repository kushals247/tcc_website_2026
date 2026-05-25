<?php
/**
 * Store Locator strip template part.
 * Dark charcoal-darker band, ~280px tall, centred CTAs.
 */
if (!defined('ABSPATH')) exit;

$g = function ($name, $default = null) {
    return function_exists('get_field') ? (get_field($name) ?: $default) : $default;
};

$eyebrow = $g('locator_eyebrow', 'Visit us');
$heading = $g('locator_heading', 'Experience T&C in person.');
$body = $g('locator_body', 'Our specialists are ready to help across our showrooms in Kenya.');
$bg = function_exists('get_field') ? get_field('locator_background_image') : null;
$bg_url = (is_array($bg) && !empty($bg['url'])) ? $bg['url'] : '';
$primary_label = $g('locator_primary_cta_label', 'Find your nearest showroom');
$primary_url_raw = function_exists('get_field') ? get_field('locator_primary_cta_url') : null;
$primary_url = is_array($primary_url_raw) ? ($primary_url_raw['url'] ?? home_url('/store-locator/')) : ($primary_url_raw ?: home_url('/store-locator/'));
$wa_label = $g('locator_whatsapp_cta_label', 'WhatsApp us');

$wa_number = function_exists('get_field') ? trim((string) get_field('nav_whatsapp_number', 'option')) : '';
$wa_prefill = function_exists('get_field') ? (get_field('nav_whatsapp_prefill', 'option') ?: 'Hi, I would like to enquire about your products.') : 'Hi, I would like to enquire about your products.';
$wa_url = $wa_number ? 'https://wa.me/' . preg_replace('/[^\d]/', '', $wa_number) . '?text=' . rawurlencode($wa_prefill) : '';
?>
<section class="tc-sl" style="background-color: #3a3d40; color: #FFFFFF; padding: 64px 24px; min-height: 280px; position: relative; overflow: hidden; font-family: 'Montserrat', system-ui, sans-serif;">
    <?php if ($bg_url) : ?>
    <div aria-hidden="true" style="position: absolute; inset: 0; background-image: url('<?php echo esc_url($bg_url); ?>'); background-size: cover; background-position: center; opacity: 0.25; z-index: 1;"></div>
    <div aria-hidden="true" style="position: absolute; inset: 0; background-color: rgba(58,61,64,0.6); z-index: 2;"></div>
    <?php endif; ?>
    <div style="position: relative; z-index: 3; max-width: 800px; margin: 0 auto; text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 200px;">
        <div style="display: inline-block; background: #FFCD00; color: #63666A; padding: 7px 14px; font-size: 11px; letter-spacing: 0.18em; font-weight: 500; text-transform: uppercase; margin-bottom: 20px;"><?php echo esc_html($eyebrow); ?></div>
        <h2 style="font-size: clamp(24px, 3.5vw, 32px); font-weight: 500; line-height: 1.2; margin: 0 0 14px; color: #FFFFFF;"><?php echo esc_html($heading); ?></h2>
        <p style="font-size: 16px; line-height: 1.55; color: rgba(255,255,255,0.8); margin: 0 0 32px; max-width: 540px;"><?php echo esc_html($body); ?></p>
        <div class="tc-sl__ctas" style="display: flex; flex-direction: column; gap: 12px; width: 100%; max-width: 360px;" data-tc-sl-ctas>
            <a href="<?php echo esc_url($primary_url); ?>" style="background: #FFCD00; color: #63666A; padding: 14px 22px; font-size: 13px; font-weight: 500; text-decoration: none; text-align: center;"><?php echo esc_html($primary_label); ?></a>
            <?php if ($wa_url) : ?>
            <a href="<?php echo esc_url($wa_url); ?>" target="_blank" rel="noopener" style="background: transparent; color: #FFFFFF; border: 1px solid #FFFFFF; padding: 13px 22px; font-size: 13px; font-weight: 500; text-decoration: none; text-align: center; display: inline-flex; align-items: center; justify-content: center; gap: 8px;"><i class="ti ti-brand-whatsapp" style="font-size: 16px;" aria-hidden="true"></i><?php echo esc_html($wa_label); ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>
<style>
@media (min-width: 600px) { .tc-sl__ctas { flex-direction: row !important; max-width: none !important; justify-content: center; } .tc-sl__ctas a { flex: 0 1 auto !important; } }
.tc-sl a:focus-visible { outline: 2px solid #FFCD00; outline-offset: 2px; }
</style>