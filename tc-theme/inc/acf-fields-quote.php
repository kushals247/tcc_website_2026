<?php
/**
 * ACF field group for Phase 2.4d Quote Page (page-quote.php).
 */

if (!defined('ABSPATH')) exit;

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key'      => 'group_quote_content',
        'title'    => 'Quote Page Content',
        'location' => [[
            [
                'param'    => 'page_template',
                'operator' => '==',
                'value'    => 'page-quote.php',
            ],
        ]],
        'menu_order' => 20,
        'position'   => 'normal',
        'style'      => 'default',
        'label_placement' => 'top',
        'fields' => [
            // Hero
            [
                'key'   => 'field_quote_hero_image',
                'label' => 'Hero image (URL)',
                'name'  => 'quote_hero_image',
                'type'  => 'url',
            ],
            [
                'key'   => 'field_quote_hero_eyebrow',
                'label' => 'Hero eyebrow',
                'name'  => 'quote_hero_eyebrow',
                'type'  => 'text',
                'default_value' => 'REQUEST A QUOTE',
            ],
            [
                'key'   => 'field_quote_hero_headline',
                'label' => 'Hero headline',
                'name'  => 'quote_hero_headline',
                'type'  => 'text',
                'default_value' => 'Tell us about your project.',
            ],
            [
                'key'   => 'field_quote_hero_subline',
                'label' => 'Hero subline',
                'name'  => 'quote_hero_subline',
                'type'  => 'textarea',
                'rows'  => 3,
                'default_value' => 'We respond to every enquiry within one business day. The more detail you can share, the more useful our first reply.',
            ],

            // Steps
            [
                'key'   => 'field_quote_steps_heading',
                'label' => 'Steps heading',
                'name'  => 'quote_steps_heading',
                'type'  => 'text',
                'default_value' => 'What happens next.',
            ],
            [
                'key'        => 'field_quote_steps_items',
                'label'      => 'Steps items',
                'name'       => 'quote_steps_items',
                'type'       => 'repeater',
                'min'        => 2,
                'max'        => 6,
                'layout'     => 'block',
                'button_label' => 'Add step',
                'sub_fields' => [
                    [
                        'key'   => 'field_quote_step_number',
                        'label' => 'Step number',
                        'name'  => 'step_number',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_quote_step_title',
                        'label' => 'Step title',
                        'name'  => 'step_title',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_quote_step_body',
                        'label' => 'Step body',
                        'name'  => 'step_body',
                        'type'  => 'textarea',
                        'rows'  => 2,
                    ],
                ],
            ],

            // Secondary methods
            [
                'key'   => 'field_quote_secondary_methods_heading',
                'label' => 'Secondary methods heading',
                'name'  => 'quote_secondary_methods_heading',
                'type'  => 'text',
                'default_value' => 'Prefer to call or message?',
            ],

            // Form
            [
                'key'   => 'field_quote_form_shortcode',
                'label' => 'Quote form shortcode',
                'name'  => 'quote_form_shortcode',
                'type'  => 'text',
                'instructions' => 'CF7 shortcode, e.g. [contact-form-7 id="123" title="Quote"]',
            ],

            // Trust strip
            [
                'key'   => 'field_quote_trust_heading',
                'label' => 'Trust strip heading',
                'name'  => 'quote_trust_heading',
                'type'  => 'text',
                'default_value' => 'Prefer to visit in person?',
            ],
            [
                'key'   => 'field_quote_trust_body',
                'label' => 'Trust strip body',
                'name'  => 'quote_trust_body',
                'type'  => 'textarea',
                'rows'  => 3,
            ],
        ],
    ]);
});