<?php
if (!defined('ABSPATH')) exit;

$current_cat = sanitize_text_field(wp_unslash($_GET['cat'] ?? ''));
$paged = max(1, (int) get_query_var('paged', 1));
if ($paged < 2) {
    $paged = max(1, (int) ($_GET['paged'] ?? 1));
}
$per_page = (int) (get_field('insp_pagination_per_page') ?: 9);

$args = [
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => $per_page,
    'paged' => $paged,
];
if ($current_cat) {
    $args['category_name'] = $current_cat;
} else {
    $featured = get_posts(['post_type' => 'post', 'posts_per_page' => 1, 'fields' => 'ids']);
    if (!empty($featured)) $args['post__not_in'] = $featured;
}

$query = new WP_Query($args);

$cat_label = '';
if ($current_cat) {
    $term = get_category_by_slug($current_cat);
    if ($term) $cat_label = $term->name;
}
?>
<section class="tc-insp-grid bg-white py-16 md:py-20">
    <div class="max-w-6xl mx-auto px-6">
        <?php if (!$query->have_posts()): ?>
            <p class="text-[#63666A] text-center py-12">No articles in this category yet. Check back soon.</p>
        <?php else: ?>
            <?php if ($current_cat && $cat_label): ?>
                <div class="text-center mb-10">
                    <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-2">BROWSING: <?php echo esc_html(strtoupper($cat_label)); ?></p>
                    <p class="text-sm text-[#63666A]">Showing <?php echo esc_html(min($per_page, (int) $query->post_count)); ?> of <?php echo esc_html((int) $query->found_posts); ?> results</p>
                </div>
            <?php endif; ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3.5">
                <?php while ($query->have_posts()): $query->the_post();
                    $hero = get_field('article_hero_image');
                    $hero_url = is_array($hero) ? ($hero['url'] ?? '') : (is_string($hero) ? $hero : '');
                    if (!$hero_url) $hero_url = get_the_post_thumbnail_url(get_post(), 'medium_large');
                    if (!$hero_url) $hero_url = 'https://placehold.co/800x533/F5F6F7/63666A?text=' . rawurlencode(get_the_title()) . '&font=montserrat';
                    $cats = get_the_category();
                    $cat_name = '';
                    foreach ($cats as $c) { if ($c->slug !== 'uncategorized') { $cat_name = $c->name; break; } }
                ?>
                    <a href="<?php the_permalink(); ?>" class="group block bg-white border border-[#ECECEC] hover:border-[#FFCD00] transition-all duration-300 hover:-translate-y-0.5" data-reveal="card">
                        <div class="aspect-[3/2] overflow-hidden bg-[#F5F6F7]">
                            <img src="<?php echo esc_url($hero_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500" loading="lazy">
                        </div>
                        <div class="p-6">
                            <?php if ($cat_name): ?>
                                <p class="text-xs tracking-[0.15em] uppercase text-[#FFCD00] mb-2"><?php echo esc_html($cat_name); ?></p>
                            <?php endif; ?>
                            <h3 class="text-lg font-medium text-[#3A3D40] mb-2 leading-snug"><?php the_title(); ?></h3>
                            <p class="text-sm text-[#63666A] leading-relaxed mb-3"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>
                            <p class="text-xs text-[#63666A]"><?php echo esc_html(get_the_date()); ?></p>
                        </div>
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
                <nav class="tc-insp-pagination mt-12 flex justify-center" aria-label="Pagination"><?php echo $paginate; ?></nav>
            <?php endif; endif; ?>
        <?php endif; ?>
    </div>
</section>
<style>
.tc-insp-pagination ul { display: flex; flex-wrap: wrap; gap: 0.5rem; list-style: none; padding: 0; margin: 0; justify-content: center; }
.tc-insp-pagination ul li a, .tc-insp-pagination ul li span { display: inline-block; padding: 0.5rem 1rem; border: 1px solid #ECECEC; color: #3A3D40; text-decoration: none; font-size: 0.875rem; transition: border-color 0.2s; }
.tc-insp-pagination ul li a:hover { border-color: #FFCD00; }
.tc-insp-pagination ul li span.current { background: #FFCD00; border-color: #FFCD00; color: #3A3D40; font-weight: 500; }
.tc-insp-pagination ul li span.dots { border-color: transparent; }
</style>
<?php wp_reset_postdata(); ?>