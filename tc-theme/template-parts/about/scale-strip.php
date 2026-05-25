<?php
if (!defined('ABSPATH')) exit;

$eyebrow = get_field('about_scale_eyebrow');
$heading = get_field('about_scale_heading');
$stats = get_field('about_scale_stats');

if (!$stats) return;
?>
<section class="tc-about-scale bg-[#63666A] py-20">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto">
            <?php if ($eyebrow): ?>
                <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p>
            <?php endif; ?>
            <?php if ($heading): ?>
                <h2 class="text-2xl md:text-3xl font-medium text-white"><?php echo esc_html($heading); ?></h2>
            <?php endif; ?>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 mt-12 text-center">
            <?php foreach ($stats as $stat):
                $number = $stat['number'] ?? '';
                $label = $stat['label'] ?? '';
            ?>
                <div data-reveal="card">
                    <?php if ($number): ?><div class="text-4xl md:text-6xl font-semibold text-[#FFCD00] leading-none"><?php echo esc_html($number); ?></div><?php endif; ?>
                    <?php if ($label): ?><div class="text-xs md:text-sm tracking-[0.15em] uppercase text-white/85 mt-3"><?php echo esc_html($label); ?></div><?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>