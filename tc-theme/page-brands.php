<?php
/**
 * Template Name: Brands Directory
 */
get_header();
?>
<main id="primary" class="site-main tc-brands">
    <?php
    get_template_part('template-parts/brands/hero');
    get_template_part('template-parts/brands/filters');
    get_template_part('template-parts/brands/grid');
    ?>
</main>
<?php get_footer();