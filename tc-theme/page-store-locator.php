<?php
/**
 * Template Name: Store Locator Page
 */
get_header();
?>
<main id="primary" class="site-main tc-locator">
    <?php
    get_template_part('template-parts/store-locator/hero');
    get_template_part('template-parts/store-locator/branches');
    get_template_part('template-parts/store-locator/tacc-strip');
    get_template_part('template-parts/store-locator/cta-strip');
    ?>
</main>
<?php get_footer();