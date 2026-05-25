<?php
if (!defined('ABSPATH')) exit;
$eyebrow = get_field('pillar_advisory_eyebrow') ?: 'THINK ABOUT THIS';
$heading = get_field('pillar_advisory_heading');
$items = get_field('pillar_advisory_items');
if (!$items) return;
$cols = count($items) >= 2 ? 'md:grid-cols-2' : 'md:grid-cols-1 max-w-xl';
?>
<section class="tc-pillar-advisory bg-[#63666A] py-24 md:py-32 text-white">
    <div class="max-w-5xl mx-auto px-6">
        <div class="text-center mb-12 md:mb-16 max-w-2xl mx-auto">
            <?php if ($eyebrow): ?><p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p><?php endif; ?>
            <?php if ($heading): ?><h2 class="text-3xl md:text-4xl font-medium text-white"><?php echo esc_html($heading); ?></h2><?php endif; ?>
        </div>
        <div class="grid grid-cols-1 <?php echo esc_attr($cols); ?> gap-12 mx-auto">
            <?php foreach ($items as $item):
                $icon = $item['icon_svg'] ?? '';
                $hl = $item['headline'] ?? '';
                $body = $item['body'] ?? '';
            ?>
                <div class="text-center md:text-left" data-reveal="card">
                    <?php if ($icon): ?>
                        <div class="text-[#FFCD00] mb-4 [&>svg]:w-12 [&>svg]:h-12 [&>svg]:mx-auto md:[&>svg]:mx-0"><?php echo wp_kses_post($icon); ?></div>
                    <?php endif; ?>
                    <?php if ($hl): ?><h3 class="text-2xl font-medium text-white mb-3"><?php echo esc_html($hl); ?></h3><?php endif; ?>
                    <?php if ($body): ?><p class="text-base text-white/85 leading-relaxed"><?php echo esc_html($body); ?></p><?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>