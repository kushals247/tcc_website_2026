<?php
if (!defined('ABSPATH')) exit;

$eyebrow = get_field('about_footprint_eyebrow');
$heading = get_field('about_footprint_heading');
$regions = get_field('about_footprint_regions');

if (!$regions) return;
?>
<section class="tc-about-footprint bg-[#63666A] py-20 md:py-24">
    <div class="text-center max-w-3xl mx-auto px-6">
        <?php if ($eyebrow): ?>
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($heading): ?>
            <h2 class="text-3xl md:text-4xl font-medium text-white"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto px-6 mt-12">
        <?php foreach ($regions as $region):
            $region_name = $region['region_name'] ?? '';
            $locations = $region['locations'] ?? '';
            $emphasis = $region['emphasis'] ?? '';
            $border_class = ($emphasis === 'home') ? ' border-l-4 border-[#FFCD00]' : '';
        ?>
            <div class="bg-black/20 p-8<?php echo esc_attr($border_class); ?>" data-reveal="card">
                <?php if ($region_name): ?><h3 class="text-xl font-medium text-[#FFCD00] mb-4"><?php echo esc_html($region_name); ?></h3><?php endif; ?>
                <?php if ($locations): ?><p class="text-white/85 text-sm leading-relaxed"><?php echo nl2br(esc_html($locations)); ?></p><?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>