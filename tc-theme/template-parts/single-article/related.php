<?php
if (!defined('ABSPATH')) exit;

$current_id = get_the_ID();
$eco_slugs = ['structure-essentials', 'surfaces-finishes', 'softs-decor'];
$primary_eco_slug = '';
foreach (get_the_category() as $c) {
    if (in_array($c->slug, $eco_slugs, true)) { $primary_eco_slug = $c->slug; break; }
}

$collected = [];
$collected_ids = [$current_id];

if ($primary_eco_slug) {
    $related = new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => 3,
        'category_name' => $primary_eco_slug,
        'post__not_in' => [$current_id],
        'post_status' => 'publish',
    ]);
    if ($related->have_posts()) {
        while ($related->have_posts()) {
            $related->the_post();
            $collected[] = get_post();
            $collected_ids[] = get_the_ID();
        }
    }
    wp_reset_postdata();
}

if (count($collected) < 3) {
    $needed = 3 - count($collected);
    $supplement = new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => $needed,
        'post__not_in' => $collected_ids,
        'post_status' => 'publish',
    ]);
    if ($supplement->have_posts()) {
        while ($supplement->have_posts()) {
            $supplement->the_post();
            $collected[] = get_post();
        }
    }
    wp_reset_postdata();
}

if (empty($collected)) return;
?>
<section class="tc-single-article-related bg-[#F5F6F7] py-16 md:py-20">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-2xl md:text-3xl font-medium text-[#3A3D40] mb-8 text-center">Related articles</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3.5">
            <?php foreach ($collected as $p):
                $hero = get_field('article_hero_image', $p->ID);
                $hero_url = is_array($hero) ? ($hero['url'] ?? '') : (is_string($hero) ? $hero : '');
                if (!$hero_url) $hero_url = get_the_post_thumbnail_url($p, 'medium_large');
                if (!$hero_url) $hero_url = 'https://placehold.co/800x533/F5F6F7/63666A?text=' . rawurlencode(get_the_title($p)) . '&font=montserrat';
                $cats = get_the_category($p->ID);
                $cat_name = '';
                foreach ($cats as $c) { if ($c->slug !== 'uncategorized') { $cat_name = $c->name; break; } }
                $excerpt_obj = has_excerpt($p) ? $p->post_excerpt : wp_trim_words(strip_tags($p->post_content), 20);
            ?>
                <a href="<?php echo esc_url(get_permalink($p)); ?>" class="group block bg-white border border-[#ECECEC] hover:border-[#FFCD00] transition-all duration-300 hover:-translate-y-0.5" data-reveal="card">
                    <div class="aspect-[3/2] overflow-hidden bg-[#F5F6F7]">
                        <img src="<?php echo esc_url($hero_url); ?>" alt="<?php echo esc_attr(get_the_title($p)); ?>" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500" loading="lazy">
                    </div>
                    <div class="p-6">
                        <?php if ($cat_name): ?>
                            <p class="text-xs tracking-[0.15em] uppercase text-[#FFCD00] mb-2"><?php echo esc_html($cat_name); ?></p>
                        <?php endif; ?>
                        <h3 class="text-lg font-medium text-[#3A3D40] mb-2 leading-snug"><?php echo esc_html(get_the_title($p)); ?></h3>
                        <p class="text-sm text-[#63666A] leading-relaxed mb-3"><?php echo esc_html(wp_trim_words($excerpt_obj, 20)); ?></p>
                        <p class="text-xs text-[#63666A]"><?php echo esc_html(get_the_date('', $p)); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php wp_reset_postdata(); ?>