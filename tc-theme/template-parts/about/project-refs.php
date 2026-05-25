<?php
if (!defined('ABSPATH')) exit;

$eyebrow = get_field('about_projects_eyebrow');
$heading = get_field('about_projects_heading');
$intro = get_field('about_projects_intro');
$items = get_field('about_projects_items');

if (!$items) return;
?>
<section class="tc-about-projects bg-white py-20 md:py-24">
    <div class="text-center max-w-3xl mx-auto px-6">
        <?php if ($eyebrow): ?>
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($heading): ?>
            <h2 class="text-3xl md:text-4xl font-medium text-[#3A3D40] mb-4"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($intro): ?>
            <p class="text-base text-[#63666A] leading-relaxed"><?php echo esc_html($intro); ?></p>
        <?php endif; ?>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3.5 max-w-6xl mx-auto px-6 mt-12">
        <?php foreach ($items as $item):
            $img = $item['image'] ?? null;
            $img_url = is_array($img) ? ($img['url'] ?? '') : (is_string($img) ? $img : '');
            $img_alt = is_array($img) && !empty($img['alt']) ? $img['alt'] : ($item['name'] ?? '');
            $project_type = $item['project_type'] ?? '';
            $name = $item['name'] ?? '';
            $location = $item['location'] ?? '';
            $notes = $item['notes'] ?? '';
        ?>
            <div class="bg-white border border-[#ECECEC] hover:border-[#FFCD00] transition-all duration-300" data-reveal="card">
                <?php if ($img_url): ?>
                    <div class="aspect-[4/3] overflow-hidden bg-[#F5F6F7]">
                        <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" class="w-full h-full object-cover" loading="lazy">
                    </div>
                <?php endif; ?>
                <div class="p-6">
                    <?php if ($project_type): ?><p class="text-xs tracking-[0.15em] uppercase text-[#FFCD00] mb-2"><?php echo esc_html($project_type); ?></p><?php endif; ?>
                    <?php if ($name): ?><h3 class="text-lg font-medium text-[#3A3D40] mb-1"><?php echo esc_html($name); ?></h3><?php endif; ?>
                    <?php if ($location): ?><p class="text-sm text-[#63666A] mb-3"><?php echo esc_html($location); ?></p><?php endif; ?>
                    <?php if ($notes): ?><p class="text-sm text-[#63666A] leading-relaxed"><?php echo esc_html($notes); ?></p><?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>