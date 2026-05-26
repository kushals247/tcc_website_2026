<?php
/**
 * Quote Page - Form area.
 * Left col: steps + secondary contact methods.
 * Right col: CF7 form (rendered from ACF shortcode field).
 */
if (!defined('ABSPATH')) exit;

$steps_heading      = get_field('quote_steps_heading') ?: 'What happens next.';
$steps              = get_field('quote_steps_items');
$secondary_heading  = get_field('quote_secondary_methods_heading') ?: 'Prefer to call or message?';
$form_shortcode     = get_field('quote_form_shortcode');

// Secondary contact details from /contact/ page (fallback options).
$phone     = '';
$whatsapp  = '';
$contact_page = get_page_by_path('contact');
if ($contact_page) {
    $phone    = get_field('contact_phone', $contact_page->ID);
    $whatsapp = get_field('contact_whatsapp_number', $contact_page->ID);
}
if (!$whatsapp && function_exists('get_field')) {
    $whatsapp = get_field('nav_whatsapp_number', 'options');
}
$wa_digits = preg_replace('/\D+/', '', (string) $whatsapp);
?>
<style>
    .tc-quote .wpcf7-form label { display: block; font-size: 0.875rem; color: #63666A; margin-top: 1rem; margin-bottom: 0.25rem; font-weight: 500; }
    .tc-quote .wpcf7-form input[type=text],
    .tc-quote .wpcf7-form input[type=email],
    .tc-quote .wpcf7-form input[type=tel],
    .tc-quote .wpcf7-form input[type=url],
    .tc-quote .wpcf7-form input[type=number],
    .tc-quote .wpcf7-form select,
    .tc-quote .wpcf7-form textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #ECECEC;
        background: white;
        color: #3A3D40;
        font-size: 1rem;
        transition: border-color 0.2s;
        font-family: inherit;
    }
    .tc-quote .wpcf7-form input:focus,
    .tc-quote .wpcf7-form select:focus,
    .tc-quote .wpcf7-form textarea:focus { outline: none; border-color: #FFCD00; }
    .tc-quote .wpcf7-form textarea { min-height: 100px; }
    .tc-quote .wpcf7-form .wpcf7-radio,
    .tc-quote .wpcf7-form .wpcf7-checkbox { display: block; }
    .tc-quote .wpcf7-form .wpcf7-list-item { display: block; margin: 0.5rem 0; margin-left: 0; }
    .tc-quote .wpcf7-form .wpcf7-list-item-label { margin-left: 0.5rem; color: #3A3D40; }
    .tc-quote .wpcf7-form input[type=submit] {
        background: #FFCD00;
        color: #3A3D40;
        padding: 1rem 2.5rem;
        font-weight: 500;
        border: 0;
        cursor: pointer;
        margin-top: 2rem;
        transition: background 0.2s;
        font-size: 1rem;
    }
    .tc-quote .wpcf7-form input[type=submit]:hover { background: #FFD52E; }
    .tc-quote .wpcf7-form input[type=file] { padding: 0.5rem; background: #F5F6F7; }
    .tc-quote .wpcf7-form .wpcf7-not-valid-tip { color: #c00; font-size: 0.875rem; margin-top: 0.25rem; }
    .tc-quote .wpcf7-response-output { border: 1px solid; padding: 1rem; margin-top: 1rem; }
</style>
<section class="tc-quote-form-area bg-white py-16 md:py-20">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-16">

            <aside class="md:col-span-1">
                <h2 class="text-2xl md:text-3xl font-medium text-[#3A3D40] mb-8"><?php echo esc_html($steps_heading); ?></h2>

                <?php if (!empty($steps) && is_array($steps)) : ?>
                    <ol class="list-none p-0 m-0">
                        <?php foreach ($steps as $step) : ?>
                            <li class="flex gap-4 mb-6">
                                <span class="text-3xl font-medium text-[#FFCD00] leading-none flex-shrink-0 w-10"><?php echo esc_html($step['step_number'] ?? ''); ?></span>
                                <div>
                                    <h3 class="text-base font-medium text-[#3A3D40] mb-1"><?php echo esc_html($step['step_title'] ?? ''); ?></h3>
                                    <p class="text-sm text-[#63666A] leading-relaxed"><?php echo esc_html($step['step_body'] ?? ''); ?></p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                <?php endif; ?>

                <h3 class="text-base font-medium text-[#3A3D40] mt-12 mb-4"><?php echo esc_html($secondary_heading); ?></h3>

                <ul class="list-none p-0 m-0 space-y-3">
                    <?php if ($phone) : ?>
                        <li class="flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-[#FFCD00] rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#3A3D40" class="w-4 h-4" aria-hidden="true"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                            </span>
                            <div>
                                <p class="text-xs text-[#63666A] uppercase tracking-wider">Call us</p>
                                <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>" class="text-base text-[#3A3D40] hover:text-[#FFCD00] transition-colors"><?php echo esc_html($phone); ?></a>
                            </div>
                        </li>
                    <?php endif; ?>

                    <?php if ($wa_digits) : ?>
                        <li class="flex items-center gap-3">
                            <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-[#FFCD00] rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#3A3D40" class="w-4 h-4" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347zM12.05 21.785h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.999-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.886 9.884zm8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            </span>
                            <div>
                                <p class="text-xs text-[#63666A] uppercase tracking-wider">WhatsApp</p>
                                <a href="https://wa.me/<?php echo esc_attr($wa_digits); ?>" target="_blank" rel="noopener" class="text-base text-[#3A3D40] hover:text-[#FFCD00] transition-colors">Message us</a>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </aside>

            <div class="md:col-span-2">
                <h2 class="text-2xl md:text-3xl font-medium text-[#3A3D40] mb-6">Send us your enquiry</h2>
                <?php if ($form_shortcode) :
                    echo do_shortcode($form_shortcode);
                else : ?>
                    <p class="text-base text-[#63666A]">Form coming soon. In the meantime, please email <a href="mailto:enquiries@tilecentre.com" class="text-[#FFCD00] hover:underline">enquiries@tilecentre.com</a>.</p>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>