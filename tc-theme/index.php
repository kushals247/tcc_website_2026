<?php /* Placeholder index - Phase 2 builds real templates */ ?>
<?php get_header(); ?>
<div class="tc-shell" style="max-width: 800px; margin: 4rem auto; padding: 0 1.5rem; font-family: system-ui, sans-serif;">
  <h1 style="font-size: 2.5rem; font-weight: 300; color: #1a1a1a; margin-bottom: 1rem;"><?php echo is_front_page() ? get_bloginfo('name') : (get_the_title() ?: 'Page'); ?></h1>
  <p style="color: #888; font-size: 1rem; line-height: 1.6;">This is a Phase 1 scaffold page. The full template, content, and design will be built in Phase 2 (Core Pages).</p>
  <p style="color: #c9a961; font-size: 0.9rem; margin-top: 2rem; letter-spacing: 0.05em; text-transform: uppercase;">tc-theme - Blocksy child - v<?php echo TC_THEME_VERSION; ?></p>
</div>
<?php get_footer(); ?>
