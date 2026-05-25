<?php
if (!defined('ABSPATH')) exit;

$methods_heading = get_field('contact_methods_heading');
$form_heading = get_field('contact_form_heading');
$form_shortcode = get_field('contact_form_shortcode');
$phone = get_field('contact_phone');
$wa_raw = get_field('contact_whatsapp_number');
$email = get_field('contact_email');
$hq_address = get_field('contact_hq_address');
$mombasa_address = get_field('contact_mombasa_address');

$wa_digits = $wa_raw ? preg_replace('/\D+/', '', $wa_raw) : '';
$socials = get_field('footer_social_links', 'options');
?>
<section class="tc-contact-main bg-white py-20 md:py-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-20">
            <div>
                <?php if ($methods_heading): ?>
                    <h2 class="text-2xl md:text-3xl font-medium text-[#3A3D40] mb-8"><?php echo esc_html($methods_heading); ?></h2>
                <?php endif; ?>

                <?php if ($phone): ?>
                    <div class="mb-6">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[#FFCD00]">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </span>
                            <span class="text-xs tracking-[0.15em] uppercase text-[#63666A]">Phone</span>
                        </div>
                        <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>" class="text-lg text-[#3A3D40] hover:text-[#FFCD00] transition-colors"><?php echo esc_html($phone); ?></a>
                    </div>
                <?php endif; ?>

                <?php if ($wa_digits): ?>
                    <div class="mb-6">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[#FFCD00]">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347zm-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.999-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.886 9.884z"/></svg>
                            </span>
                            <span class="text-xs tracking-[0.15em] uppercase text-[#63666A]">WhatsApp</span>
                        </div>
                        <a href="https://wa.me/<?php echo esc_attr($wa_digits); ?>" target="_blank" rel="noopener" class="text-lg text-[#3A3D40] hover:text-[#FFCD00] transition-colors"><?php echo esc_html($wa_raw); ?></a>
                    </div>
                <?php endif; ?>

                <?php if ($email): ?>
                    <div class="mb-6">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[#FFCD00]">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </span>
                            <span class="text-xs tracking-[0.15em] uppercase text-[#63666A]">Email</span>
                        </div>
                        <a href="mailto:<?php echo esc_attr($email); ?>" class="text-lg text-[#3A3D40] hover:text-[#FFCD00] transition-colors"><?php echo esc_html($email); ?></a>
                    </div>
                <?php endif; ?>

                <?php if (is_array($socials) && !empty($socials)): ?>
                    <div class="flex gap-4 mt-6">
                        <?php foreach ($socials as $s):
                            $url = $s['url'] ?? '';
                            $slug = $s['icon_slug'] ?? '';
                            if (!$url) continue;
                            $letter = strtoupper(substr($slug ?: 'L', 0, 1));
                        ?>
                            <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener" class="w-9 h-9 rounded-full bg-[#FFCD00] text-[#3A3D40] flex items-center justify-center text-sm font-medium hover:bg-[#FFD52E] transition-colors" aria-label="<?php echo esc_attr($slug); ?>"><?php echo esc_html($letter); ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($hq_address || $mombasa_address): ?>
                    <h3 class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mt-10 mb-4">Showrooms</h3>
                    <?php if ($hq_address): ?>
                        <div class="mb-4">
                            <p class="text-xs tracking-[0.15em] uppercase text-[#63666A] mb-1">Nairobi HQ</p>
                            <p class="text-sm text-[#3A3D40] leading-relaxed"><?php echo nl2br(esc_html($hq_address)); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if ($mombasa_address): ?>
                        <div class="mb-4">
                            <p class="text-xs tracking-[0.15em] uppercase text-[#63666A] mb-1">Mombasa</p>
                            <p class="text-sm text-[#3A3D40] leading-relaxed"><?php echo nl2br(esc_html($mombasa_address)); ?></p>
                        </div>
                    <?php endif; ?>
                    <a href="<?php echo esc_url(home_url('/store-locator/')); ?>" class="text-sm text-[#FFCD00] border-b border-[#FFCD00] inline-block">Full list of branches &rarr;</a>
                <?php endif; ?>
            </div>

            <div>
                <?php if ($form_heading): ?>
                    <h2 class="text-2xl md:text-3xl font-medium text-[#3A3D40] mb-8"><?php echo esc_html($form_heading); ?></h2>
                <?php endif; ?>
                <?php if ($form_shortcode): ?>
                    <?php echo do_shortcode($form_shortcode); ?>
                <?php else: ?>
                    <p class="text-base text-[#63666A] leading-relaxed">Form coming soon. In the meantime, please email or call us.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<style>
.tc-contact-main .wpcf7-form label { display:block; font-size:0.875rem; color:#63666A; margin-bottom:0.25rem; margin-top:1rem; }
.tc-contact-main .wpcf7-form input[type="text"],
.tc-contact-main .wpcf7-form input[type="email"],
.tc-contact-main .wpcf7-form input[type="tel"],
.tc-contact-main .wpcf7-form input[type="url"],
.tc-contact-main .wpcf7-form input[type="number"],
.tc-contact-main .wpcf7-form select,
.tc-contact-main .wpcf7-form textarea {
    width:100%; padding:0.75rem 1rem; border:1px solid #ECECEC; background:#fff; color:#3A3D40;
    transition: border-color 0.2s; outline:none; border-radius:0;
}
.tc-contact-main .wpcf7-form input:focus,
.tc-contact-main .wpcf7-form select:focus,
.tc-contact-main .wpcf7-form textarea:focus { border-color:#FFCD00; }
.tc-contact-main .wpcf7-form input[type="submit"],
.tc-contact-main .wpcf7-form button[type="submit"] {
    background:#FFCD00; color:#3A3D40; padding:1rem 2rem; font-weight:500;
    border:0; cursor:pointer; width:auto; margin-top:1.5rem; transition:background-color 0.2s;
}
.tc-contact-main .wpcf7-form input[type="submit"]:hover,
.tc-contact-main .wpcf7-form button[type="submit"]:hover { background:#FFD52E; }
.tc-contact-main .wpcf7-response-output { border:1px solid #ECECEC; padding:0.75rem 1rem; margin-top:1rem; font-size:0.875rem; }
</style>