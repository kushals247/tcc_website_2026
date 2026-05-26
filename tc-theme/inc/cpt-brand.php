<?php
/**
 * Brand CPT registration
 */
if (!defined('ABSPATH')) { exit; }

add_action('init', function() {
    register_post_type('brand', [
        'labels' => [
            'name' => 'Brands',
            'singular_name' => 'Brand',
            'add_new_item' => 'Add New Brand',
            'edit_item' => 'Edit Brand',
            'new_item' => 'New Brand',
            'view_item' => 'View Brand',
            'all_items' => 'All Brands',
            'menu_name' => 'Brands',
            'search_items' => 'Search Brands',
            'not_found' => 'No brands found',
        ],
        'public' => true,
        'has_archive' => false,
        'rewrite' => ['slug' => 'our-brands', 'with_front' => false],
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'],
        'menu_icon' => 'dashicons-awards',
        'menu_position' => 25,
        'show_in_rest' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
    ]);
});