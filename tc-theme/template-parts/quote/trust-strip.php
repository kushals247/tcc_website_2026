<?php
/**
 * Quote Page - Trust strip (showroom CTA).
 */
if (!defined('ABSPATH')) exit;

$heading = get_field('quote_trust_heading') ?: 'Prefer to visit in person?';
$body    = get_field('quote_trust_body');
?>
<section class="tc-quote-trust bg-[#F5F6F7] py-12">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <?php if ($heading) : ?>
            <h2 class="text-2xl md:text-3xl font-medium text-[#3A3D40] mb-3"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($body) : ?>
            <p class="text-base text-[#63666A] leading-relaxed"><?php echo esc_html($body); ?></p>
        <?php endif; ?>
        <a href="/store-locator/" class="inline-block text-sm text-[#FFCD00] border-b border-[#FFCD00] hover:translate-x-1 transition-transform mt-4">Visit a showroom &rarr;</a>
    </div>
</section>