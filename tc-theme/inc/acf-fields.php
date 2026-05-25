<?php
/**
 * T&C Theme — ACF Field Groups
 *
 * Registers field groups for:
 *  - Site Header (Navigation) — options page tc-site-header
 *  - Hero Carousel — front_page
 *  - Ecosystem Cards — front_page
 *
 * Safe to load when ACF is inactive.
 *
 * @package tc-theme
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('acf_add_local_field_group')) {
    return;
}

add_action('acf/init', function () {

    /* =====================================================================
     * GROUP 1: Site Header (Navigation)
     * ===================================================================== */
    acf_add_local_field_group([
        'key'    => 'group_nav_header',
        'title'  => 'Site Header (Navigation)',
        'fields' => [
            [
                'key'           => 'field_nav_logo_white_svg',
                'label'         => 'Logo (for use over hero, white/yellow variant)',
                'name'          => 'nav_logo_white_svg',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'library'       => 'all',
                'mime_types'    => 'svg,png',
            ],
            [
                'key'           => 'field_nav_logo_dark_svg',
                'label'         => 'Logo (for use on white background, dark variant)',
                'name'          => 'nav_logo_dark_svg',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'library'       => 'all',
                'mime_types'    => 'svg,png',
            ],
            [
                'key'          => 'field_nav_ecosystem_links',
                'label'        => 'Ecosystem Links',
                'name'         => 'nav_ecosystem_links',
                'type'         => 'repeater',
                'min'          => 3,
                'max'          => 3,
                'layout'       => 'table',
                'button_label' => 'Add ecosystem link',
                'sub_fields'   => [
                    [
                        'key'   => 'field_nav_ecosystem_links_label',
                        'label' => 'Label',
                        'name'  => 'label',
                        'type'  => 'text',
                    ],
                    [
                        'key'           => 'field_nav_ecosystem_links_url',
                        'label'         => 'URL',
                        'name'          => 'url',
                        'type'          => 'link',
                        'return_format' => 'url',
                    ],
                ],
            ],
            [
                'key'           => 'field_nav_brands_label',
                'label'         => 'Brands Label',
                'name'          => 'nav_brands_label',
                'type'          => 'text',
                'default_value' => 'Brands',
            ],
            [
                'key'           => 'field_nav_brands_url',
                'label'         => 'Brands URL',
                'name'          => 'nav_brands_url',
                'type'          => 'link',
                'return_format' => 'url',
            ],
            [
                'key'           => 'field_nav_search_enabled',
                'label'         => 'Search Enabled',
                'name'          => 'nav_search_enabled',
                'type'          => 'true_false',
                'ui'            => 1,
                'default_value' => 1,
            ],
            [
                'key'           => 'field_nav_cta_label',
                'label'         => 'CTA Label',
                'name'          => 'nav_cta_label',
                'type'          => 'text',
                'default_value' => 'Visit showroom',
            ],
            [
                'key'           => 'field_nav_cta_url',
                'label'         => 'CTA URL',
                'name'          => 'nav_cta_url',
                'type'          => 'link',
                'return_format' => 'url',
            ],
            [
                'key'   => 'field_nav_whatsapp_number',
                'label' => 'WhatsApp number (international format, no +)',
                'name'  => 'nav_whatsapp_number',
                'type'  => 'text',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'tc-site-header',
                ],
            ],
        ],
        'menu_order'      => 0,
        'position'        => 'normal',
        'style'           => 'default',
        'label_placement' => 'top',
        'active'          => true,
    ]);

    /* =====================================================================
     * GROUP 2: Hero Carousel
     * ===================================================================== */
    acf_add_local_field_group([
        'key'    => 'group_hero_carousel',
        'title'  => 'Hero Carousel',
        'fields' => [
            [
                'key'          => 'field_hero_slides',
                'label'        => 'Slides',
                'name'         => 'hero_slides',
                'type'         => 'repeater',
                'min'          => 1,
                'max'          => 5,
                'layout'       => 'block',
                'button_label' => 'Add slide',
                'sub_fields'   => [
                    [
                        'key'           => 'field_hero_slides_image',
                        'label'         => 'Image (desktop, 2560x1440 recommended)',
                        'name'          => 'slide_image',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'medium',
                        'library'       => 'all',
                    ],
                    [
                        'key'           => 'field_hero_slides_image_mobile',
                        'label'         => 'Image (mobile override, optional, 1080x1920 portrait)',
                        'name'          => 'slide_image_mobile',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'medium',
                        'library'       => 'all',
                    ],
                    [
                        'key'   => 'field_hero_slides_eyebrow_text',
                        'label' => 'Eyebrow text (uppercase auto-applied)',
                        'name'  => 'slide_eyebrow_text',
                        'type'  => 'text',
                    ],
                ],
            ],
            [
                'key'           => 'field_hero_headline',
                'label'         => 'Headline (static across all slides)',
                'name'          => 'hero_headline',
                'type'          => 'text',
                'default_value' => 'Elevate your space.',
            ],
            [
                'key'           => 'field_hero_subheadline',
                'label'         => 'Subheadline',
                'name'          => 'hero_subheadline',
                'type'          => 'textarea',
                'rows'          => 2,
                'default_value' => 'From foundations to finishing touches — your complete destination for building, interiors and decor across Kenya.',
            ],
            [
                'key'           => 'field_hero_cta_primary_label',
                'label'         => 'Primary CTA Label',
                'name'          => 'hero_cta_primary_label',
                'type'          => 'text',
                'default_value' => 'Explore our solutions',
            ],
            [
                'key'           => 'field_hero_cta_primary_url',
                'label'         => 'Primary CTA URL',
                'name'          => 'hero_cta_primary_url',
                'type'          => 'link',
                'return_format' => 'url',
            ],
            [
                'key'           => 'field_hero_cta_secondary_label',
                'label'         => 'Secondary CTA Label',
                'name'          => 'hero_cta_secondary_label',
                'type'          => 'text',
                'default_value' => 'Find a showroom',
            ],
            [
                'key'           => 'field_hero_cta_secondary_url',
                'label'         => 'Secondary CTA URL',
                'name'          => 'hero_cta_secondary_url',
                'type'          => 'link',
                'return_format' => 'url',
            ],
            [
                'key'           => 'field_hero_autoplay_seconds',
                'label'         => 'Auto-rotate every (seconds)',
                'name'          => 'hero_autoplay_seconds',
                'type'          => 'number',
                'default_value' => 6,
                'min'           => 3,
                'max'           => 30,
            ],
            [
                'key'           => 'field_hero_show_dots',
                'label'         => 'Show Dots',
                'name'          => 'hero_show_dots',
                'type'          => 'true_false',
                'ui'            => 1,
                'default_value' => 1,
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                ],
            ],
        ],
        'menu_order'      => 1,
        'position'        => 'normal',
        'style'           => 'default',
        'label_placement' => 'top',
        'active'          => true,
    ]);

    /* =====================================================================
     * GROUP 3: Ecosystem Cards
     * ===================================================================== */
    acf_add_local_field_group([
        'key'    => 'group_ecosystem_cards',
        'title'  => 'Ecosystem Cards',
        'fields' => [
            [
                'key'           => 'field_eco_section_eyebrow',
                'label'         => 'Section Eyebrow',
                'name'          => 'ecosystem_section_eyebrow',
                'type'          => 'text',
                'default_value' => 'Three ecosystems',
            ],
            [
                'key'           => 'field_eco_section_heading',
                'label'         => 'Section Heading',
                'name'          => 'ecosystem_section_heading',
                'type'          => 'text',
                'default_value' => 'How we work with you.',
            ],
            [
                'key'           => 'field_eco_section_intro',
                'label'         => 'Section Intro',
                'name'          => 'ecosystem_section_intro',
                'type'          => 'textarea',
                'rows'          => 2,
                'default_value' => 'From foundation to finishing, organised the way you actually build.',
            ],
            [
                'key'          => 'field_eco_cards',
                'label'        => 'Cards',
                'name'         => 'ecosystem_cards',
                'type'         => 'repeater',
                'min'          => 3,
                'max'          => 3,
                'layout'       => 'block',
                'button_label' => 'Add card',
                'sub_fields'   => [
                    [
                        'key'   => 'field_eco_cards_number_label',
                        'label' => 'Number label',
                        'name'  => 'card_number_label',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_eco_cards_phase_label',
                        'label' => 'Phase label (e.g. BUILD, DESIGN, STYLE)',
                        'name'  => 'card_phase_label',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_eco_cards_name',
                        'label' => 'Name',
                        'name'  => 'card_name',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_eco_cards_description',
                        'label' => 'Description (~15 words)',
                        'name'  => 'card_description',
                        'type'  => 'textarea',
                        'rows'  => 2,
                    ],
                    [
                        'key'           => 'field_eco_cards_link_url',
                        'label'         => 'Link URL',
                        'name'          => 'card_link_url',
                        'type'          => 'link',
                        'return_format' => 'url',
                    ],
                    [
                        'key'           => 'field_eco_cards_link_label',
                        'label'         => 'Link Label',
                        'name'          => 'card_link_label',
                        'type'          => 'text',
                        'default_value' => 'Explore',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                ],
            ],
        ],
        'menu_order'      => 2,
        'position'        => 'normal',
        'style'           => 'default',
        'label_placement' => 'top',
        'active'          => true,
    ]);

});