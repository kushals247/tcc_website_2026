<?php
/**
 * ACF Field Groups - Phase 2.4a Info Pages
 * About / Store Locator / Contact
 */

if (!defined('ABSPATH')) exit;
if (!function_exists('acf_add_local_field_group')) return;

add_action('acf/init', function() {

    // =========================================================
    // GROUP 1: ABOUT PAGE CONTENT
    // =========================================================
    acf_add_local_field_group([
        'key' => 'group_about_content',
        'title' => 'About Page Content',
        'fields' => [
            ['key' => 'field_about_hero_image', 'label' => 'Hero Image (URL)', 'name' => 'about_hero_image', 'type' => 'url'],
            ['key' => 'field_about_hero_headline', 'label' => 'Hero Headline', 'name' => 'about_hero_headline', 'type' => 'text'],
            ['key' => 'field_about_hero_subline', 'label' => 'Hero Subline', 'name' => 'about_hero_subline', 'type' => 'textarea', 'rows' => 2],

            ['key' => 'field_about_philosophy_eyebrow', 'label' => 'Philosophy Eyebrow', 'name' => 'about_philosophy_eyebrow', 'type' => 'text', 'default_value' => 'OUR PHILOSOPHY'],
            ['key' => 'field_about_philosophy_heading', 'label' => 'Philosophy Heading', 'name' => 'about_philosophy_heading', 'type' => 'text'],
            ['key' => 'field_about_philosophy_body', 'label' => 'Philosophy Body', 'name' => 'about_philosophy_body', 'type' => 'textarea'],

            ['key' => 'field_about_scale_eyebrow', 'label' => 'Scale Strip Eyebrow', 'name' => 'about_scale_eyebrow', 'type' => 'text', 'default_value' => 'BY THE NUMBERS'],
            ['key' => 'field_about_scale_heading', 'label' => 'Scale Strip Heading', 'name' => 'about_scale_heading', 'type' => 'text'],
            [
                'key' => 'field_about_scale_stats', 'label' => 'Scale Stats', 'name' => 'about_scale_stats', 'type' => 'repeater',
                'min' => 3, 'max' => 6, 'layout' => 'block',
                'sub_fields' => [
                    ['key' => 'field_about_scale_stats_number', 'label' => 'Number', 'name' => 'number', 'type' => 'text'],
                    ['key' => 'field_about_scale_stats_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text'],
                ],
            ],

            ['key' => 'field_about_ecosystems_eyebrow', 'label' => 'Ecosystems Eyebrow', 'name' => 'about_ecosystems_eyebrow', 'type' => 'text', 'default_value' => 'WHAT WE DO'],
            ['key' => 'field_about_ecosystems_heading', 'label' => 'Ecosystems Heading', 'name' => 'about_ecosystems_heading', 'type' => 'text'],
            ['key' => 'field_about_ecosystems_intro', 'label' => 'Ecosystems Intro', 'name' => 'about_ecosystems_intro', 'type' => 'textarea'],

            ['key' => 'field_about_manuf_eyebrow', 'label' => 'Manufacturing Eyebrow', 'name' => 'about_manuf_eyebrow', 'type' => 'text', 'default_value' => 'BUILT IN HOUSE'],
            ['key' => 'field_about_manuf_heading', 'label' => 'Manufacturing Heading', 'name' => 'about_manuf_heading', 'type' => 'text'],
            ['key' => 'field_about_manuf_intro', 'label' => 'Manufacturing Intro', 'name' => 'about_manuf_intro', 'type' => 'textarea'],
            [
                'key' => 'field_about_manuf_brands', 'label' => 'Manufacturing Brands', 'name' => 'about_manuf_brands', 'type' => 'repeater',
                'min' => 4, 'max' => 12, 'layout' => 'block',
                'sub_fields' => [
                    ['key' => 'field_about_manuf_brands_name', 'label' => 'Name', 'name' => 'name', 'type' => 'text'],
                    ['key' => 'field_about_manuf_brands_description', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea'],
                    ['key' => 'field_about_manuf_brands_logo_image', 'label' => 'Logo Image (URL)', 'name' => 'logo_image', 'type' => 'url'],
                ],
            ],

            ['key' => 'field_about_footprint_eyebrow', 'label' => 'Footprint Eyebrow', 'name' => 'about_footprint_eyebrow', 'type' => 'text', 'default_value' => 'WHERE WE OPERATE'],
            ['key' => 'field_about_footprint_heading', 'label' => 'Footprint Heading', 'name' => 'about_footprint_heading', 'type' => 'text'],
            [
                'key' => 'field_about_footprint_regions', 'label' => 'Footprint Regions', 'name' => 'about_footprint_regions', 'type' => 'repeater',
                'min' => 3, 'max' => 6, 'layout' => 'block',
                'sub_fields' => [
                    ['key' => 'field_about_footprint_regions_region_name', 'label' => 'Region Name', 'name' => 'region_name', 'type' => 'text'],
                    ['key' => 'field_about_footprint_regions_locations', 'label' => 'Locations', 'name' => 'locations', 'type' => 'textarea'],
                    [
                        'key' => 'field_about_footprint_regions_emphasis', 'label' => 'Emphasis', 'name' => 'emphasis', 'type' => 'select',
                        'choices' => ['home' => 'Home', 'sister' => 'Sister', 'sourcing' => 'Sourcing', 'hub' => 'Hub'],
                    ],
                ],
            ],

            ['key' => 'field_about_projects_eyebrow', 'label' => 'Projects Eyebrow', 'name' => 'about_projects_eyebrow', 'type' => 'text', 'default_value' => 'WHO WE WORK WITH'],
            ['key' => 'field_about_projects_heading', 'label' => 'Projects Heading', 'name' => 'about_projects_heading', 'type' => 'text'],
            [
                'key' => 'field_about_projects_items', 'label' => 'Projects Items', 'name' => 'about_projects_items', 'type' => 'repeater',
                'min' => 4, 'max' => 8, 'layout' => 'block',
                'sub_fields' => [
                    ['key' => 'field_about_projects_items_image', 'label' => 'Image (URL)', 'name' => 'image', 'type' => 'url'],
                    ['key' => 'field_about_projects_items_project_type', 'label' => 'Project Type', 'name' => 'project_type', 'type' => 'text'],
                    ['key' => 'field_about_projects_items_name', 'label' => 'Name', 'name' => 'name', 'type' => 'text'],
                    ['key' => 'field_about_projects_items_location', 'label' => 'Location', 'name' => 'location', 'type' => 'text'],
                    ['key' => 'field_about_projects_items_notes', 'label' => 'Notes', 'name' => 'notes', 'type' => 'textarea'],
                ],
            ],

            ['key' => 'field_about_sisters_eyebrow', 'label' => 'Sisters Eyebrow', 'name' => 'about_sisters_eyebrow', 'type' => 'text', 'default_value' => 'THE BROADER GROUP'],
            ['key' => 'field_about_sisters_heading', 'label' => 'Sisters Heading', 'name' => 'about_sisters_heading', 'type' => 'text'],
            [
                'key' => 'field_about_sisters_items', 'label' => 'Sister Companies', 'name' => 'about_sisters_items', 'type' => 'repeater',
                'min' => 2, 'max' => 6, 'layout' => 'block',
                'sub_fields' => [
                    ['key' => 'field_about_sisters_items_name', 'label' => 'Name', 'name' => 'name', 'type' => 'text'],
                    ['key' => 'field_about_sisters_items_description', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea'],
                    ['key' => 'field_about_sisters_items_url', 'label' => 'URL', 'name' => 'url', 'type' => 'text'],
                ],
            ],

            ['key' => 'field_about_cta_eyebrow', 'label' => 'CTA Eyebrow', 'name' => 'about_cta_eyebrow', 'type' => 'text', 'default_value' => 'WORK WITH US'],
            ['key' => 'field_about_cta_heading', 'label' => 'CTA Heading', 'name' => 'about_cta_heading', 'type' => 'text'],
            ['key' => 'field_about_cta_body', 'label' => 'CTA Body', 'name' => 'about_cta_body', 'type' => 'textarea'],
        ],
        'location' => [[[
            'param' => 'page_template', 'operator' => '==', 'value' => 'page-about.php',
        ]]],
        'menu_order' => 13,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'active' => true,
    ]);

    // =========================================================
    // GROUP 2: STORE LOCATOR PAGE CONTENT
    // =========================================================
    acf_add_local_field_group([
        'key' => 'group_locator_content',
        'title' => 'Store Locator Page Content',
        'fields' => [
            ['key' => 'field_locator_hero_image', 'label' => 'Hero Image (URL)', 'name' => 'locator_hero_image', 'type' => 'url'],
            ['key' => 'field_locator_hero_headline', 'label' => 'Hero Headline', 'name' => 'locator_hero_headline', 'type' => 'text'],
            ['key' => 'field_locator_hero_subline', 'label' => 'Hero Subline', 'name' => 'locator_hero_subline', 'type' => 'textarea'],

            ['key' => 'field_locator_tc_eyebrow', 'label' => 'T&C Eyebrow', 'name' => 'locator_tc_eyebrow', 'type' => 'text', 'default_value' => 'T&C BRANCHES'],
            ['key' => 'field_locator_tc_heading', 'label' => 'T&C Heading', 'name' => 'locator_tc_heading', 'type' => 'text', 'default_value' => 'Our branches across Kenya'],
            [
                'key' => 'field_locator_tc_branches', 'label' => 'T&C Branches', 'name' => 'locator_tc_branches', 'type' => 'repeater',
                'min' => 1, 'max' => 10, 'layout' => 'block',
                'sub_fields' => [
                    ['key' => 'field_locator_tc_branches_name', 'label' => 'Name', 'name' => 'name', 'type' => 'text'],
                    ['key' => 'field_locator_tc_branches_image', 'label' => 'Image (URL)', 'name' => 'image', 'type' => 'url'],
                    ['key' => 'field_locator_tc_branches_address', 'label' => 'Address', 'name' => 'address', 'type' => 'textarea'],
                    ['key' => 'field_locator_tc_branches_phone', 'label' => 'Phone', 'name' => 'phone', 'type' => 'text'],
                    ['key' => 'field_locator_tc_branches_whatsapp', 'label' => 'WhatsApp', 'name' => 'whatsapp', 'type' => 'text'],
                    ['key' => 'field_locator_tc_branches_hours', 'label' => 'Hours', 'name' => 'hours', 'type' => 'textarea'],
                    ['key' => 'field_locator_tc_branches_maps_url', 'label' => 'Maps URL', 'name' => 'maps_url', 'type' => 'text'],
                    ['key' => 'field_locator_tc_branches_badge', 'label' => 'Badge', 'name' => 'badge', 'type' => 'text'],
                ],
            ],

            ['key' => 'field_locator_tacc_eyebrow', 'label' => 'TACC Eyebrow', 'name' => 'locator_tacc_eyebrow', 'type' => 'text', 'default_value' => 'LOOKING FOR CASH-AND-CARRY?'],
            ['key' => 'field_locator_tacc_heading', 'label' => 'TACC Heading', 'name' => 'locator_tacc_heading', 'type' => 'text', 'default_value' => 'Visit a TACC retail store'],
            ['key' => 'field_locator_tacc_body', 'label' => 'TACC Body', 'name' => 'locator_tacc_body', 'type' => 'textarea'],
            [
                'key' => 'field_locator_tacc_branches', 'label' => 'TACC Branches', 'name' => 'locator_tacc_branches', 'type' => 'repeater',
                'min' => 1, 'max' => 10, 'layout' => 'block',
                'sub_fields' => [
                    ['key' => 'field_locator_tacc_branches_name', 'label' => 'Name', 'name' => 'name', 'type' => 'text'],
                    ['key' => 'field_locator_tacc_branches_address', 'label' => 'Address', 'name' => 'address', 'type' => 'textarea'],
                    ['key' => 'field_locator_tacc_branches_maps_url', 'label' => 'Maps URL', 'name' => 'maps_url', 'type' => 'text'],
                ],
            ],
            ['key' => 'field_locator_tacc_cta_label', 'label' => 'TACC CTA Label', 'name' => 'locator_tacc_cta_label', 'type' => 'text', 'default_value' => 'Visit tacc.co.ke →'],
            ['key' => 'field_locator_tacc_cta_url', 'label' => 'TACC CTA URL', 'name' => 'locator_tacc_cta_url', 'type' => 'text', 'default_value' => 'https://tacc.co.ke'],

            ['key' => 'field_locator_cta_eyebrow', 'label' => 'CTA Eyebrow', 'name' => 'locator_cta_eyebrow', 'type' => 'text', 'default_value' => "CAN'T VISIT IN PERSON?"],
            ['key' => 'field_locator_cta_heading', 'label' => 'CTA Heading', 'name' => 'locator_cta_heading', 'type' => 'text'],
            ['key' => 'field_locator_cta_body', 'label' => 'CTA Body', 'name' => 'locator_cta_body', 'type' => 'textarea'],
        ],
        'location' => [[[
            'param' => 'page_template', 'operator' => '==', 'value' => 'page-store-locator.php',
        ]]],
        'menu_order' => 14,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'active' => true,
    ]);

    // =========================================================
    // GROUP 3: CONTACT PAGE CONTENT
    // =========================================================
    acf_add_local_field_group([
        'key' => 'group_contact_content',
        'title' => 'Contact Page Content',
        'fields' => [
            ['key' => 'field_contact_hero_image', 'label' => 'Hero Image (URL)', 'name' => 'contact_hero_image', 'type' => 'url'],
            ['key' => 'field_contact_hero_headline', 'label' => 'Hero Headline', 'name' => 'contact_hero_headline', 'type' => 'text', 'default_value' => 'Get in touch'],
            ['key' => 'field_contact_hero_subline', 'label' => 'Hero Subline', 'name' => 'contact_hero_subline', 'type' => 'textarea', 'default_value' => 'We respond to enquiries within one business day.'],

            ['key' => 'field_contact_methods_heading', 'label' => 'Methods Heading', 'name' => 'contact_methods_heading', 'type' => 'text', 'default_value' => 'Direct contact'],
            ['key' => 'field_contact_phone', 'label' => 'Phone', 'name' => 'contact_phone', 'type' => 'text'],
            ['key' => 'field_contact_whatsapp_number', 'label' => 'WhatsApp Number', 'name' => 'contact_whatsapp_number', 'type' => 'text'],
            ['key' => 'field_contact_email', 'label' => 'Email', 'name' => 'contact_email', 'type' => 'text'],

            ['key' => 'field_contact_form_heading', 'label' => 'Form Heading', 'name' => 'contact_form_heading', 'type' => 'text', 'default_value' => 'Or send us a message'],
            ['key' => 'field_contact_form_shortcode', 'label' => 'Form Shortcode', 'name' => 'contact_form_shortcode', 'type' => 'text'],
            ['key' => 'field_contact_destination_email', 'label' => 'Destination Email', 'name' => 'contact_destination_email', 'type' => 'text'],

            ['key' => 'field_contact_hq_address', 'label' => 'HQ Address', 'name' => 'contact_hq_address', 'type' => 'textarea'],
            ['key' => 'field_contact_mombasa_address', 'label' => 'Mombasa Address', 'name' => 'contact_mombasa_address', 'type' => 'textarea'],
            ['key' => 'field_contact_hours', 'label' => 'Hours', 'name' => 'contact_hours', 'type' => 'textarea', 'default_value' => 'Showroom hours: Mon–Fri 8:30am–6pm · Sat 9am–5pm · Sun closed'],
        ],
        'location' => [[[
            'param' => 'page_template', 'operator' => '==', 'value' => 'page-contact.php',
        ]]],
        'menu_order' => 15,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'active' => true,
    ]);

});