<?php
/**
 * tc-theme Phase 2.2b ACF field group registrations.
 * Featured Products, Inspiration Preview, Testimonials, Store Locator Strip.
 */
if (!defined('ABSPATH')) exit;
if (!function_exists('acf_add_local_field_group')) return;

add_action('acf/init', function () {

    acf_add_local_field_group([
        'key' => 'group_featured_products',
        'title' => 'Featured Products',
        'fields' => [
            ['key' => 'field_fp_eyebrow', 'label' => 'Eyebrow', 'name' => 'featured_eyebrow', 'type' => 'text', 'default_value' => 'Featured'],
            ['key' => 'field_fp_heading', 'label' => 'Heading', 'name' => 'featured_heading', 'type' => 'text', 'default_value' => 'Solutions for every project.'],
            ['key' => 'field_fp_intro', 'label' => 'Intro (optional)', 'name' => 'featured_intro', 'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_fp_items', 'label' => 'Featured items (3-4)', 'name' => 'featured_items', 'type' => 'repeater', 'min' => 3, 'max' => 4, 'layout' => 'block', 'sub_fields' => [
                ['key' => 'field_fp_item_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'array'],
                ['key' => 'field_fp_item_name', 'label' => 'Name', 'name' => 'name', 'type' => 'text'],
                ['key' => 'field_fp_item_description', 'label' => 'Description (1 line)', 'name' => 'description', 'type' => 'text'],
                ['key' => 'field_fp_item_url', 'label' => 'Link URL', 'name' => 'link_url', 'type' => 'link', 'return_format' => 'url'],
                ['key' => 'field_fp_item_label', 'label' => 'Link label', 'name' => 'link_label', 'type' => 'text', 'default_value' => 'Learn more'],
            ]],
        ],
        'location' => [[['param' => 'page_type', 'operator' => '==', 'value' => 'front_page']]],
        'menu_order' => 7, 'position' => 'normal', 'style' => 'default', 'label_placement' => 'top', 'active' => true,
    ]);

    acf_add_local_field_group([
        'key' => 'group_inspiration_preview',
        'title' => 'Inspiration Preview',
        'fields' => [
            ['key' => 'field_ip_eyebrow', 'label' => 'Eyebrow', 'name' => 'inspiration_eyebrow', 'type' => 'text', 'default_value' => 'Inspiration'],
            ['key' => 'field_ip_heading', 'label' => 'Heading', 'name' => 'inspiration_heading', 'type' => 'text', 'default_value' => 'Not sure where to start?'],
            ['key' => 'field_ip_intro', 'label' => 'Intro', 'name' => 'inspiration_intro', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Ideas, guides and project stories from T&C specialists.'],
            ['key' => 'field_ip_hub_url', 'label' => 'Advice hub URL', 'name' => 'inspiration_hub_url', 'type' => 'link', 'return_format' => 'url'],
            ['key' => 'field_ip_fallback', 'label' => 'Fallback cards (used if fewer than 4 published posts)', 'name' => 'inspiration_fallback_cards', 'type' => 'repeater', 'min' => 4, 'max' => 4, 'layout' => 'block', 'sub_fields' => [
                ['key' => 'field_ip_fb_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'array'],
                ['key' => 'field_ip_fb_category', 'label' => 'Category', 'name' => 'category', 'type' => 'text'],
                ['key' => 'field_ip_fb_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                ['key' => 'field_ip_fb_excerpt', 'label' => 'Excerpt (2 lines)', 'name' => 'excerpt', 'type' => 'textarea', 'rows' => 2],
                ['key' => 'field_ip_fb_date', 'label' => 'Date', 'name' => 'date', 'type' => 'text'],
                ['key' => 'field_ip_fb_url', 'label' => 'Link URL', 'name' => 'link_url', 'type' => 'link', 'return_format' => 'url'],
            ]],
        ],
        'location' => [[['param' => 'page_type', 'operator' => '==', 'value' => 'front_page']]],
        'menu_order' => 8, 'position' => 'normal', 'style' => 'default', 'label_placement' => 'top', 'active' => true,
    ]);

    acf_add_local_field_group([
        'key' => 'group_testimonials',
        'title' => 'Testimonials',
        'fields' => [
            ['key' => 'field_tm_eyebrow', 'label' => 'Eyebrow', 'name' => 'testimonials_eyebrow', 'type' => 'text', 'default_value' => 'Trusted'],
            ['key' => 'field_tm_heading', 'label' => 'Heading', 'name' => 'testimonials_heading', 'type' => 'text', 'default_value' => 'Trusted by professionals and homeowners across Kenya.'],
            ['key' => 'field_tm_items', 'label' => 'Testimonials (3-5)', 'name' => 'testimonials', 'type' => 'repeater', 'min' => 3, 'max' => 5, 'layout' => 'block', 'sub_fields' => [
                ['key' => 'field_tm_quote', 'label' => 'Quote', 'name' => 'quote', 'type' => 'textarea', 'rows' => 4],
                ['key' => 'field_tm_name', 'label' => 'Customer name', 'name' => 'name', 'type' => 'text'],
                ['key' => 'field_tm_project_type', 'label' => 'Project type', 'name' => 'project_type', 'type' => 'text'],
                ['key' => 'field_tm_city', 'label' => 'City', 'name' => 'city', 'type' => 'text'],
                ['key' => 'field_tm_customer_image', 'label' => 'Customer image (optional, 80x80)', 'name' => 'customer_image', 'type' => 'image', 'return_format' => 'array'],
                ['key' => 'field_tm_before_image', 'label' => 'Before image (optional)', 'name' => 'before_image', 'type' => 'image', 'return_format' => 'array'],
                ['key' => 'field_tm_after_image', 'label' => 'After image (optional)', 'name' => 'after_image', 'type' => 'image', 'return_format' => 'array'],
            ]],
            ['key' => 'field_tm_autoplay', 'label' => 'Auto-rotate every (seconds)', 'name' => 'testimonials_autoplay_seconds', 'type' => 'number', 'default_value' => 8, 'min' => 3, 'max' => 30],
        ],
        'location' => [[['param' => 'page_type', 'operator' => '==', 'value' => 'front_page']]],
        'menu_order' => 9, 'position' => 'normal', 'style' => 'default', 'label_placement' => 'top', 'active' => true,
    ]);

    acf_add_local_field_group([
        'key' => 'group_store_locator_strip',
        'title' => 'Store Locator Strip',
        'fields' => [
            ['key' => 'field_sl_eyebrow', 'label' => 'Eyebrow', 'name' => 'locator_eyebrow', 'type' => 'text', 'default_value' => 'Visit us'],
            ['key' => 'field_sl_heading', 'label' => 'Heading', 'name' => 'locator_heading', 'type' => 'text', 'default_value' => 'Experience T&C in person.'],
            ['key' => 'field_sl_body', 'label' => 'Body', 'name' => 'locator_body', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Our specialists are ready to help across our showrooms in Kenya.'],
            ['key' => 'field_sl_bg', 'label' => 'Background image (optional, at 0.25 opacity)', 'name' => 'locator_background_image', 'type' => 'image', 'return_format' => 'array'],
            ['key' => 'field_sl_primary_label', 'label' => 'Primary CTA label', 'name' => 'locator_primary_cta_label', 'type' => 'text', 'default_value' => 'Find your nearest showroom'],
            ['key' => 'field_sl_primary_url', 'label' => 'Primary CTA URL', 'name' => 'locator_primary_cta_url', 'type' => 'link', 'return_format' => 'url'],
            ['key' => 'field_sl_whatsapp_label', 'label' => 'WhatsApp CTA label', 'name' => 'locator_whatsapp_cta_label', 'type' => 'text', 'default_value' => 'WhatsApp us'],
        ],
        'location' => [[['param' => 'page_type', 'operator' => '==', 'value' => 'front_page']]],
        'menu_order' => 10, 'position' => 'normal', 'style' => 'default', 'label_placement' => 'top', 'active' => true,
    ]);

});