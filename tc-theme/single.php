<?php
/**
 * Single post template
 * Custom layout for post_type=post; minimal fallback for other types.
 */
get_header();

if (is_singular('post')) {
    while (have_posts()) {
        the_post();
        ?>
        <main id="primary" class="site-main tc-single-article">
            <?php
            get_template_part('template-parts/single-article/hero');
            get_template_part('template-parts/single-article/meta');
            get_template_part('template-parts/single-article/body');
            get_template_part('template-parts/single-article/related');
            get_template_part('template-parts/single-article/cta-strip');
            ?>
        </main>
        <?php
    }
} else {
    while (have_posts()) {
        the_post();
        ?>
        <main id="primary" class="site-main tc-single-fallback">
            <article class="max-w-3xl mx-auto px-6 py-20">
                <h1 class="text-3xl md:text-5xl font-medium text-[#3A3D40] mb-8"><?php the_title(); ?></h1>
                <div class="prose"><?php the_content(); ?></div>
            </article>
        </main>
        <?php
    }
}

get_footer();