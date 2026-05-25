<?php
/**
 * Template Name: About Page
 */
get_header();
?>
<main id="primary" class="site-main tc-about">
    <?php
    get_template_part('template-parts/about/hero');
    get_template_part('template-parts/about/philosophy');
    get_template_part('template-parts/about/scale-strip');
    get_template_part('template-parts/about/ecosystems');
    get_template_part('template-parts/about/manufacturing-brands');
    get_template_part('template-parts/about/footprint');
    get_template_part('template-parts/about/project-refs');
    get_template_part('template-parts/about/sister-companies');
    get_template_part('template-parts/about/cta-strip');
    ?>
</main>
<?php get_footer();