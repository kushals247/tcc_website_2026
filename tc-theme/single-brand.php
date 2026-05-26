<?php
/**
 * Single brand template — auto-loaded by WP template hierarchy for post_type=brand
 */
get_header();
if (is_singular('brand') && have_posts()) {
    while (have_posts()) {
        the_post();
        ?>
        <main id="primary" class="site-main tc-single-brand">
            <?php
            get_template_part('template-parts/single-brand/hero');
            get_template_part('template-parts/single-brand/info');
            get_template_part('template-parts/single-brand/body');
            get_template_part('template-parts/single-brand/cta-strip');
            ?>
        </main>
        <?php
    }
}
get_footer();