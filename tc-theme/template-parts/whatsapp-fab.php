<?php
/**
 * Floating WhatsApp button. Site-wide except WP Admin.
 */
if (!defined('ABSPATH')) exit;
if (is_admin()) return;

$enabled = function_exists('get_field') ? (bool) get_field('fab_enabled', 'option') : true;
if (!$enabled) return;

$number = function_exists('get_field') ? trim((string) get_field('nav_whatsapp_number', 'option')) : '';
$prefill = function_exists('get_field') ? (get_field('nav_whatsapp_prefill', 'option') ?: 'Hi, I would like to enquire about your products.') : 'Hi, I would like to enquire about your products.';
if (!$number) return;

$wa_url = 'https://wa.me/' . preg_replace('/[^\d]/', '', $number) . '?text=' . rawurlencode($prefill);
?>
<a id="tc-whatsapp-fab" href="<?php echo esc_url($wa_url); ?>" target="_blank" rel="noopener" aria-label="Contact us on WhatsApp"
   style="position: fixed; bottom: 16px; right: 16px; width: 56px; height: 56px; background: #FFCD00; color: #63666A; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 100; opacity: 0; pointer-events: none; transition: opacity 300ms ease, transform 200ms ease, box-shadow 200ms ease; text-decoration: none;">
    <i class="ti ti-brand-whatsapp" style="font-size: 28px;" aria-hidden="true"></i>
</a>
<style>
#tc-whatsapp-fab.is-visible { opacity: 1 !important; pointer-events: auto !important; }
#tc-whatsapp-fab:hover { transform: scale(1.05); box-shadow: 0 6px 20px rgba(0,0,0,0.2); }
#tc-whatsapp-fab:focus-visible { outline: 2px solid #63666A; outline-offset: 2px; }
</style>