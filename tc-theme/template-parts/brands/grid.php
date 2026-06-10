<?php
if (!defined('ABSPATH')) exit;

$current_eco = sanitize_text_field(wp_unslash($_GET['ecosystem'] ?? ''));
$current_letter = strtoupper(sanitize_text_field(wp_unslash($_GET['letter'] ?? '')));
$current_inhouse = !empty($_GET['inhouse']);
$paged = max(1, (int) get_query_var('paged', 1));
if ($paged < 2) {
    $paged = max(1, (int) ($_GET['paged'] ?? 1));
}

$args = [
    'post_type' => 'brand',
    'post_status' => 'publish',
    'posts_per_page' => 24,
    'paged' => $paged,
    'orderby' => 'title',
    'order' => 'ASC',
];

$meta_query = [];
if ($current_eco) {
    $meta_query[] = [
        'key' => 'brand_ecosystems',
        'value' => '"' . $current_eco . '"',
        'compare' => 'LIKE',
    ];
}
if ($current_inhouse) {
    $meta_query[] = [
        'key' => 'brand_is_inhouse',
        'value' => '1',
    ];
}
if (count($meta_query) > 0) {
    $args['meta_query'] = $meta_query;
}

$title_filter = null;
if ($current_letter && preg_match('/^[A-Z]$/', $current_letter)) {
    $title_filter = function($where) use ($current_letter) {
        global $wpdb;
        return $where . $wpdb->prepare(" AND {$wpdb->posts}.post_title LIKE %s", $current_letter . '%');
    };
    add_filter('posts_where', $title_filter);
}

$query = new WP_Query($args);

if ($title_filter) {
    remove_filter('posts_where', $title_filter);
}

$eco_short = [
    'structure-essentials' => 'Structure',
    'surfaces-finishes' => 'Surfaces',
    'softs-decor' => 'Softs',
];

$active_filters = [];
if ($current_eco && isset($eco_short[$current_eco])) $active_filters[] = $eco_short[$current_eco];
if ($current_letter) $active_filters[] = 'Letter "' . $current_letter . '"';
if ($current_inhouse) $active_filters[] = 'T&C Original';

$base_url = get_permalink();
$clear_url = $base_url;
?>
<section class="tc-brands-grid bg-white py-16 md:py-20">
    <div class="max-w-5xl mx-auto px-6">
        <?php if (!$query->have_posts()): ?>
            <p class="text-[#63666A] text-center py-12">No brands match these filters.</p>
            <p class="text-center"><a href="<?php echo esc_url($clear_url); ?>" class="text-[#FFCD00] border-b border-[#FFCD00] hover:opacity-70 transition-opacity">Clear filters</a></p>
        <?php else: ?>
            <?php if (!empty($active_filters)): ?>
                <div class="text-center mb-10">
                    <p class="text-sm text-[#63666A]">Showing <?php echo esc_html(min(24, (int) $query->post_count)); ?> of <?php echo esc_html((int) $query->found_posts); ?> brands matching: <strong class="text-[#3A3D40]"><?php echo esc_html(implode(', ', $active_filters)); ?></strong></p>
                </div>
            <?php endif; ?>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3.5">
                <?php while ($query->have_posts()): $query->the_post();
                    $logo = get_field('brand_logo');
                    $logo_url = is_array($logo) ? ($logo['url'] ?? '') : (is_string($logo) ? $logo : '');
                    $country = get_field('brand_country');
                    $is_inhouse = get_field('brand_is_inhouse');
                    $ecos = get_field('brand_ecosystems');
                    $title = get_the_title();
                    $first_letter = strtoupper(mb_substr($title, 0, 1));
                ?>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="group relative block bg-white border border-[#ECECEC] hover:border-[#FFCD00] p-6 transition-all duration-300 hover:-translate-y-0.5" data-reveal="card">
                        <?php if ($is_inhouse): ?>
                            <img src="<?php echo esc_url(tc_original_asset('tag', 'white')); ?>" alt="T&amp;C Original Product" class="absolute top-2 right-2 h-4 w-auto" loading="lazy">
                        <?php endif; ?>
                        <div class="h-20 flex items-center justify-center bg-[#F5F6F7] px-6 py-3">
                            <?php if ($logo_url): ?>
                                <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($title); ?> logo" class="max-h-12 max-w-full w-auto object-contain" loading="lazy">
                            <?php else: ?>
                                <span class="inline-flex items-center justify-center w-14 h-14 bg-[#FFCD00] rounded-full text-2xl font-medium text-[#3A3D40]"><?php echo esc_html($first_letter); ?></span>
                            <?php endif; ?>
                        </div>
                        <h3 class="text-base font-medium text-[#3A3D40] text-center mt-4"><?php echo esc_html($title); ?></h3>
                        <?php if ($country): ?>
                            <p class="text-xs text-[#63666A] text-center mt-1"><?php echo esc_html($country); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($ecos) && is_array($ecos)): ?>
                            <div class="flex flex-wrap gap-1 justify-center mt-3">
                                <?php foreach ($ecos as $eco_slug): if (!isset($eco_short[$eco_slug])) continue; ?>
                                    <span class="text-[10px] px-2 py-0.5 border border-[#ECECEC] text-[#63666A]"><?php echo esc_html($eco_short[$eco_slug]); ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </a>
                <?php endwhile; ?>
            </div>
            <?php if ($query->max_num_pages > 1):
                $paginate = paginate_links([
                    'total' => $query->max_num_pages,
                    'current' => $paged,
                    'prev_text' => '&larr; Previous',
                    'next_text' => 'Next &rarr;',
                    'type' => 'list',
                ]);
                if ($paginate):
            ?>
                <nav class="tc-brands-pagination mt-12 flex justify-center" aria-label="Pagination"><?php echo $paginate; ?></nav>
            <?php endif; endif; ?>
        <?php endif; ?>
    </div>
</section>
<style>
.tc-brands-pagination ul { display: flex; flex-wrap: wrap; gap: 0.5rem; list-style: none; padding: 0; margin: 0; justify-content: center; }
.tc-brands-pagination ul li a, .tc-brands-pagination ul li span { display: inline-block; padding: 0.5rem 1rem; border: 1px solid #ECECEC; color: #3A3D40; text-decoration: none; font-size: 0.875rem; transition: border-color 0.2s; }
.tc-brands-pagination ul li a:hover { border-color: #FFCD00; }
.tc-brands-pagination ul li span.current { background: #FFCD00; border-color: #FFCD00; color: #3A3D40; font-weight: 500; }
.tc-brands-pagination ul li span.dots { border-color: transparent; }
</style>
<?php wp_reset_postdata(); ?>