<?php
/**
 * Template Name: Quote Page
 *
 * Composer template for /quote/. Sequence:
 *   1. Hero (half-bleed)
 *   2. Context strip (smart prefill, hidden by default)
 *   3. Form area (steps + secondary methods + CF7)
 *   4. Trust strip (showroom CTA)
 */

if (!defined('ABSPATH')) exit;

get_header();
?>
<main id="primary" class="site-main tc-quote">
    <?php
    get_template_part('template-parts/quote/hero');
    get_template_part('template-parts/quote/context-strip');
    get_template_part('template-parts/quote/form-area');
    get_template_part('template-parts/quote/trust-strip');
    ?>
</main>
<?php get_footer();