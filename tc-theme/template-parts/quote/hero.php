<?php
/**
 * Quote Page - Hero (half-bleed, content bottom-left).
 */
if (!defined('ABSPATH')) exit;

$hero_image    = get_field('quote_hero_image');
$hero_eyebrow  = get_field('quote_hero_eyebrow') ?: 'REQUEST A QUOTE';
$hero_headline = get_field('quote_hero_headline') ?: 'Tell us about your project.';
$hero_subline  = get_field('quote_hero_subline');
?>
<section class="tc-quote-hero relative w-full h-[30vh] md:h-[40vh] overflow-hidden flex items-end">
    <?php if ($hero_image) : ?>
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url($hero_image); ?>');" aria-hidden="true"></div>
    <?php else : ?>
        <div class="absolute inset-0 bg-[#3A3D40]" aria-hidden="true"></div>
    <?php endif; ?>

    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/30 to-transparent" aria-hidden="true"></div>

    <div class="relative z-10 max-w-5xl mx-auto px-6 pb-10 md:pb-14 w-full">
        <?php if ($hero_eyebrow) : ?>
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-3"><?php echo esc_html($hero_eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($hero_headline) : ?>
            <h1 class="text-4xl md:text-6xl font-medium text-white leading-tight"><?php echo esc_html($hero_headline); ?></h1>
        <?php endif; ?>
        <?php if ($hero_subline) : ?>
            <p class="text-base md:text-lg text-white/85 mt-3 max-w-2xl"><?php echo esc_html($hero_subline); ?></p>
        <?php endif; ?>
    </div>
</section>