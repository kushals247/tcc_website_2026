<?php
if (!defined('ABSPATH')) exit;

$intro = get_field('insp_intro_body');
$current = sanitize_text_field(wp_unslash($_GET['cat'] ?? ''));

$topic_chips = [
    ['slug' => 'specification', 'label' => 'Specification'],
    ['slug' => 'design', 'label' => 'Design'],
    ['slug' => 'planning', 'label' => 'Planning'],
];
$eco_chips = [
    ['slug' => 'structure-essentials', 'label' => 'Structure'],
    ['slug' => 'surfaces-finishes', 'label' => 'Surfaces & Finishes'],
    ['slug' => 'softs-decor', 'label' => 'Softs & Decor'],
];

$base_class = 'inline-block px-5 py-2 text-sm border border-[#ECECEC] text-[#3A3D40] hover:border-[#FFCD00] transition-colors';
$active_class = 'inline-block px-5 py-2 text-sm border bg-[#FFCD00] border-[#FFCD00] text-[#3A3D40] font-medium';
?>
<section class="tc-insp-filters bg-[#F5F6F7] py-12">
    <div class="max-w-5xl mx-auto px-6">
        <?php if ($intro): ?>
            <div class="text-base text-[#63666A] leading-relaxed text-center mb-8 max-w-3xl mx-auto"><?php echo wp_kses_post($intro); ?></div>
        <?php endif; ?>

        <p class="text-xs tracking-[0.15em] text-[#63666A] text-center mb-3 mt-6 uppercase">BY TOPIC</p>
        <div class="flex flex-wrap gap-2 justify-center mt-4">
            <a href="<?php echo esc_url(get_permalink()); ?>" class="<?php echo esc_attr($current === '' ? $active_class : $base_class); ?>">All</a>
            <?php foreach ($topic_chips as $chip): ?>
                <a href="<?php echo esc_url(add_query_arg('cat', $chip['slug'], get_permalink())); ?>" class="<?php echo esc_attr($current === $chip['slug'] ? $active_class : $base_class); ?>"><?php echo esc_html($chip['label']); ?></a>
            <?php endforeach; ?>
        </div>

        <p class="text-xs tracking-[0.15em] text-[#63666A] text-center mb-3 mt-6 uppercase">BY ECOSYSTEM</p>
        <div class="flex flex-wrap gap-2 justify-center mt-4">
            <?php foreach ($eco_chips as $chip): ?>
                <a href="<?php echo esc_url(add_query_arg('cat', $chip['slug'], get_permalink())); ?>" class="<?php echo esc_attr($current === $chip['slug'] ? $active_class : $base_class); ?>"><?php echo esc_html($chip['label']); ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</section>