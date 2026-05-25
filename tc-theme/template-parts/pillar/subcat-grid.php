<?php
if (!defined('ABSPATH')) exit;
$eyebrow = get_field('pillar_subcat_eyebrow') ?: 'EXPLORE';
$heading = get_field('pillar_subcat_heading');
$intro = get_field('pillar_subcat_intro');
$items = get_field('pillar_subcat_items');
if (!$items) return;
?>
<section class="tc-pillar-subcat-grid bg-white py-20 md:py-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12 md:mb-16 max-w-2xl mx-auto">
            <?php if ($eyebrow): ?><p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p><?php endif; ?>
            <?php if ($heading): ?><h2 class="text-3xl md:text-4xl font-medium text-[#3A3D40] mb-4"><?php echo esc_html($heading); ?></h2><?php endif; ?>
            <?php if ($intro): ?><p class="text-base text-[#63666A] leading-relaxed"><?php echo esc_html($intro); ?></p><?php endif; ?>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3.5">
            <?php foreach ($items as $item):
                $img = $item['image'];
                $img_url = is_array($img) ? $img['url'] : (is_string($img) ? $img : '');
                $img_alt = is_array($img) && !empty($img['alt']) ? $img['alt'] : ($item['name'] ?? '');
                $name = $item['name'] ?? '';
                $desc = $item['description'] ?? '';
                $link = $item['link_url'] ?? '';
            ?>
                <a href="<?php echo esc_url($link ?: '#'); ?>" class="group block bg-white border border-[#ECECEC] hover:border-[#FFCD00] transition-all duration-300 hover:-translate-y-0.5" data-reveal="card">
                    <?php if ($img_url): ?>
                        <div class="aspect-[3/2] overflow-hidden bg-[#F5F6F7]">
                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500" loading="lazy">
                        </div>
                    <?php endif; ?>
                    <div class="p-6">
                        <?php if ($name): ?><h3 class="text-xl font-medium text-[#3A3D40] mb-2"><?php echo esc_html($name); ?></h3><?php endif; ?>
                        <?php if ($desc): ?><p class="text-sm text-[#63666A] leading-relaxed mb-3"><?php echo esc_html($desc); ?></p><?php endif; ?>
                        <span class="text-sm text-[#FFCD00] inline-block border-b border-[#FFCD00] group-hover:translate-x-1 transition-transform">Explore &rarr;</span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>