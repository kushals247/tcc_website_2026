<?php
/**
 * Template part: Hero Carousel (two-panel)
 * Renders the home hero with left text panel and right media panel.
 */
if (!defined('ABSPATH')) exit;

// ----- Defensive ACF reads with sensible defaults -----
$has_acf = function_exists('get_field');

$slides = $has_acf ? get_field('hero_slides') : null;
if (empty($slides) || !is_array($slides)) {
    $slides = [
        ['slide_image' => '', 'slide_image_mobile' => '', 'slide_eyebrow_text' => 'Structure essentials'],
        ['slide_image' => '', 'slide_image_mobile' => '', 'slide_eyebrow_text' => 'Surfaces & finishes'],
        ['slide_image' => '', 'slide_image_mobile' => '', 'slide_eyebrow_text' => 'Softs & decor'],
    ];
}

$hero_headline    = $has_acf ? get_field('hero_headline') : '';
if (empty($hero_headline))    { $hero_headline = 'Elevate your space.'; }

$hero_subheadline = $has_acf ? get_field('hero_subheadline') : '';
if (empty($hero_subheadline)) { $hero_subheadline = 'From foundations to finishing touches — your complete destination for building, interiors and decor across Kenya.'; }

$cta1_label = $has_acf ? get_field('hero_cta_primary_label') : '';
if (empty($cta1_label))   { $cta1_label = 'Explore our solutions'; }

$cta1_link  = $has_acf ? get_field('hero_cta_primary_url') : null;
$cta1_url   = is_array($cta1_link) && !empty($cta1_link['url']) ? $cta1_link['url'] : (is_string($cta1_link) && $cta1_link ? $cta1_link : '#ecosystems');

$cta2_label = $has_acf ? get_field('hero_cta_secondary_label') : '';
if (empty($cta2_label))   { $cta2_label = 'Find a showroom'; }

$cta2_link  = $has_acf ? get_field('hero_cta_secondary_url') : null;
$cta2_url   = is_array($cta2_link) && !empty($cta2_link['url']) ? $cta2_link['url'] : (is_string($cta2_link) && $cta2_link ? $cta2_link : home_url('/store-locator/'));

$autoplay   = $has_acf ? get_field('hero_autoplay_seconds') : 0;
if (empty($autoplay))     { $autoplay = 6; }

$show_dots_raw = $has_acf ? get_field('hero_show_dots') : null;
$show_dots = ($show_dots_raw === null) ? true : (bool)$show_dots_raw;

// Determine whether any slide has an image (controls fallback pattern)
$any_image = false;
foreach ($slides as $s) {
    if (!empty($s['slide_image'])) { $any_image = true; break; }
}

