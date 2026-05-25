<?php
/**
 * Template Name: Pillar Page
 * Used for the 3 ecosystem pillar pages: Structure Essentials, Surfaces & Finishes, Softs & Decor.
 */
get_header();
?>
<main id="primary" class="site-main tc-pillar">
    <?php
    get_template_part('template-parts/pillar/hero');
    get_template_part('template-parts/pillar/positioning');
    get_template_part('template-parts/pillar/subcat-grid');
    get_template_part('template-parts/pillar/advisory');
    get_template_part('template-parts/pillar/brands');
    get_template_part('template-parts/pillar/project');
    get_template_part('template-parts/pillar/articles');
    get_template_part('template-parts/pillar/cta-strip');
    ?>
</main>
<?php get_footer();