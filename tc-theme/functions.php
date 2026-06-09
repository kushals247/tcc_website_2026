<?php
/**
 * tc-theme functions and definitions
 */

if (!defined('ABSPATH')) exit;

define('TC_THEME_VERSION', '1.0.0');
define('TC_THEME_DIR', get_stylesheet_directory());
define('TC_THEME_URI', get_stylesheet_directory_uri());
define('TC_GSAP_VERSION', '3.12.5');

function tc_theme_resource_hints($hints, $relation_type) {
    if ('preconnect' === $relation_type) {
        $hints[] = 'https://fonts.googleapis.com';
        $hints[] = 'https://fonts.gstatic.com';
    }
    return $hints;
}
add_filter('wp_resource_hints', 'tc_theme_resource_hints', 10, 2);

function tc_theme_enqueue_assets() {
    wp_enqueue_style('tc-theme', get_stylesheet_uri(), [], TC_THEME_VERSION);
    wp_enqueue_style('tc-montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap', [], null);
    wp_enqueue_style('tc-hero-fade', TC_THEME_URI . '/assets/css/hero-fade.css', ['tc-theme'], TC_THEME_VERSION);

    // Tailwind production build (compiled v3.4.17 — replaces Play CDN as of Phase 4a launch readiness)
    wp_enqueue_style('tc-tailwind', TC_THEME_URI . '/assets/css/tc-tailwind.css', [], TC_THEME_VERSION);
    // Tabler Icons webfont — used for nav/contact/WhatsApp icons across templates
    wp_enqueue_style('tabler-icons', 'https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.24.0/dist/tabler-icons.min.css', [], '3.24.0');
    wp_enqueue_script('gsap-core', 'https://cdn.jsdelivr.net/npm/gsap@' . TC_GSAP_VERSION . '/dist/gsap.min.js', [], TC_GSAP_VERSION, true);
    wp_enqueue_script('gsap-scrolltrigger', 'https://cdn.jsdelivr.net/npm/gsap@' . TC_GSAP_VERSION . '/dist/ScrollTrigger.min.js', ['gsap-core'], TC_GSAP_VERSION, true);
    wp_enqueue_script('tc-theme-main', TC_THEME_URI . '/assets/js/main.js', ['gsap-scrolltrigger'], TC_THEME_VERSION, true);
    wp_enqueue_script('tc-nav-scroll-state', TC_THEME_URI . '/assets/js/nav-scroll-state.js', ['tc-theme-main'], TC_THEME_VERSION, true);
    wp_enqueue_script('tc-mega-menu', TC_THEME_URI . '/assets/js/mega-menu.js', ['tc-theme-main'], TC_THEME_VERSION, true);
    wp_enqueue_script('tc-whatsapp-fab', TC_THEME_URI . '/assets/js/whatsapp-fab.js', ['tc-theme-main'], TC_THEME_VERSION, true);

    if (is_front_page()) {
        wp_enqueue_script('tc-hero-carousel', TC_THEME_URI . '/assets/js/hero-carousel.js', ['tc-theme-main'], TC_THEME_VERSION, true);
        wp_enqueue_script('tc-brand-slider', TC_THEME_URI . '/assets/js/brand-slider.js', ['tc-theme-main'], TC_THEME_VERSION, true);
        wp_enqueue_script('tc-testimonials-carousel', TC_THEME_URI . '/assets/js/testimonials-carousel.js', ['tc-theme-main'], TC_THEME_VERSION, true);
    }
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
if (!defined('TC_DISABLE_ROBOTS_LOCKDOWN') || !TC_DISABLE_ROBOTS_LOCKDOWN) {
    add_filter('robots_txt', 'tc_theme_robots_txt', 999, 2);
}

if (file_exists(TC_THEME_DIR . '/inc/acf-fields.php')) {
    require_once TC_THEME_DIR . '/inc/acf-fields.php';
}

if (file_exists(TC_THEME_DIR . '/inc/acf-fields-phase-2-2a.php')) {
    require_once TC_THEME_DIR . '/inc/acf-fields-phase-2-2a.php';
}

if (file_exists(TC_THEME_DIR . '/inc/acf-fields-phase-2-2b.php')) {
    require_once TC_THEME_DIR . '/inc/acf-fields-phase-2-2b.php';
}

if (file_exists(TC_THEME_DIR . '/inc/acf-fields-pillar.php')) {
    require_once TC_THEME_DIR . '/inc/acf-fields-pillar.php';
}

if (file_exists(TC_THEME_DIR . '/inc/acf-fields-info-pages.php')) {
    require_once TC_THEME_DIR . '/inc/acf-fields-info-pages.php';
}

if (file_exists(TC_THEME_DIR . '/inc/acf-fields-inspiration.php')) {
    require_once TC_THEME_DIR . '/inc/acf-fields-inspiration.php';
}

if (file_exists(TC_THEME_DIR . '/inc/cpt-brand.php')) {
    require_once TC_THEME_DIR . '/inc/cpt-brand.php';
}

if (file_exists(TC_THEME_DIR . '/inc/acf-fields-brand.php')) {
    require_once TC_THEME_DIR . '/inc/acf-fields-brand.php';
}

if (file_exists(TC_THEME_DIR . '/inc/acf-fields-quote.php')) {
    require_once TC_THEME_DIR . '/inc/acf-fields-quote.php';
}
if (file_exists(TC_THEME_DIR . '/inc/acf-fields-legal.php')) {
    require_once TC_THEME_DIR . '/inc/acf-fields-legal.php';
}
if (file_exists(TC_THEME_DIR . '/inc/theme-settings.php')) {
    require_once TC_THEME_DIR . '/inc/theme-settings.php';
}
if (file_exists(TC_THEME_DIR . '/inc/ia-structure.php')) {
    require_once TC_THEME_DIR . '/inc/ia-structure.php';
}

function tc_theme_register_options_page() {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'T&C Site Header',
            'menu_title' => 'Site Header',
            'menu_slug'  => 'tc-site-header',
            'capability' => 'manage_options',
            'redirect'   => false,
            'icon_url'   => 'dashicons-menu',
            'position'   => 30,
        ]);
    }
}
add_action('acf/init', 'tc_theme_register_options_page');

// Sub-category page redirects: dropped on IA migration to PIM-driven structure (2026-06-09).
// Old 25-subcat URLs intentionally return 404; new structure under tc_get_ia_structure() in inc/ia-structure.php.