// Helper: resolve image to URL whether ACF returns array, ID, or URL
$resolve_image = function($img) {
    if (empty($img)) return '';
    if (is_array($img)) {
        if (!empty($img['url'])) return $img['url'];
        if (!empty($img['sizes']) && !empty($img['sizes']['large'])) return $img['sizes']['large'];
        return '';
    }
    if (is_numeric($img)) {
        $u = wp_get_attachment_image_url((int)$img, 'full');
        return $u ? $u : '';
    }
    return (string)$img;
};
?>
<section id="tc-hero" class="tc-hero" data-autoplay-seconds="<?php echo esc_attr((int)$autoplay); ?>" style="position:relative;height:100vh;min-height:560px;background:#FFFFFF;overflow:hidden;font-family:'Montserrat',system-ui,sans-serif;">
    <div class="tc-hero__inner" data-tc-hero-grid style="display:grid;grid-template-columns:1fr;height:100%;">

        <div class="tc-hero__text" style="display:flex;flex-direction:column;justify-content:center;padding:96px 32px 48px;color:#63666A;">
            <span id="tc-hero-eyebrow" aria-live="polite" class="tc-hero__eyebrow" data-tc-eyebrow style="display:inline-block;align-self:flex-start;background:#FFCD00;color:#63666A;padding:7px 14px;font-size:11px;letter-spacing:0.18em;font-weight:500;text-transform:uppercase;margin-bottom:24px;opacity:0;transform:translateY(20px);"><?php echo esc_html($slides[0]['slide_eyebrow_text'] ?? ''); ?></span>

            <h1 class="tc-hero__headline" data-tc-headline style="font-size:clamp(32px,5vw,48px);font-weight:500;line-height:1.05;letter-spacing:-0.01em;margin:0 0 16px;max-width:540px;opacity:0;transform:translateY(24px);"><?php echo esc_html($hero_headline); ?></h1>

            <p class="tc-hero__subheadline" data-tc-subheadline style="font-size:16px;line-height:1.6;max-width:460px;margin:0 0 32px;color:#63666A;opacity:0;transform:translateY(16px);"><?php echo esc_html($hero_subheadline); ?></p>

            <div class="tc-hero__ctas" data-tc-ctas style="display:flex;flex-wrap:wrap;gap:10px;opacity:0;">
                <a href="<?php echo esc_url($cta1_url); ?>" style="background:#FFCD00;color:#63666A;padding:14px 24px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                    <span><?php echo esc_html($cta1_label); ?></span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
                <a href="<?php echo esc_url($cta2_url); ?>" style="background:transparent;color:#63666A;border:1px solid #63666A;padding:13px 24px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;"><?php echo esc_html($cta2_label); ?></a>
            </div>
        </div>

        <div class="tc-hero__media" data-tc-hero-media style="position:relative;background:#F5F6F7;overflow:hidden;min-height:280px;">
            <?php foreach ($slides as $i => $slide) :
                $img = $resolve_image($slide['slide_image'] ?? '');
                $eyebrow_attr = $slide['slide_eyebrow_text'] ?? '';
            ?>
            <div class="tc-hero__slide" role="img" aria-label="<?php echo esc_attr( $eyebrow_attr ?: '' ); ?>" data-slide-index="<?php echo (int)$i; ?>" data-eyebrow="<?php echo esc_attr($eyebrow_attr); ?>" style="position:absolute;inset:0;opacity:<?php echo $i === 0 ? '1' : '0'; ?>;transition:opacity 1200ms ease-in-out;background-color:#F5F6F7;background-image:<?php echo $img ? 'url(' . esc_url($img) . ')' : 'none'; ?>;background-size:cover;background-position:center;"></div>
            <?php endforeach; ?>

            <?php if (!$any_image) : ?>
            <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;opacity:0.35;pointer-events:none;">
                <svg viewBox="0 0 200 200" width="60%" height="60%" aria-hidden="true">
                    <g fill="#FFCD00">
                        <rect x="10" y="10" width="20" height="20"/><circle cx="60" cy="20" r="10"/>
                        <rect x="90" y="10" width="20" height="20"/><circle cx="140" cy="20" r="10"/>
                        <rect x="170" y="10" width="20" height="20"/>
                        <circle cx="20" cy="60" r="10"/><rect x="50" y="50" width="20" height="20"/>
                        <circle cx="100" cy="60" r="10"/><rect x="130" y="50" width="20" height="20"/>
                        <circle cx="180" cy="60" r="10"/>
                        <rect x="10" y="90" width="20" height="20"/><circle cx="60" cy="100" r="10"/>
                        <rect x="90" y="90" width="20" height="20"/><circle cx="140" cy="100" r="10"/>
                        <rect x="170" y="90" width="20" height="20"/>
                    </g>
                </svg>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($show_dots && count($slides) > 1) : ?>
    <div class="tc-hero__dots" data-tc-hero-dots style="position:absolute;bottom:24px;left:0;right:0;display:flex;gap:8px;justify-content:center;z-index:5;">
        <?php foreach ($slides as $i => $slide) : ?>
        <button type="button" data-dot-index="<?php echo (int)$i; ?>" aria-label="<?php echo esc_attr(sprintf('Go to slide %d', $i + 1)); ?>" style="width:28px;height:3px;background:<?php echo $i === 0 ? '#FFCD00' : '#E0E0E0'; ?>;border:0;cursor:pointer;padding:0;"></button>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</section>

<style>
@media (min-width: 768px) {
    [data-tc-hero-grid] { grid-template-columns: 1fr 1fr !important; }
    .tc-hero__text { padding: 96px 48px 48px !important; }
}
.tc-hero a:focus-visible, .tc-hero button:focus-visible { outline: 2px solid #FFCD00; outline-offset: 2px; }
@media (prefers-reduced-motion: reduce) {
    [data-tc-eyebrow], [data-tc-headline], [data-tc-subheadline], [data-tc-ctas] { opacity: 1 !important; transform: none !important; }
    .tc-hero__slide { transition: none !important; }
}
</style>