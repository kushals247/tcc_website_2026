<?php
if (!defined('ABSPATH')) exit;

$hours = get_field('contact_hours');
if (!$hours) return;
?>
<section class="tc-contact-hours bg-[#F5F6F7] py-12">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <p class="text-sm text-[#63666A] leading-relaxed"><?php echo nl2br(esc_html($hours)); ?></p>
    </div>
</section>