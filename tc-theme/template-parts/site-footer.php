<?php
/**
 * Full site footer template part.
 * 3-column main + newsletter signup + bottom strip.
 */
if (!defined('ABSPATH')) exit;

$g = function ($name, $default = null) {
    return function_exists('get_field') ? (get_field($name, 'option') ?: $default) : $default;
};

$explore_links = $g('footer_explore_links', []);
$brands_links = $g('footer_brands_links', []);
$addresses = $g('footer_addresses', []);
$phone = $g('footer_phone', '');
$email = $g('footer_email', '');
$whatsapp_url = $g('footer_whatsapp_url', '');
$social_links = $g('footer_social_links', []);
$privacy_url = $g('footer_privacy_url', '#');
$terms_url = $g('footer_terms_url', '#');
$copyright = $g('footer_copyright_text', 'COPYRIGHT_PLACEHOLDER');
if ($copyright === 'COPYRIGHT_PLACEHOLDER') { $copyright = '© ' . date('Y') . ' Tile & Carpet Centre. All rights reserved.'; }
?>
<footer class="tc-footer" style="background: #63666A; color: #FFFFFF; font-family: 'Montserrat', system-ui, sans-serif;">
    <div style="max-width: 1440px; margin: 0 auto; padding: 80px 32px;">
        <div class="tc-footer__cols" style="display: grid; grid-template-columns: 1fr; gap: 48px;" data-tc-footer-cols>
            <div>
                <h3 style="font-size: 14px; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; margin: 0 0 16px; color: #FFFFFF;">Explore</h3>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 8px;">
                    <?php foreach ($explore_links as $link) :
                        $label = $link['label'] ?? '';
                        $url = $link['url'] ?? '#';
                        if (!$label) continue;
                    ?>
                    <li><a href="<?php echo esc_url($url); ?>" style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 13px; line-height: 1.8;"><?php echo esc_html($label); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div>
                <h3 style="font-size: 14px; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; margin: 0 0 16px; color: #FFFFFF;">Our brands</h3>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 8px;">
                    <?php foreach ($brands_links as $link) :
                        $label = $link['label'] ?? '';
                        $url = $link['url'] ?? '#';
                        if (!$label) continue;
                    ?>
                    <li><a href="<?php echo esc_url($url); ?>" style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 13px; line-height: 1.8;"><?php echo esc_html($label); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div>
                <h3 style="font-size: 14px; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; margin: 0 0 16px; color: #FFFFFF;">Get in touch</h3>
                <?php foreach ($addresses as $addr) :
                    $name = $addr['name'] ?? '';
                    $address = $addr['address'] ?? '';
                    if (!$address) continue;
                ?>
                <div style="margin-bottom: 16px; font-size: 13px; line-height: 1.6; color: rgba(255,255,255,0.8);">
                    <?php if ($name) : ?><div style="font-weight: 500; color: #FFFFFF; margin-bottom: 4px;"><?php echo esc_html($name); ?></div><?php endif; ?>
                    <?php echo nl2br(esc_html($address)); ?>
                </div>
                <?php endforeach; ?>
                <?php if ($phone) : ?><a href="tel:<?php echo esc_attr(preg_replace('/[^\d+]/', '', $phone)); ?>" style="display: flex; align-items: center; gap: 8px; color: rgba(255,255,255,0.8); text-decoration: none; font-size: 13px; margin-bottom: 6px;"><i class="ti ti-phone" style="font-size: 16px;" aria-hidden="true"></i><?php echo esc_html($phone); ?></a><?php endif; ?>
                <?php if ($email) : ?><a href="mailto:<?php echo esc_attr($email); ?>" style="display: flex; align-items: center; gap: 8px; color: rgba(255,255,255,0.8); text-decoration: none; font-size: 13px; margin-bottom: 6px;"><i class="ti ti-mail" style="font-size: 16px;" aria-hidden="true"></i><?php echo esc_html($email); ?></a><?php endif; ?>
                <?php if ($whatsapp_url) : ?><a href="<?php echo esc_url($whatsapp_url); ?>" target="_blank" rel="noopener" style="display: flex; align-items: center; gap: 8px; color: rgba(255,255,255,0.8); text-decoration: none; font-size: 13px; margin-bottom: 16px;"><i class="ti ti-brand-whatsapp" style="font-size: 16px;" aria-hidden="true"></i>WhatsApp</a><?php endif; ?>
                <?php if (!empty($social_links)) : ?>
                <div style="display: flex; gap: 16px; margin-top: 16px;">
                    <?php foreach ($social_links as $social) :
                        $icon = $social['icon_slug'] ?? '';
                        $url = $social['url'] ?? '#';
                        if (!$icon) continue;
                    ?>
                    <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr($icon); ?>" style="color: rgba(255,255,255,0.8); transition: color 200ms ease, transform 200ms ease;"><i class="ti ti-brand-<?php echo esc_attr($icon); ?>" style="font-size: 20px;" aria-hidden="true"></i></a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 48px; padding-top: 32px; text-align: center;">
            <div style="max-width: 600px; margin: 0 auto;">
                <div style="font-size: 18px; font-weight: 500; color: #FFFFFF; margin-bottom: 14px;">Join the T&amp;C community.</div>
                <form action="<?php echo esc_url($g('footer_newsletter_action_url', '#')); ?>" method="post" style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;">
                    <label for="tc-footer-newsletter-email" style="position: absolute; width: 1px; height: 1px; overflow: hidden;">Email address</label>
                    <input type="email" id="tc-footer-newsletter-email" name="email" placeholder="Your email" required style="background: #FFFFFF; color: #63666A; padding: 12px 16px; font-size: 13px; border: 0; min-width: 240px;">
                    <button type="submit" style="background: #FFCD00; color: #63666A; padding: 12px 20px; font-size: 13px; font-weight: 500; border: 0; cursor: pointer;">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
    <div style="background: #3a3d40; padding: 16px 32px; color: rgba(255,255,255,0.6); font-size: 11px;">
        <div style="max-width: 1440px; margin: 0 auto; display: grid; grid-template-columns: 1fr; gap: 8px; align-items: center; text-align: center;" data-tc-footer-bottom>
            <div style="font-weight: 500; color: rgba(255,255,255,0.8);">T&amp;C</div>
            <div><?php echo esc_html($copyright); ?></div>
            <div>
                <a href="<?php echo esc_url($privacy_url); ?>" style="color: rgba(255,255,255,0.6); text-decoration: none; margin-right: 12px;">Privacy</a>
                <a href="<?php echo esc_url($terms_url); ?>" style="color: rgba(255,255,255,0.6); text-decoration: none;">Terms</a>
            </div>
        </div>
    </div>
</footer>

<style>
@media (min-width: 768px) {
    [data-tc-footer-cols] { grid-template-columns: 1fr 1fr 1.5fr !important; }
    [data-tc-footer-bottom] { grid-template-columns: 1fr 2fr 1fr !important; text-align: left !important; }
    [data-tc-footer-bottom] > div:nth-child(2) { text-align: center; }
    [data-tc-footer-bottom] > div:nth-child(3) { text-align: right; }
}
.tc-footer a:hover { color: #FFFFFF !important; }
.tc-footer a:focus-visible { outline: 2px solid #FFCD00; outline-offset: 2px; }
.tc-footer [aria-label]:hover { transform: scale(1.1); }
</style>