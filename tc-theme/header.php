<?php /* Placeholder - full header built in Phase 2 */ ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex,nofollow">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; font-family: system-ui, sans-serif;">
  <a href="<?php echo esc_url(home_url('/')); ?>" style="font-weight: 600; text-decoration: none; color: #1a1a1a;"><?php bloginfo('name'); ?></a>
  <span style="color: #999; font-size: 13px; margin-left: 1rem;">- site under construction</span>
</header>
<main class="site-main">
