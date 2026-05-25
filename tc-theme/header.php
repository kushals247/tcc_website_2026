<?php
/**
 * tc-theme header template.
 * Phase 2.1: delegates the visible header chrome to template-parts/nav-header.php.
 */
if (!defined('ABSPATH')) exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex,nofollow">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> style="margin: 0; padding: 0; font-family: 'Montserrat', system-ui, sans-serif; color: #63666A; background: #FFFFFF;">
<?php wp_body_open(); ?>
<?php get_template_part('template-parts/nav-header'); ?>
<main class="site-main">