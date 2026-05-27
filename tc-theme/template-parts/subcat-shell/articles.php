<?php
if (!defined('ABSPATH')) exit;
$eyebrow = get_field('subcat_articles_eyebrow') ?: 'READ MORE';
$heading = get_field('subcat_articles_heading') ?: 'Related guides and stories';
$ecosystem = get_field('subcat_parent_ecosystem');

$posts = $ecosystem ? get_posts([
    'post_type' => 'post',
    'posts_per_page' => 3,
    'category_name' => $ecosystem,
]) : [];

if (empty($posts)) return;
?>
<section class="tc-subcat-articles bg-white py-20 md:py-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12">
            <?php if ($eyebrow): ?>
                <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p>
            <?php endif; ?>
            <?php if ($heading): ?>
                <h3 class="text-2xl md:text-3xl font-medium text-[#3A3D40]"><?php echo esc_html($heading); ?></h3>
            <?php endif; ?>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3.5">
            <?php foreach ($posts as $post): setup_postdata($post);
                $thumb = get_the_post_thumbnail_url($post, 'medium_large');
                $cats = get_the_category($post->ID);
                $cat_label = !empty($cats) ? $cats[0]->name : '';
            ?>
                <a href="<?php echo esc_url(get_permalink($post)); ?>" class="group block bg-white border border-[#ECECEC] hover:border-[#FFCD00] transition-all duration-300 hover:-translate-y-0.5" data-reveal="card">
                    <?php if ($thumb): ?>
                        <div class="aspect-[4/3] overflow-hidden bg-[#F5F6F7]">
                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title($post)); ?>" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500" loading="lazy">
                        </div>
                    <?php endif; ?>
                    <div class="p-6">
                        <?php if ($cat_label): ?>
                            <p class="text-xs tracking-[0.15em] uppercase text-[#FFCD00] mb-2"><?php echo esc_html($cat_label); ?></p>
                        <?php endif; ?>
                        <h4 class="text-lg font-medium text-[#3A3D40] mb-2"><?php echo esc_html(get_the_title($post)); ?></h4>
                        <p class="text-sm text-[#63666A] leading-relaxed mb-3"><?php echo esc_html(wp_trim_words(get_the_excerpt($post), 20)); ?></p>
                        <p class="text-xs text-[#63666A]/70"><?php echo esc_html(get_the_date('', $post)); ?></p>
                    </div>
                </a>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
    </div>
</section>