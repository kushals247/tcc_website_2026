<?php
if (!defined('ABSPATH')) exit;
$eyebrow = get_field('subcat_considerations_eyebrow') ?: 'THINGS TO CONSIDER';
$heading = get_field('subcat_considerations_heading');
$items = get_field('subcat_considerations_items');
if (!$items) return;
$cols = count($items) >= 2 ? 'md:grid-cols-2' : 'md:grid-cols-1 max-w-xl mx-auto';
?>
<section class="tc-subcat-considerations bg-[#63666A] py-20 md:py-24 text-white">
    <div class="max-w-5xl mx-auto px-6">
        <div class="text-center mb-12 md:mb-16 max-w-2xl mx-auto">
            <?php if ($eyebrow): ?>
                <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p>
            <?php endif; ?>
            <?php if ($heading): ?>
                <h2 class="text-3xl md:text-4xl font-medium text-white"><?php echo esc_html($heading); ?></h2>
            <?php endif; ?>
        </div>
        <div class="grid grid-cols-1 <?php echo esc_attr($cols); ?> gap-10 md:gap-12">
            <?php foreach ($items as $item):
                $hl = $item['headline'] ?? '';
                $body = $item['body'] ?? '';
                if (!$hl && !$body) continue;
            ?>
                <div class="text-center md:text-left" data-reveal="card">
                    <?php if ($hl): ?>
                        <h3 class="text-2xl font-medium text-white mb-3"><?php echo esc_html($hl); ?></h3>
                    <?php endif; ?>
                    <?php if ($body): ?>
                        <p class="text-base text-white/85 leading-relaxed"><?php echo esc_html($body); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>