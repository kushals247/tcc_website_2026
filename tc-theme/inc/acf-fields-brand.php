<?php
/**
 * ACF field groups for Brand CPT and Brands Directory page
 */
if (!defined('ABSPATH')) { exit; }
if (!function_exists('acf_add_local_field_group')) { return; }

add_action('acf/init', function() {

    // Group 1: Brand details (post_type == brand)
    acf_add_local_field_group([
        'key' => 'group_brand_details',
        'title' => 'Brand Details',
        'fields' => [
            [
                'key' => 'field_brand_logo',
                'label' => 'Brand Logo URL',
                'name' => 'brand_logo',
                'type' => 'url',
            ],
            [
                'key' => 'field_brand_hero_image',
                'label' => 'Hero Image URL',
                'name' => 'brand_hero_image',
                'type' => 'url',
            ],
            [
                'key' => 'field_brand_tagline',
                'label' => 'Tagline',
                'name' => 'brand_tagline',
                'type' => 'text',
            ],
            [
                'key' => 'field_brand_country',
                'label' => 'Country',
                'name' => 'brand_country',
                'type' => 'text',
            ],
            [
                'key' => 'field_brand_founded_year',
                'label' => 'Founded Year',
                'name' => 'brand_founded_year',
                'type' => 'number',
            ],
            [
                'key' => 'field_brand_website',
                'label' => 'Website',
                'name' => 'brand_website',
                'type' => 'text',
            ],
            [
                'key' => 'field_brand_ecosystems',
                'label' => 'Ecosystems',
                'name' => 'brand_ecosystems',
                'type' => 'checkbox',
                'choices' => [
                    'structure-essentials' => 'Structure Essentials',
                    'surfaces-finishes' => 'Surfaces & Finishes',
                    'softs-decor' => 'Softs & Decor',
                ],
            ],
            [
                'key' => 'field_brand_key_collections',
                'label' => 'Key Collections',
                'name' => 'brand_key_collections',
                'type' => 'repeater',
                'min' => 0,
                'max' => 8,
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_brand_key_collections_name',
                        'label' => 'Name',
                        'name' => 'name',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_brand_key_collections_description',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                    ],
                ],
            ],
            [
                'key' => 'field_brand_certifications',
                'label' => 'Certifications',
                'name' => 'brand_certifications',
                'type' => 'repeater',
                'min' => 0,
                'max' => 6,
                'layout' => 'table',
                'sub_fields' => [
                    [
                        'key' => 'field_brand_certifications_name',
                        'label' => 'Name',
                        'name' => 'name',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'key' => 'field_brand_available_at_tacc',
                'label' => 'Available at TACC',
                'name' => 'brand_available_at_tacc',
                'type' => 'true_false',
                'default_value' => 0,
            ],
            [
                'key' => 'field_brand_tacc_search_url',
                'label' => 'TACC Search URL',
                'name' => 'brand_tacc_search_url',
                'type' => 'text',
            ],
            [
                'key' => 'field_brand_is_inhouse',
                'label' => 'In-house Brand',
                'name' => 'brand_is_inhouse',
                'type' => 'true_false',
                'default_value' => 0,
            ],
            [
                'key' => 'field_brand_featured_on_homepage',
                'label' => 'Featured on homepage',
                'name' => 'brand_featured_on_homepage',
                'type' => 'true_false',
                'default_value' => 0,
                'ui' => 1,
                'instructions' => 'When ON, this brand appears in the Brand Partners strip on the homepage.',
            ],
            [
                'key' => 'field_brand_featured_order',
                'label' => 'Featured order',
                'name' => 'brand_featured_order',
                'type' => 'number',
                'default_value' => 100,
                'instructions' => 'Lower numbers display first. Use 10, 20, 30 to leave space for reordering. Ties broken alphabetically.',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'brand',
                ],
            ],
        ],
        'menu_order' => 18,
    ]);

    // Group 2: Brands directory page (page_template == page-brands.php)
    acf_add_local_field_group([
        'key' => 'group_brands_directory',
        'title' => 'Brands Directory',
        'fields' => [
            [
                'key' => 'field_brands_hero_image',
                'label' => 'Hero Image URL',
                'name' => 'brands_hero_image',
                'type' => 'url',
            ],
            [
                'key' => 'field_brands_hero_eyebrow',
                'label' => 'Hero Eyebrow',
                'name' => 'brands_hero_eyebrow',
                'type' => 'text',
                'default_value' => 'OUR PARTNERS',
            ],
            [
                'key' => 'field_brands_hero_headline',
                'label' => 'Hero Headline',
                'name' => 'brands_hero_headline',
                'type' => 'text',
                'default_value' => 'Brands we carry.',
            ],
            [
                'key' => 'field_brands_hero_subline',
                'label' => 'Hero Subline',
                'name' => 'brands_hero_subline',
                'type' => 'textarea',
            ],
            [
                'key' => 'field_brands_intro_body',
                'label' => 'Intro Body',
                'name' => 'brands_intro_body',
                'type' => 'textarea',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-brands.php',
                ],
            ],
        ],
        'menu_order' => 19,
    ]);

});