<?php
if (!defined('ABSPATH')) exit;

$eyebrow = get_field('about_sisters_eyebrow');
$heading = get_field('about_sisters_heading');
$items = get_field('about_sisters_items');

if (!$items) return;
?>
<section class="tc-about-sisters bg-[#63666A] py-20 md:py-24">
    <div class="text-center max-w-3xl mx-auto px-6">
        <?php if ($eyebrow): ?>
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($heading): ?>
            <h2 class="text-3xl md:text-4xl font-medium text-white"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-5xl mx-auto px-6 mt-12">
        <?php foreach ($items as $item):
            $name = $item['name'] ?? '';
            $desc = $item['description'] ?? '';
            $url = $item['url'] ?? '';
        ?>
            <div class="bg-black/20 p-6 text-center md:text-left" data-reveal="card">
                <?php if ($name): ?><h3 class="text-lg font-medium text-white mb-3"><?php echo esc_html($name); ?></h3><?php endif; ?>
                <?php if ($desc): ?><p class="text-sm text-white/85 leading-relaxed mb-3"><?php echo esc_html($desc); ?></p><?php endif; ?>
                <?php if ($url): ?>
                    <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener" class="text-xs tracking-[0.15em] uppercase text-[#FFCD00] border-b border-[#FFCD00] inline-block">Visit &rarr;</a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>