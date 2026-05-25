<?php
/**
 * ACF Field Groups - Phase 2.4b Inspiration System
 *
 * group_inspiration_hub: Inspiration Hub page (page-inspiration.php)
 * group_article_extras: Extras for post_type=post
 */

if (!defined('ABSPATH')) exit;

if (!function_exists('acf_add_local_field_group')) return;

add_action('acf/init', function() {

    // ---------------------------------------------------------------
    // Group 1: Inspiration Hub (page-inspiration.php)
    // ---------------------------------------------------------------
    acf_add_local_field_group([
        'key'    => 'group_inspiration_hub',
        'title'  => 'Inspiration Hub',
        'fields' => [
            [
                'key'   => 'field_insp_hero_image',
                'label' => 'Hero Image URL',
                'name'  => 'insp_hero_image',
                'type'  => 'url',
            ],
            [
                'key'     => 'field_insp_hero_eyebrow',
                'label'   => 'Hero Eyebrow',
                'name'    => 'insp_hero_eyebrow',
                'type'    => 'text',
                'default_value' => 'INSPIRATION',
            ],
            [
                'key'     => 'field_insp_hero_headline',
                'label'   => 'Hero Headline',
                'name'    => 'insp_hero_headline',
                'type'    => 'text',
                'default_value' => 'Ideas, guides and project stories.',
            ],
            [
                'key'   => 'field_insp_hero_subline',
                'label' => 'Hero Subline',
                'name'  => 'insp_hero_subline',
                'type'  => 'textarea',
                'rows'  => 2,
            ],
            [
                'key'   => 'field_insp_intro_body',
                'label' => 'Intro Body',
                'name'  => 'insp_intro_body',
                'type'  => 'textarea',
            ],
            [
                'key'     => 'field_insp_pagination_per_page',
                'label'   => 'Articles per page',
                'name'    => 'insp_pagination_per_page',
                'type'    => 'number',
                'default_value' => 9,
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page-inspiration.php',
                ],
            ],
        ],
        'menu_order' => 16,
        'position'   => 'normal',
        'style'      => 'default',
    ]);

    // ---------------------------------------------------------------
    // Group 2: Article Extras (post_type = post)
    // ---------------------------------------------------------------
    acf_add_local_field_group([
        'key'    => 'group_article_extras',
        'title'  => 'Article Extras',
        'fields' => [
            [
                'key'   => 'field_article_subtitle',
                'label' => 'Subtitle',
                'name'  => 'article_subtitle',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_article_hero_image',
                'label' => 'Hero Image URL',
                'name'  => 'article_hero_image',
                'type'  => 'url',
            ],
            [
                'key'   => 'field_article_read_time',
                'label' => 'Read Time (minutes)',
                'name'  => 'article_read_time',
                'type'  => 'number',
            ],
            [
                'key'     => 'field_article_author_name',
                'label'   => 'Author Name',
                'name'    => 'article_author_name',
                'type'    => 'text',
                'default_value' => 'T&C Editorial Team',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'post',
                ],
            ],
        ],
        'menu_order' => 17,
        'position'   => 'normal',
        'style'      => 'default',
    ]);

});