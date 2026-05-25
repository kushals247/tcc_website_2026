<?php
if (!defined('ABSPATH')) exit;
$eyebrow = get_field('pillar_articles_eyebrow') ?: 'READ MORE';
$heading = get_field('pillar_articles_heading');
$fallback = get_field('pillar_articles_fallback');
$ecosystem = get_field('pillar_ecosystem_slug');

$posts = $ecosystem ? get_posts([
    'post_type' => 'post',
    'posts_per_page' => 3,
    'category_name' => $ecosystem,
]) : [];

$use_fallback = count($posts) === 0;
?>
<section class="tc-pillar-articles bg-white py-20 md:py-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12">
            <?php if ($eyebrow): ?><p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p><?php endif; ?>
            <?php if ($heading): ?><h3 class="text-2xl md:text-3xl font-medium text-[#3A3D40]"><?php echo esc_html($heading); ?></h3><?php endif; ?>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3.5">
        <?php if ($use_fallback && $fallback): ?>
            <?php foreach ($fallback as $card):
                $img = $card['image']; $img_url = is_array($img) ? $img['url'] : '';
                $cat = $card['category'] ?? ''; $title = $card['title'] ?? '';
                $excerpt = $card['excerpt'] ?? ''; $link = $card['link_url'] ?? '#';
            ?>
                <a href="<?php echo esc_url($link); ?>" class="group block bg-white border border-[#ECECEC] hover:border-[#FFCD00] transition-all duration-300 hover:-translate-y-0.5" data-reveal="card">
                    <?php if ($img_url): ?><div class="aspect-[3/2] overflow-hidden bg-[#F5F6F7]"><img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500" loading="lazy"></div><?php endif; ?>
                    <div class="p-6">
                        <?php if ($cat): ?><p class="text-xs tracking-[0.15em] uppercase text-[#FFCD00] mb-2"><?php echo esc_html($cat); ?></p><?php endif; ?>
                        <?php if ($title): ?><h4 class="text-lg font-medium text-[#3A3D40] mb-2"><?php echo esc_html($title); ?></h4><?php endif; ?>
                        <?php if ($excerpt): ?><p class="text-sm text-[#63666A] leading-relaxed"><?php echo esc_html($excerpt); ?></p><?php endif; ?>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <?php foreach ($posts as $post): setup_postdata($post);
                $thumb = get_the_post_thumbnail_url($post, 'medium_large');
            ?>
                <a href="<?php echo esc_url(get_permalink($post)); ?>" class="group block bg-white border border-[#ECECEC] hover:border-[#FFCD00] transition-all duration-300 hover:-translate-y-0.5" data-reveal="card">
                    <?php if ($thumb): ?><div class="aspect-[3/2] overflow-hidden bg-[#F5F6F7]"><img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title($post)); ?>" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500" loading="lazy"></div><?php endif; ?>
                    <div class="p-6">
                        <p class="text-xs tracking-[0.15em] uppercase text-[#FFCD00] mb-2"><?php echo esc_html(get_the_date('', $post)); ?></p>
                        <h4 class="text-lg font-medium text-[#3A3D40] mb-2"><?php echo esc_html(get_the_title($post)); ?></h4>
                        <p class="text-sm text-[#63666A] leading-relaxed"><?php echo esc_html(wp_trim_words(get_the_excerpt($post), 20)); ?></p>
                    </div>
                </a>
            <?php endforeach; wp_reset_postdata(); ?>
        <?php endif; ?>
        </div>
        <div class="text-center mt-10">
            <a href="<?php echo esc_url(home_url('/inspiration/')); ?>" class="text-sm text-[#FFCD00] border-b border-[#FFCD00] hover:translate-x-1 inline-block transition-transform">Visit our advice hub &rarr;</a>
        </div>
    </div>
</section>