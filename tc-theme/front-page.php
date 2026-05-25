<?php
/**
 * Front Page template — homepage
 * Composes the three Phase 2.1 template parts.
 */
if (!defined('ABSPATH')) exit;
get_header();
?>
<div class="tc-homepage" style="font-family: 'Montserrat', system-ui, sans-serif;">
  <?php get_template_part('template-parts/hero-carousel'); ?>
  <?php get_template_part('template-parts/ecosystem-cards'); ?>
  <?php get_template_part('template-parts/shop-by-room'); ?>
  <?php get_template_part('template-parts/brand-partners'); ?>
  <?php get_template_part('template-parts/featured-products'); ?>
  <?php get_template_part('template-parts/inspiration-preview'); ?>
  <?php get_template_part('template-parts/testimonials'); ?>
  <?php get_template_part('template-parts/store-locator-strip'); ?>
</div>
<?php
get_footer();