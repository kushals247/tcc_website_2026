<?php
/**
 * Template Name: Legal Page
 */
get_header();
?>
<main id="primary" class="site-main tc-legal">
    <?php
    while (have_posts()) { the_post();
        get_template_part('template-parts/legal/hero');
        get_template_part('template-parts/legal/body');
    }
    ?>
</main>
<?php get_footer();