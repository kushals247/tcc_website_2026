<?php
if (!defined('ABSPATH')) exit;

$intro = get_field('brands_intro_body');

$current_eco = sanitize_text_field(wp_unslash($_GET['ecosystem'] ?? ''));
$current_letter = strtoupper(sanitize_text_field(wp_unslash($_GET['letter'] ?? '')));
$current_inhouse = !empty($_GET['inhouse']);

$base_url = get_permalink();

$eco_chips = [
    ['slug' => 'structure-essentials', 'label' => 'Structure'],
    ['slug' => 'surfaces-finishes', 'label' => 'Surfaces & Finishes'],
    ['slug' => 'softs-decor', 'label' => 'Softs & Decor'],
];

$base_class = 'inline-block px-4 py-2 text-sm border border-[#ECECEC] text-[#3A3D40] hover:border-[#FFCD00] transition-colors';
$active_class = 'inline-block px-4 py-2 text-sm border bg-[#FFCD00] border-[#FFCD00] text-[#3A3D40] font-medium';

// Helper to build filter URL preserving other params
$build_url = function($key, $value) use ($base_url) {
    if ($value === null || $value === '') {
        return remove_query_arg($key, add_query_arg(array_filter($_GET, fn($k) => $k !== 'paged', ARRAY_FILTER_USE_KEY), $base_url));
    }
    $params = array_filter($_GET, fn($k) => $k !== 'paged', ARRAY_FILTER_USE_KEY);
    $params[$key] = $value;
    return add_query_arg($params, $base_url);
};
?>
<section class="tc-brands-filters bg-[#F5F6F7] py-12">
    <div class="max-w-5xl mx-auto px-6">
        <?php if ($intro): ?>
            <div class="text-base text-[#63666A] leading-relaxed text-center mb-8 max-w-3xl mx-auto"><?php echo wp_kses_post($intro); ?></div>
        <?php endif; ?>

        <p class="text-xs tracking-[0.15em] uppercase text-[#63666A] text-center mb-3 mt-6">BY ECOSYSTEM</p>
        <div class="flex flex-wrap gap-2 justify-center mt-4">
            <a href="<?php echo esc_url($build_url('ecosystem', null)); ?>" class="<?php echo esc_attr($current_eco === '' ? $active_class : $base_class); ?>">All</a>
            <?php foreach ($eco_chips as $chip): ?>
                <a href="<?php echo esc_url($build_url('ecosystem', $chip['slug'])); ?>" class="<?php echo esc_attr($current_eco === $chip['slug'] ? $active_class : $base_class); ?>"><?php echo esc_html($chip['label']); ?></a>
            <?php endforeach; ?>
        </div>

        <p class="text-xs tracking-[0.15em] uppercase text-[#63666A] text-center mb-3 mt-6">BY LETTER</p>
        <div class="flex flex-wrap gap-2 justify-center mt-4">
            <a href="<?php echo esc_url($build_url('letter', null)); ?>" class="<?php echo esc_attr($current_letter === '' ? $active_class : $base_class); ?>">All</a>
            <?php foreach (range('A', 'Z') as $letter): ?>
                <a href="<?php echo esc_url($build_url('letter', $letter)); ?>" class="<?php echo esc_attr($current_letter === $letter ? $active_class : $base_class); ?>"><?php echo esc_html($letter); ?></a>
            <?php endforeach; ?>
        </div>

        <p class="text-xs tracking-[0.15em] uppercase text-[#63666A] text-center mb-3 mt-6">FILTER</p>
        <div class="flex flex-wrap gap-2 justify-center mt-4">
            <a href="<?php echo esc_url($build_url('inhouse', $current_inhouse ? null : '1')); ?>" class="<?php echo esc_attr($current_inhouse ? $active_class : $base_class); ?>">T&amp;C Original</a>
            <?php if ($current_inhouse): ?>
                <a href="<?php echo esc_url($build_url('inhouse', null)); ?>" class="<?php echo esc_attr($base_class); ?>">All brands</a>
            <?php endif; ?>
        </div>
    </div>
</section>