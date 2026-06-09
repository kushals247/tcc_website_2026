<?php
if (!defined('ABSPATH')) exit;

$hero = get_field('brand_hero_image');
$hero_url = is_array($hero) ? ($hero['url'] ?? '') : (is_string($hero) ? $hero : '');
if (!$hero_url) {
    $hero_url = 'https://placehold.co/1600x900/3A3D40/FFCD00?text=' . rawurlencode(get_the_title()) . '&font=montserrat';
}

$logo = get_field('brand_logo');
$logo_url = is_array($logo) ? ($logo['url'] ?? '') : (is_string($logo) ? $logo : '');

$tagline = get_field('brand_tagline');
$eyebrow = get_field('brand_eyebrow') ?: 'BRAND';
?>
<section class="tc-single-brand-hero relative h-[40vh] md:h-[50vh] w-full overflow-hidden flex items-end"
         style="background-image:url('<?php echo esc_url($hero_url); ?>');background-size:cover;background-position:center;">
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent" aria-hidden="true"></div>
    <div class="absolute top-6 md:top-8 left-6 md:left-10 z-10 text-white/85 text-sm tracking-wide">
        <a href="<?php echo esc_url(home_url('/brands/')); ?>" class="hover:text-[#FFCD00] transition-colors">Brands</a>
        <span class="mx-2">/</span>
        <span><?php echo esc_html(get_the_title()); ?></span>
    </div>
    <div class="relative z-10 max-w-5xl mx-auto px-6 pb-12 md:pb-16 w-full">
        <?php if ($logo_url): ?>
            <div class="inline-block bg-white px-3 py-2 mb-4">
                <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?> logo" class="max-h-10 w-auto block">
            </div>
        <?php endif; ?>
        <?php if ($eyebrow): ?>
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-3"><?php echo esc_html($eyebrow); ?></p>
        <?php endif; ?>
        <h1 class="text-4xl md:text-6xl font-medium text-white leading-tight"><?php the_title(); ?></h1>
        <?php if ($tagline): ?>
            <p class="text-base md:text-lg text-white/85 mt-3 max-w-2xl"><?php echo esc_html($tagline); ?></p>
        <?php endif; ?>
    </div>
</section>
