<?php
/**
 * Template Name: Sub-Category Shell
 * Sub-category archive page template. WooCommerce product listing inserted via shortcode
 * (subcat_products_shortcode ACF). Falls back to a polished placeholder when shortcode empty.
 */
get_header();
?>
<main id="primary" class="site-main tc-subcat-shell">
    <?php
    get_template_part('template-parts/subcat-shell/hero');
    get_template_part('template-parts/subcat-shell/intro');
    get_template_part('template-parts/subcat-shell/products');
    get_template_part('template-parts/subcat-shell/considerations');
    get_template_part('template-parts/subcat-shell/brands');
    get_template_part('template-parts/subcat-shell/articles');
    get_template_part('template-parts/subcat-shell/cta-strip');
    ?>
</main>
<?php get_footer();
