<?php
/**
 * Template Name: Contact Page
 */
get_header();
?>
<main id="primary" class="site-main tc-contact">
    <?php
    get_template_part('template-parts/contact/hero');
    get_template_part('template-parts/contact/main');
    get_template_part('template-parts/contact/hours');
    ?>
</main>
<?php get_footer();