<?php
if (!defined('ABSPATH')) exit;
$image = get_field('subcat_hero_image');
$name = get_field('subcat_name') ?: get_the_title();
$parent = get_field('subcat_parent_ecosystem');

$ecosystem_names = [
    'structure-essentials' => 'Structure Essentials',
    'surfaces-finishes' => 'Surfaces & Finishes',
    'softs-decor' => 'Softs & Decor',
];
$parent_name = $ecosystem_names[$parent] ?? '';
$parent_url = $parent ? home_url('/' . $parent . '/') : '';

$image_url = is_array($image) ? $image['url'] : (is_string($image) ? $image : '');
?>
<section class="tc-subcat-hero relative h-[40vh] md:h-[50vh] w-full overflow-hidden flex items-end"
         <?php if ($image_url): ?>style="background-image:url('<?php echo esc_url($image_url); ?>');background-size:cover;background-position:center;"<?php else: ?>style="background-color:#63666A;"<?php endif; ?>>
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent" aria-hidden="true"></div>
    <?php if ($parent_name): ?>
        <div class="absolute top-6 md:top-8 left-6 md:left-10 z-10 text-white/80 text-sm">
            <a href="<?php echo esc_url($parent_url); ?>" class="hover:text-[#FFCD00] transition-colors"><?php echo esc_html($parent_name); ?></a>
            <span class="mx-2">/</span>
            <span><?php echo esc_html($name); ?></span>
        </div>
    <?php endif; ?>
    <div class="relative z-10 max-w-6xl mx-auto px-6 md:px-10 pb-12 md:pb-16 w-full">
        <h1 class="text-4xl md:text-6xl font-medium text-white"><?php echo esc_html($name); ?></h1>
    </div>
</section>