<?php
/**
 * Template Name: Inspiration Hub
 */
get_header();
?>
<main id="primary" class="site-main tc-inspiration">
    <?php
    get_template_part('template-parts/inspiration/hero');
    get_template_part('template-parts/inspiration/filters');
    get_template_part('template-parts/inspiration/featured-article');
    get_template_part('template-parts/inspiration/article-grid');
    ?>
</main>
<?php get_footer();