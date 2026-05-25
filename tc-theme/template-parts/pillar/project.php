<?php
if (!defined('ABSPATH')) exit;
$image = get_field('pillar_project_image');
$name = get_field('pillar_project_name');
$type = get_field('pillar_project_type');
$location = get_field('pillar_project_location');
$writeup = get_field('pillar_project_writeup');
$link = get_field('pillar_project_link');

if (!$image) return;
$image_url = is_array($image) ? $image['url'] : (is_string($image) ? $image : '');
$image_alt = is_array($image) && !empty($image['alt']) ? $image['alt'] : ($name ?: '');
?>
<section class="tc-pillar-project bg-white">
    <div class="grid grid-cols-1 md:grid-cols-2 items-stretch">
        <div class="bg-[#F5F6F7] min-h-[400px] md:min-h-[600px]">
            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="w-full h-full object-cover" loading="lazy">
        </div>
        <div class="bg-white p-10 md:p-16 lg:p-20 flex flex-col justify-center">
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4">FEATURED PROJECT</p>
            <?php if ($name): ?><h3 class="text-2xl md:text-3xl font-medium text-[#3A3D40] mb-3"><?php echo esc_html($name); ?></h3><?php endif; ?>
            <?php if ($type || $location):
                $meta = trim(implode(' · ', array_filter([$type, $location]))); ?>
                <p class="text-sm text-[#63666A] mb-6"><?php echo esc_html($meta); ?></p>
            <?php endif; ?>
            <?php if ($writeup): ?><p class="text-base text-[#63666A] leading-relaxed mb-6"><?php echo esc_html($writeup); ?></p><?php endif; ?>
            <?php if (is_array($link) && !empty($link['url'])): ?>
                <a href="<?php echo esc_url($link['url']); ?>" class="text-[#FFCD00] border-b border-[#FFCD00] inline-block self-start hover:translate-x-1 transition-transform"><?php echo esc_html($link['title'] ?: 'View project'); ?> &rarr;</a>
            <?php endif; ?>
        </div>
    </div>
</section>