<?php
/**
 * Search results template.
 */
get_header();
$q = get_search_query();
global $wp_query;
$found = (int) $wp_query->found_posts;
?>
<main id="primary" class="site-main tc-search">
    <section class="tc-search-hero bg-[#F5F6F7] py-12 md:py-16">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-3">SEARCH RESULTS</p>
            <h1 class="text-3xl md:text-5xl font-medium text-[#3A3D40] mb-4 leading-tight">
                <?php if ($q): ?>Results for &ldquo;<?php echo esc_html($q); ?>&rdquo;<?php else: ?>Search<?php endif; ?>
            </h1>
            <p class="text-sm text-[#63666A]">
                <?php echo $found === 1 ? '1 result' : esc_html(number_format($found) . ' results'); ?>
            </p>
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="mt-6 max-w-xl mx-auto flex gap-2">
                <input type="search" name="s" value="<?php echo esc_attr($q); ?>" placeholder="Search again…" class="flex-1 px-4 py-3 border border-[#ECECEC] bg-white text-[#3A3D40] focus:border-[#FFCD00] focus:outline-none" />
                <button type="submit" class="bg-[#FFCD00] text-[#3A3D40] px-6 py-3 font-medium hover:bg-[#FFD52E] transition-colors">Search</button>
            </form>
        </div>
    </section>

    <section class="tc-search-results bg-white py-16 md:py-20">
        <div class="max-w-6xl mx-auto px-6">
            <?php if (have_posts()): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3.5">
                    <?php while (have_posts()): the_post();
                        $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large') ?: 'https://placehold.co/800x533/F5F6F7/63666A?text=' . rawurlencode(get_the_title()) . '&font=montserrat';
                        $pt = get_post_type_object(get_post_type());
                        $type_label = $pt ? $pt->labels->singular_name : '';
                    ?>
                        <a href="<?php the_permalink(); ?>" class="group block bg-white border border-[#ECECEC] hover:border-[#FFCD00] transition-all duration-300 hover:-translate-y-0.5">
                            <div class="aspect-[3/2] overflow-hidden bg-[#F5F6F7]">
                                <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500" loading="lazy">
                            </div>
                            <div class="p-6">
                                <?php if ($type_label): ?><p class="text-xs tracking-[0.15em] uppercase text-[#FFCD00] mb-2"><?php echo esc_html($type_label); ?></p><?php endif; ?>
                                <h3 class="text-lg font-medium text-[#3A3D40] mb-2 leading-snug"><?php the_title(); ?></h3>
                                <p class="text-sm text-[#63666A] leading-relaxed"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>
                            </div>
                        </a>
                    <?php endwhile; ?>
                </div>
                <?php
                $paginate = paginate_links(['type' => 'list', 'prev_text' => '&larr; Previous', 'next_text' => 'Next &rarr;']);
                if ($paginate) echo '<nav class="tc-search-pagination mt-12 flex justify-center" aria-label="Pagination">' . $paginate . '</nav>';
                ?>
            <?php else: ?>
                <div class="text-center py-12">
                    <p class="text-lg text-[#63666A] mb-8">Nothing found for that search. Try a different query, or browse:</p>
                    <div class="flex flex-wrap gap-3 justify-center">
                        <a href="<?php echo esc_url(home_url('/structure-essentials/')); ?>" class="inline-block px-5 py-2 text-sm border border-[#ECECEC] text-[#3A3D40] hover:border-[#FFCD00] transition-colors">Structure Essentials</a>
                        <a href="<?php echo esc_url(home_url('/surfaces-finishes/')); ?>" class="inline-block px-5 py-2 text-sm border border-[#ECECEC] text-[#3A3D40] hover:border-[#FFCD00] transition-colors">Surfaces &amp; Finishes</a>
                        <a href="<?php echo esc_url(home_url('/softs-decor/')); ?>" class="inline-block px-5 py-2 text-sm border border-[#ECECEC] text-[#3A3D40] hover:border-[#FFCD00] transition-colors">Softs &amp; Decor</a>
                        <a href="<?php echo esc_url(home_url('/brands/')); ?>" class="inline-block px-5 py-2 text-sm border border-[#ECECEC] text-[#3A3D40] hover:border-[#FFCD00] transition-colors">Brands</a>
                        <a href="<?php echo esc_url(home_url('/inspiration/')); ?>" class="inline-block px-5 py-2 text-sm border border-[#ECECEC] text-[#3A3D40] hover:border-[#FFCD00] transition-colors">Inspiration</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>
<style>
.tc-search-pagination ul { display: flex; gap: 8px; list-style: none; padding: 0; }
.tc-search-pagination li a, .tc-search-pagination li span { display: inline-block; padding: 8px 14px; border: 1px solid #ECECEC; color: #3A3D40; }
.tc-search-pagination li .current { background: #FFCD00; border-color: #FFCD00; }
</style>
<?php get_footer();