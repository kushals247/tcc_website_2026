<?php
/**
 * Testimonials rotating quote display.
 * Cool-gray band full-bleed. ACF-managed with placeholder fallback.
 */
if (!defined('ABSPATH')) exit;

$eyebrow = function_exists('get_field') ? (get_field('testimonials_eyebrow') ?: 'Trusted') : 'Trusted';
$heading = function_exists('get_field') ? (get_field('testimonials_heading') ?: 'Trusted by professionals and homeowners across Kenya.') : 'Trusted by professionals and homeowners across Kenya.';
$autoplay = function_exists('get_field') ? (int)(get_field('testimonials_autoplay_seconds') ?: 8) : 8;
$items = function_exists('get_field') ? (get_field('testimonials') ?: []) : [];

if (empty($items)) {
    $items = [
        ['quote' => 'T&C made our bathroom renovation effortless. The team understood exactly what we wanted and helped us choose products that fit our style and budget.', 'name' => 'Sample Customer', 'project_type' => 'Residential renovation', 'city' => 'Nairobi'],
        ['quote' => 'From the initial showroom visit to delivery, T&C delivered premium quality and professional service throughout our commercial project.', 'name' => 'Sample Customer', 'project_type' => 'Commercial fit-out', 'city' => 'Mombasa'],
        ['quote' => 'The range of brands and the expert advice we received made T&C the obvious choice for our home build. Highly recommend.', 'name' => 'Sample Customer', 'project_type' => 'New build', 'city' => 'Karen, Nairobi'],
    ];
}
?>
<section id="tc-testimonials" class="tc-tm" data-autoplay-seconds="<?php echo (int)$autoplay; ?>" style="background: #63666A; color: #FFFFFF; padding: 128px 24px; font-family: 'Montserrat', system-ui, sans-serif;">
    <div style="max-width: 720px; margin: 0 auto; text-align: center;">
        <div style="display: inline-block; background: #FFCD00; color: #63666A; padding: 7px 14px; font-size: 11px; letter-spacing: 0.18em; font-weight: 500; text-transform: uppercase; margin-bottom: 20px;"><?php echo esc_html($eyebrow); ?></div>
        <h2 style="font-size: clamp(24px, 3.5vw, 32px); font-weight: 500; line-height: 1.25; margin: 0 0 56px; color: #FFFFFF;"><?php echo esc_html($heading); ?></h2>

        <div class="tc-tm__viewport" style="position: relative; min-height: 220px;" data-tc-tm-viewport>
            <?php foreach ($items as $i => $t) :
                $quote = $t['quote'] ?? '';
                $name = $t['name'] ?? '';
                $project = $t['project_type'] ?? '';
                $city = $t['city'] ?? '';
                $img = (is_array($t['customer_image'] ?? null) && !empty($t['customer_image']['url'])) ? $t['customer_image']['url'] : '';
                $context_parts = array_filter([$project, $city]);
                $context = implode(' · ', $context_parts);
            ?>
            <div class="tc-tm__quote" data-quote-index="<?php echo (int)$i; ?>" aria-live="polite"
                 style="position: absolute; inset: 0; opacity: <?php echo $i === 0 ? '1' : '0'; ?>; transition: opacity 600ms ease;">
                <p style="font-size: clamp(18px, 2vw, 22px); font-weight: 400; line-height: 1.5; color: #FFFFFF; margin: 0 0 24px;"><span style="color: #FFCD00; font-size: 1.4em; line-height: 0; vertical-align: -0.2em; margin-right: 2px;">“</span><?php echo esc_html($quote); ?></p>
                <div style="display: inline-flex; align-items: center; gap: 12px;">
                    <?php if ($img) : ?><img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($name); ?>" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;"><?php endif; ?>
                    <div style="text-align: left;">
                        <div style="font-size: 14px; font-weight: 500; color: #FFCD00;"><?php echo esc_html($name); ?></div>
                        <?php if ($context) : ?><div style="font-size: 12px; color: rgba(255,255,255,0.75); margin-top: 2px;"><?php echo esc_html($context); ?></div><?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php if (count($items) > 1) : ?>
        <div style="display: flex; gap: 10px; justify-content: center; margin-top: 40px;" data-tc-tm-dots>
            <?php foreach ($items as $i => $t) : ?>
            <button type="button" data-dot-index="<?php echo (int)$i; ?>" aria-label="Show testimonial <?php echo $i + 1; ?>"
                    style="width: 28px; height: 3px; background: <?php echo $i === 0 ? '#FFCD00' : 'rgba(255,255,255,0.3)'; ?>; border: 0; cursor: pointer; padding: 0;"></button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<style>
.tc-tm__quote { will-change: opacity; }
.tc-tm button:focus-visible { outline: 2px solid #FFCD00; outline-offset: 4px; }
@media (prefers-reduced-motion: reduce) { .tc-tm__quote { transition: none !important; } }
</style>