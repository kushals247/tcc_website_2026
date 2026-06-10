<?php
/**
 * Sub-cat shell > products.
 * Custom WP_Query grid that auto-matches the current page slug to a product_cat term.
 * Renders product cards in the IA visual style (white card, border, hover-lift, yellow accent).
 * Manual override: set the ACF subcat_products_shortcode to inject a custom shortcode.
 */
if (!defined('ABSPATH')) exit;

$override_shortcode = get_field('subcat_products_shortcode');
$name = get_field('subcat_name') ?: get_the_title();

$wa_raw = function_exists('get_field') ? get_field('nav_whatsapp_number', 'options') : '';
$wa_digits = $wa_raw ? preg_replace('/\D+/', '', $wa_raw) : '';

// Resolve page slug — maps to a product_cat term of the same slug.
$post_id = get_queried_object_id();
$page_slug = $post_id ? get_post_field('post_name', $post_id) : '';
$cat_term = $page_slug ? get_term_by('slug', $page_slug, 'product_cat') : null;

$products_query = null;
$has_products = false;
if ($cat_term && !is_wp_error($cat_term)) {
    $paged = max(1, (int) get_query_var('paged', 1));
    if ($paged < 2) $paged = max(1, (int) ($_GET['paged'] ?? 1));
    $products_query = new WP_Query([
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 24,
        'paged' => $paged,
        'orderby' => 'menu_order title',
        'order' => 'ASC',
        'tax_query' => [[
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $cat_term->term_id,
            'include_children' => true,
        ]],
    ]);
    $has_products = $products_query->have_posts();
}
?>
<section class="tc-subcat-products bg-[#F5F6F7] py-20 md:py-24">
    <div class="max-w-5xl mx-auto px-6">
        <h2 class="text-2xl md:text-3xl font-medium text-[#3A3D40] mb-8 text-center">Browse <?php echo esc_html($name); ?></h2>

        <?php if (!empty(trim((string) $override_shortcode))): ?>
            <div class="tc-subcat-products-wrapper"><?php echo do_shortcode($override_shortcode); ?></div>

        <?php elseif ($has_products && $products_query): ?>
            <?php if ($cat_term && $products_query->found_posts > 0): ?>
                <p class="text-sm text-[#63666A] text-center mb-8">Showing <?php echo esc_html(min(24, (int) $products_query->post_count)); ?> of <?php echo esc_html((int) $products_query->found_posts); ?> products</p>
            <?php endif; ?>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3.5">
                <?php while ($products_query->have_posts()): $products_query->the_post();
                    global $product; if (!$product) { $product = wc_get_product(get_the_ID()); }
                    if (!$product) continue;
                    $price_html = $product->get_price_html();
                    $is_in_stock = $product->is_in_stock();
                ?>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="group block bg-white border border-[#ECECEC] hover:border-[#FFCD00] transition-all duration-300 hover:-translate-y-0.5" data-reveal="card">
                        <div class="aspect-square overflow-hidden bg-[#F5F6F7] relative">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500', 'loading' => 'lazy']); ?>
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center"><i class="ti ti-photo" style="font-size:48px; color:#C0C0C0;" aria-hidden="true"></i></div>
                            <?php endif; ?>
                            <?php if (!$is_in_stock): ?>
                                <span class="absolute top-2 left-2 bg-[#63666A] text-white text-[10px] tracking-[0.1em] uppercase px-2 py-1">Out of stock</span>
                            <?php endif; ?>
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm md:text-base font-medium text-[#3A3D40] mb-2 leading-tight line-clamp-2"><?php the_title(); ?></h3>
                            <?php if ($price_html): ?>
                                <div class="text-sm text-[#63666A]"><?php echo $price_html; ?></div>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

            <?php if ($products_query->max_num_pages > 1):
                $paginate = paginate_links([
                    'total' => $products_query->max_num_pages,
                    'current' => $paged,
                    'prev_text' => '&larr; Previous',
                    'next_text' => 'Next &rarr;',
                    'type' => 'list',
                ]);
                if ($paginate):
            ?>
                <nav class="tc-products-pagination mt-12 flex justify-center" aria-label="Pagination"><?php echo $paginate; ?></nav>
            <?php endif; endif; ?>

        <?php else: ?>
            <div class="max-w-2xl mx-auto bg-white border border-[#ECECEC] p-10 md:p-14 text-center">
                <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4">CATALOGUE</p>
                <h3 class="text-2xl md:text-3xl font-medium text-[#3A3D40] mb-4">Products coming online soon.</h3>
                <p class="text-base text-[#63666A] leading-relaxed mb-8">We&rsquo;re loading this category onto the website. In the meantime, our specification team can quote against drawings or BOQ within one business day.</p>
                <div class="flex flex-col md:flex-row gap-4 justify-center">
                    <a href="<?php echo esc_url(home_url('/quote/')); ?>" class="bg-[#FFCD00] text-[#3A3D40] px-8 py-4 font-medium hover:bg-[#FFD52E] transition-colors inline-block">Request a quote</a>
                    <?php if ($wa_digits): ?>
                        <a href="https://wa.me/<?php echo esc_attr($wa_digits); ?>" target="_blank" rel="noopener" class="border border-[#63666A] text-[#63666A] px-8 py-4 hover:bg-[#ECECEC] transition-colors inline-block">Speak via WhatsApp</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<style>
.tc-products-pagination ul { display: flex; flex-wrap: wrap; gap: 0.5rem; list-style: none; padding: 0; margin: 0; justify-content: center; }
.tc-products-pagination ul li a, .tc-products-pagination ul li span { display: inline-block; padding: 0.5rem 1rem; border: 1px solid #ECECEC; color: #3A3D40; text-decoration: none; font-size: 0.875rem; background: #FFFFFF; transition: border-color 0.2s; }
.tc-products-pagination ul li a:hover { border-color: #FFCD00; }
.tc-products-pagination ul li span.current { background: #FFCD00; border-color: #FFCD00; color: #3A3D40; font-weight: 500; }
.tc-products-pagination ul li span.dots { border-color: transparent; background: transparent; }
.line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
</style>
