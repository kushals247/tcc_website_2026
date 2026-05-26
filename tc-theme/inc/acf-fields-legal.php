<?php
/**
 * ACF Field Group: Legal Page Content
 * Attached to page-legal.php template.
 */
if (!defined('ABSPATH')) exit;
if (!function_exists('acf_add_local_field_group')) return;

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group(array(
        'key' => 'group_legal_content',
        'title' => 'Legal Page Content',
        'fields' => array(
            array(
                'key' => 'field_legal_eyebrow',
                'label' => 'Eyebrow',
                'name' => 'legal_eyebrow',
                'type' => 'text',
                'default_value' => 'LEGAL',
            ),
            array(
                'key' => 'field_legal_subline',
                'label' => 'Subline',
                'name' => 'legal_subline',
                'type' => 'text',
            ),
            array(
                'key' => 'field_legal_last_updated',
                'label' => 'Last Updated',
                'name' => 'legal_last_updated',
                'type' => 'text',
                'default_value' => '2026-05-25',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-legal.php',
                ),
            ),
        ),
        'menu_order' => 21,
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ));
});