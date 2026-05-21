<?php
/**
 * tc-theme functions and definitions
 */

if (!defined('ABSPATH')) exit;

define('TC_THEME_VERSION', '0.1.0');
define('TC_THEME_DIR', get_stylesheet_directory());
define('TC_THEME_URI', get_stylesheet_directory_uri());

function tc_theme_enqueue_assets() {
    wp_enqueue_style('blocksy-parent', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('tc-theme', get_stylesheet_uri(), ['blocksy-parent'], TC_THEME_VERSION);
    wp_enqueue_script('tailwind-cdn', 'https://cdn.tailwindcss.com', [], '3.4.0', false);
    wp_enqueue_script('tc-theme-main', TC_THEME_URI . '/assets/js/main.js', [], TC_THEME_VERSION, true);
}
add_action('wp_enqueue_scripts', 'tc_theme_enqueue_assets', 20);

function tc_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'tc_theme_setup');

function tc_theme_acf_json_save_point($path) {
    return TC_THEME_DIR . '/inc/acf-json';
}
add_filter('acf/settings/save_json', 'tc_theme_acf_json_save_point');

function tc_theme_acf_json_load_point($paths) {
    unset($paths[0]);
    $paths[] = TC_THEME_DIR . '/inc/acf-json';
    return $paths;
}
add_filter('acf/settings/load_json', 'tc_theme_acf_json_load_point');

function tc_theme_robots_txt($output, $public) {
    return "User-agent: *\nDisallow: /\n";
}
add_filter('robots_txt', 'tc_theme_robots_txt', 999, 2);
