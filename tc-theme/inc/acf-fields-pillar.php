<?php
/**
 * ACF field groups for Phase 2.3 Pillar Pages.
 * - Pillar Page Content (page-pillar.php)
 * - Sub-cat Shell Content (page-subcat-shell.php)
 */

if (!defined('ABSPATH')) exit;

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    $ecosystem_choices = [
        'structure-essentials' => 'Structure Essentials',
        'surfaces-finishes'    => 'Surfaces & Finishes',
        'softs-decor'          => 'Softs & Decor',
    ];

    // ============================================================
    // GROUP 1: Pillar Page Content
    // ============================================================
    acf_add_local_field_group([
        'key'      => 'group_pillar_content',
        'title'    => 'Pillar Page Content',
        'location' => [[
            [
                'param'    => 'page_template',
                'operator' => '==',
                'value'    => 'page-pillar.php',
            ],
        ]],
        'menu_order' => 11,
        'position'   => 'normal',
        'style'      => 'default',
        'label_placement' => 'top',
        'fields' => [
            // Hero
            [
                'key' => 'field_pillar_hero_image',
                'label' => 'Hero image',
                'name' => 'pillar_hero_image',
                'type' => 'url',
            ],
            [
                'key' => 'field_pillar_hero_name',
                'label' => 'Hero name (ecosystem name)',
                'name' => 'pillar_hero_name',
                'type' => 'text',
            ],
            [
                'key' => 'field_pillar_hero_pov',
                'label' => 'Hero point of view',
                'name' => 'pillar_hero_pov',
                'type' => 'textarea',
                'rows' => 2,
            ],

            // Positioning
            [
                'key' => 'field_pillar_positioning_eyebrow',
                'label' => 'Positioning eyebrow',
                'name' => 'pillar_positioning_eyebrow',
                'type' => 'text',
                'default_value' => 'OUR APPROACH',
            ],
            [
                'key' => 'field_pillar_positioning_heading',
                'label' => 'Positioning heading',
                'name' => 'pillar_positioning_heading',
                'type' => 'text',
            ],
            [
                'key' => 'field_pillar_positioning_body',
                'label' => 'Positioning body',
                'name' => 'pillar_positioning_body',
                'type' => 'textarea',
            ],

            // Sub-category grid
            [
                'key' => 'field_pillar_subcat_eyebrow',
                'label' => 'Sub-cat eyebrow',
                'name' => 'pillar_subcat_eyebrow',
                'type' => 'text',
                'default_value' => 'EXPLORE',
            ],
            [
                'key' => 'field_pillar_subcat_heading',
                'label' => 'Sub-cat heading',
                'name' => 'pillar_subcat_heading',
                'type' => 'text',
            ],
            [
                'key' => 'field_pillar_subcat_intro',
                'label' => 'Sub-cat intro',
                'name' => 'pillar_subcat_intro',
                'type' => 'textarea',
            ],
            [
                'key' => 'field_pillar_subcat_items',
                'label' => 'Sub-cat items',
                'name' => 'pillar_subcat_items',
                'type' => 'repeater',
                'min' => 4,
                'max' => 6,
                'layout' => 'block',
                'button_label' => 'Add sub-cat item',
                'sub_fields' => [
                    [
                        'key' => 'field_pillar_subcat_item_image',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'url',
                    ],
                    [
                        'key' => 'field_pillar_subcat_item_name',
                        'label' => 'Name',
                        'name' => 'name',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_pillar_subcat_item_description',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                    ],
                    [
                        'key' => 'field_pillar_subcat_item_link_url',
                        'label' => 'Link URL',
                        'name' => 'link_url',
                        'type' => 'text',
                    ],
                ],
            ],

            // Advisory
            [
                'key' => 'field_pillar_advisory_eyebrow',
                'label' => 'Advisory eyebrow',
                'name' => 'pillar_advisory_eyebrow',
                'type' => 'text',
                'default_value' => 'THINK ABOUT THIS',
            ],
            [
                'key' => 'field_pillar_advisory_heading',
                'label' => 'Advisory heading',
                'name' => 'pillar_advisory_heading',
                'type' => 'text',
            ],
            [
                'key' => 'field_pillar_advisory_items',
                'label' => 'Advisory items',
                'name' => 'pillar_advisory_items',
                'type' => 'repeater',
                'min' => 1,
                'max' => 2,
                'layout' => 'block',
                'button_label' => 'Add advisory item',
                'sub_fields' => [
                    [
                        'key' => 'field_pillar_advisory_icon_svg',
                        'label' => 'Icon SVG',
                        'name' => 'icon_svg',
                        'type' => 'textarea',
                    ],
                    [
                        'key' => 'field_pillar_advisory_headline',
                        'label' => 'Headline',
                        'name' => 'headline',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_pillar_advisory_body',
                        'label' => 'Body',
                        'name' => 'body',
                        'type' => 'textarea',
                    ],
                ],
            ],

            // Brands
            [
                'key' => 'field_pillar_brands_eyebrow',
                'label' => 'Brands eyebrow',
                'name' => 'pillar_brands_eyebrow',
                'type' => 'text',
                'default_value' => 'OUR PARTNERS',
            ],
            [
                'key' => 'field_pillar_brands_heading',
                'label' => 'Brands heading',
                'name' => 'pillar_brands_heading',
                'type' => 'text',
            ],
            [
                'key' => 'field_pillar_ecosystem_slug',
                'label' => 'Ecosystem slug',
                'name' => 'pillar_ecosystem_slug',
                'type' => 'select',
                'choices' => $ecosystem_choices,
                'instructions' => 'Used to filter brand_partners by ecosystem checkbox.',
            ],

            // Project showcase
            [
                'key' => 'field_pillar_project_image',
                'label' => 'Project image',
                'name' => 'pillar_project_image',
                'type' => 'url',
            ],
            [
                'key' => 'field_pillar_project_name',
                'label' => 'Project name',
                'name' => 'pillar_project_name',
                'type' => 'text',
            ],
            [
                'key' => 'field_pillar_project_type',
                'label' => 'Project type',
                'name' => 'pillar_project_type',
                'type' => 'text',
            ],
            [
                'key' => 'field_pillar_project_location',
                'label' => 'Project location',
                'name' => 'pillar_project_location',
                'type' => 'text',
            ],
            [
                'key' => 'field_pillar_project_writeup',
                'label' => 'Project write-up',
                'name' => 'pillar_project_writeup',
                'type' => 'textarea',
            ],
            [
                'key' => 'field_pillar_project_link',
                'label' => 'Project link',
                'name' => 'pillar_project_link',
                'type' => 'link',
            ],

            // Articles
            [
                'key' => 'field_pillar_articles_eyebrow',
                'label' => 'Articles eyebrow',
                'name' => 'pillar_articles_eyebrow',
                'type' => 'text',
                'default_value' => 'READ MORE',
            ],
            [
                'key' => 'field_pillar_articles_heading',
                'label' => 'Articles heading',
                'name' => 'pillar_articles_heading',
                'type' => 'text',
            ],
            [
                'key' => 'field_pillar_articles_fallback',
                'label' => 'Articles fallback',
                'name' => 'pillar_articles_fallback',
                'type' => 'repeater',
                'min' => 3,
                'max' => 3,
                'layout' => 'block',
                'button_label' => 'Add article',
                'sub_fields' => [
                    [
                        'key' => 'field_pillar_article_image',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'url',
                    ],
                    [
                        'key' => 'field_pillar_article_category',
                        'label' => 'Category',
                        'name' => 'category',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_pillar_article_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_pillar_article_excerpt',
                        'label' => 'Excerpt',
                        'name' => 'excerpt',
                        'type' => 'textarea',
                    ],
                    [
                        'key' => 'field_pillar_article_link_url',
                        'label' => 'Link URL',
                        'name' => 'link_url',
                        'type' => 'text',
                    ],
                ],
            ],

            // CTA strip
            [
                'key' => 'field_pillar_cta_eyebrow',
                'label' => 'CTA eyebrow',
                'name' => 'pillar_cta_eyebrow',
                'type' => 'text',
                'default_value' => 'NEXT STEP',
            ],
            [
                'key' => 'field_pillar_cta_heading',
                'label' => 'CTA heading',
                'name' => 'pillar_cta_heading',
                'type' => 'text',
                'default_value' => 'Ready to start your project?',
            ],
            [
                'key' => 'field_pillar_cta_body',
                'label' => 'CTA body',
                'name' => 'pillar_cta_body',
                'type' => 'textarea',
            ],
        ],
    ]);

    // ============================================================
    // GROUP 2: Sub-cat Shell Content
    // ============================================================
    acf_add_local_field_group([
        'key'      => 'group_subcat_shell_content',
        'title'    => 'Sub-cat Shell Content',
        'location' => [[
            [
                'param'    => 'page_template',
                'operator' => '==',
                'value'    => 'page-subcat-shell.php',
            ],
        ]],
        'menu_order' => 12,
        'position'   => 'normal',
        'style'      => 'default',
        'label_placement' => 'top',
        'fields' => [
            [
                'key' => 'field_subcat_hero_image',
                'label' => 'Hero image',
                'name' => 'subcat_hero_image',
                'type' => 'url',
            ],
            [
                'key' => 'field_subcat_name',
                'label' => 'Sub-cat name',
                'name' => 'subcat_name',
                'type' => 'text',
            ],
            [
                'key' => 'field_subcat_parent_ecosystem',
                'label' => 'Parent ecosystem',
                'name' => 'subcat_parent_ecosystem',
                'type' => 'select',
                'choices' => $ecosystem_choices,
            ],
            [
                'key' => 'field_subcat_body_eyebrow',
                'label' => 'Body eyebrow',
                'name' => 'subcat_body_eyebrow',
                'type' => 'text',
                'default_value' => 'COMING SOON',
            ],
            [
                'key' => 'field_subcat_body_heading',
                'label' => 'Body heading',
                'name' => 'subcat_body_heading',
                'type' => 'text',
                'default_value' => "We're uploading our catalogue.",
            ],
            [
                'key' => 'field_subcat_body_paragraphs',
                'label' => 'Body paragraphs',
                'name' => 'subcat_body_paragraphs',
                'type' => 'textarea',
                'rows' => 4,
            ],
            [
                'key' => 'field_subcat_applications',
                'label' => 'Applications',
                'name' => 'subcat_applications',
                'type' => 'repeater',
                'min' => 4,
                'max' => 6,
                'layout' => 'block',
                'button_label' => 'Add application',
                'sub_fields' => [
                    [
                        'key' => 'field_subcat_application_text',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'key' => 'field_subcat_back_link_label',
                'label' => 'Back link label',
                'name' => 'subcat_back_link_label',
                'type' => 'text',
                'default_value' => '← Back to ecosystem',
            ],
        ],
    ]);
});