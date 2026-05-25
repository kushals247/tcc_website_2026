<?php
if (!defined('ABSPATH')) exit;

if (!empty($_GET['cat'])) return;

$query = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 1,
    'post_status' => 'publish',
]);

if (!$query->have_posts()) {
    wp_reset_postdata();
    return;
}

$query->the_post();
$post_obj = get_post();

$hero = get_field('article_hero_image');
$hero_url = is_array($hero) ? ($hero['url'] ?? '') : (is_string($hero) ? $hero : '');
if (!$hero_url) $hero_url = get_the_post_thumbnail_url($post_obj, 'large');
if (!$hero_url) $hero_url = 'https://placehold.co/1200x800/F5F6F7/63666A?text=' . rawurlencode(get_the_title()) . '&font=montserrat';

$cats = get_the_category();
$cat_name = '';
foreach ($cats as $c) {
    if ($c->slug !== 'uncategorized') { $cat_name = $c->name; break; }
}

$subtitle = get_field('article_subtitle');
$excerpt_source = $subtitle ?: get_the_excerpt();
$excerpt = wp_trim_words($excerpt_source, 30);

$read_time = (int) get_field('article_read_time');
if (!$read_time) {
    $word_count = str_word_count(strip_tags($post_obj->post_content));
    $read_time = max(1, (int) ceil($word_count / 200));
}
?>
<section class="tc-insp-featured bg-white py-16 md:py-20">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-0 items-stretch" data-reveal="card">
            <div class="min-h-[400px] bg-[#F5F6F7] bg-cover bg-center" style="background-image:url('<?php echo esc_url($hero_url); ?>');" role="img" aria-label="<?php echo esc_attr(get_the_title()); ?>"></div>
            <div class="bg-white p-10 md:p-16 lg:p-20 flex flex-col justify-center">
                <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-3">FEATURED<?php if ($cat_name): ?> &middot; <?php echo esc_html($cat_name); ?><?php endif; ?></p>
                <h2 class="text-3xl md:text-4xl font-medium text-[#3A3D40] mb-4 leading-tight"><?php the_title(); ?></h2>
                <?php if ($excerpt): ?>
                    <p class="text-base text-[#63666A] leading-relaxed mb-6"><?php echo esc_html($excerpt); ?></p>
                <?php endif; ?>
                <p class="text-xs text-[#63666A] mb-6 tracking-wide"><?php echo esc_html(get_the_date()); ?> &middot; <?php echo esc_html($read_time); ?> min read</p>
                <a href="<?php echo esc_url(get_permalink()); ?>" class="text-[#FFCD00] border-b border-[#FFCD00] inline-block self-start hover:translate-x-1 transition-transform">Read more &rarr;</a>
            </div>
        </div>
    </div>
</section>
<?php wp_reset_postdata(); ?>