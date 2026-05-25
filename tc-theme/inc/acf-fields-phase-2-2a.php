<?php
/**
 * ACF Field Groups - Phase 2.2a
 *
 * Registers field groups for: Mega Menu, Shop by Room, Brand Partners,
 * Site Footer, and WhatsApp Floating Button. Loaded from functions.php
 * via require_once when this file exists.
 *
 * @package tc-theme
 */

if (!defined('ABSPATH')) exit;
if (!function_exists('acf_add_local_field_group')) return;

add_action('acf/init', function() {

    // =========================================================================
    // 1) MEGA MENU - Options Page (tc-site-header)
    // =========================================================================
    acf_add_local_field_group(array(
        'key' => 'group_mega_menu',
        'title' => 'Mega Menu',
        'fields' => array(
            array(
                'key' => 'field_mm_ecosystems',
                'label' => 'Ecosystems',
                'name' => 'mega_menu_ecosystems',
                'type' => 'repeater',
                'min' => 3,
                'max' => 3,
                'layout' => 'block',
                'button_label' => 'Add Ecosystem',
                'sub_fields' => array(
                    array(
                        'key' => 'field_mm_eco_slug',
                        'label' => 'Slug',
                        'name' => 'slug',
                        'type' => 'select',
                        'choices' => array(
                            'structure' => 'Structure essentials',
                            'surfaces'  => 'Surfaces & finishes',
                            'softs'     => 'Softs & decor',
                        ),
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_mm_eco_eyebrow_label',
                        'label' => 'Eyebrow Label',
                        'name' => 'eyebrow_label',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_mm_eco_name',
                        'label' => 'Name',
                        'name' => 'name',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_mm_eco_description',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 2,
                    ),
                    array(
                        'key' => 'field_mm_eco_explore_all_url',
                        'label' => 'Explore All URL',
                        'name' => 'explore_all_url',
                        'type' => 'link',
                        'return_format' => 'url',
                    ),
                    array(
                        'key' => 'field_mm_eco_subcategories',
                        'label' => 'Subcategories',
                        'name' => 'subcategories',
                        'type' => 'repeater',
                        'layout' => 'table',
                        'button_label' => 'Add Subcategory',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_mm_sub_name',
                                'label' => 'Name',
                                'name' => 'name',
                                'type' => 'text',
                            ),
                            array(
                                'key' => 'field_mm_sub_icon_slug',
                                'label' => 'Icon Slug',
                                'name' => 'icon_slug',
                                'type' => 'text',
                                'default_value' => 'point',
                            ),
                            array(
                                'key' => 'field_mm_sub_url',
                                'label' => 'URL',
                                'name' => 'url',
                                'type' => 'link',
                                'return_format' => 'url',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_mm_eco_featured_heading',
                        'label' => 'Featured Heading',
                        'name' => 'featured_heading',
                        'type' => 'text',
                        'default_value' => 'Featured',
                    ),
                    array(
                        'key' => 'field_mm_eco_featured_items',
                        'label' => 'Featured Items',
                        'name' => 'featured_items',
                        'type' => 'repeater',
                        'layout' => 'table',
                        'button_label' => 'Add Featured Item',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_mm_feat_label',
                                'label' => 'Label',
                                'name' => 'label',
                                'type' => 'text',
                            ),
                            array(
                                'key' => 'field_mm_feat_image',
                                'label' => 'Image',
                                'name' => 'image',
                                'type' => 'image',
                                'return_format' => 'array',
                                'required' => 0,
                            ),
                            array(
                                'key' => 'field_mm_feat_url',
                                'label' => 'URL',
                                'name' => 'url',
                                'type' => 'link',
                                'return_format' => 'url',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_mm_shop_by_room_url',
                'label' => 'Shop by Room URL',
                'name' => 'megamenu_shop_by_room_url',
                'type' => 'text',
                'default_value' => '#shop-by-room',
            ),
            array(
                'key' => 'field_mm_brands_directory_url',
                'label' => 'Brands Directory URL',
                'name' => 'megamenu_brands_directory_url',
                'type' => 'link',
                'return_format' => 'url',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'tc-site-header',
                ),
            ),
        ),
        'menu_order' => 10,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'active' => true,
    ));

    // =========================================================================
    // 2) SHOP BY ROOM - Front Page
    // =========================================================================
    acf_add_local_field_group(array(
        'key' => 'group_shop_by_room',
        'title' => 'Shop by Room',
        'fields' => array(
            array(
                'key' => 'field_sbr_eyebrow',
                'label' => 'Eyebrow',
                'name' => 'shop_by_room_eyebrow',
                'type' => 'text',
                'default_value' => 'Shop by room',
            ),
            array(
                'key' => 'field_sbr_heading',
                'label' => 'Heading',
                'name' => 'shop_by_room_heading',
                'type' => 'text',
                'default_value' => 'Find what you need by space.',
            ),
            array(
                'key' => 'field_sbr_intro',
                'label' => 'Intro',
                'name' => 'shop_by_room_intro',
                'type' => 'textarea',
                'rows' => 2,
                'required' => 0,
            ),
            array(
                'key' => 'field_sbr_room_tiles',
                'label' => 'Room Tiles',
                'name' => 'room_tiles',
                'type' => 'repeater',
                'min' => 6,
                'max' => 6,
                'layout' => 'block',
                'button_label' => 'Add Room',
                'sub_fields' => array(
                    array(
                        'key' => 'field_sbr_tile_name',
                        'label' => 'Name',
                        'name' => 'name',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_sbr_tile_image',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                    ),
                    array(
                        'key' => 'field_sbr_tile_url',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'link',
                        'return_format' => 'url',
                    ),
                    array(
                        'key' => 'field_sbr_tile_description',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'text',
                        'required' => 0,
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
        ),
        'menu_order' => 5,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'active' => true,
    ));

    // =========================================================================
    // 3) BRAND PARTNERS - Front Page
    // =========================================================================
    acf_add_local_field_group(array(
        'key' => 'group_brand_partners',
        'title' => 'Brand Partners',
        'fields' => array(
            array(
                'key' => 'field_bp_view_all_url',
                'label' => 'View All URL',
                'name' => 'brand_strip_view_all_url',
                'type' => 'link',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_bp_logos',
                'label' => 'Brand Logos',
                'name' => 'brand_strip_logos',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Brand',
                'sub_fields' => array(
                    array(
                        'key' => 'field_bp_logo_name',
                        'label' => 'Name',
                        'name' => 'name',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_bp_logo_image',
                        'label' => 'Logo',
                        'name' => 'logo',
                        'type' => 'image',
                        'return_format' => 'array',
                    ),
                    array(
                        'key' => 'field_bp_logo_url',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'link',
                        'return_format' => 'url',
                    ),
                    array(
                        'key' => 'field_bp_logo_keep_color',
                        'label' => 'Keep Color',
                        'name' => 'keep_color',
                        'type' => 'true_false',
                        'ui' => 1,
                        'default_value' => 0,
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
        ),
        'menu_order' => 6,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'active' => true,
    ));

    // =========================================================================
    // 4) SITE FOOTER - Options Page
    // =========================================================================
    acf_add_local_field_group(array(
        'key' => 'group_site_footer',
        'title' => 'Footer',
        'fields' => array(
            array(
                'key' => 'field_ft_explore_links',
                'label' => 'Explore Links',
                'name' => 'footer_explore_links',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Link',
                'sub_fields' => array(
                    array(
                        'key' => 'field_ft_explore_label',
                        'label' => 'Label',
                        'name' => 'label',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_ft_explore_url',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'link',
                        'return_format' => 'url',
                    ),
                ),
            ),
            array(
                'key' => 'field_ft_brands_links',
                'label' => 'Brands Links',
                'name' => 'footer_brands_links',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Link',
                'sub_fields' => array(
                    array(
                        'key' => 'field_ft_brands_label',
                        'label' => 'Label',
                        'name' => 'label',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_ft_brands_url',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'link',
                        'return_format' => 'url',
                    ),
                ),
            ),
            array(
                'key' => 'field_ft_addresses',
                'label' => 'Addresses',
                'name' => 'footer_addresses',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Address',
                'sub_fields' => array(
                    array(
                        'key' => 'field_ft_addr_name',
                        'label' => 'Name',
                        'name' => 'name',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_ft_addr_address',
                        'label' => 'Address',
                        'name' => 'address',
                        'type' => 'textarea',
                        'rows' => 3,
                    ),
                ),
            ),
            array(
                'key' => 'field_ft_phone',
                'label' => 'Phone',
                'name' => 'footer_phone',
                'type' => 'text',
            ),
            array(
                'key' => 'field_ft_email',
                'label' => 'Email',
                'name' => 'footer_email',
                'type' => 'email',
            ),
            array(
                'key' => 'field_ft_whatsapp_url',
                'label' => 'WhatsApp URL',
                'name' => 'footer_whatsapp_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_ft_social_links',
                'label' => 'Social Links',
                'name' => 'footer_social_links',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Social Link',
                'sub_fields' => array(
                    array(
                        'key' => 'field_ft_social_icon_slug',
                        'label' => 'Icon Slug',
                        'name' => 'icon_slug',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_ft_social_url',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'url',
                    ),
                ),
            ),
            array(
                'key' => 'field_ft_newsletter_action_url',
                'label' => 'Newsletter Action URL',
                'name' => 'footer_newsletter_action_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_ft_privacy_url',
                'label' => 'Privacy URL',
                'name' => 'footer_privacy_url',
                'type' => 'link',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_ft_terms_url',
                'label' => 'Terms URL',
                'name' => 'footer_terms_url',
                'type' => 'link',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_ft_copyright_text',
                'label' => 'Copyright Text',
                'name' => 'footer_copyright_text',
                'type' => 'text',
                'default_value' => '© 2026 Tile & Carpet Centre. All rights reserved.',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'tc-site-header',
                ),
            ),
        ),
        'menu_order' => 20,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'active' => true,
    ));

    // =========================================================================
    // 5) WHATSAPP FLOATING BUTTON - Options Page
    // =========================================================================
    acf_add_local_field_group(array(
        'key' => 'group_whatsapp_fab',
        'title' => 'WhatsApp Floating Button',
        'fields' => array(
            array(
                'key' => 'field_fab_enabled',
                'label' => 'Enabled',
                'name' => 'fab_enabled',
                'type' => 'true_false',
                'ui' => 1,
                'default_value' => 1,
            ),
            array(
                'key' => 'field_fab_whatsapp_prefill',
                'label' => 'WhatsApp Prefill Message',
                'name' => 'nav_whatsapp_prefill',
                'type' => 'text',
                'default_value' => 'Hi, I would like to enquire about your products.',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'tc-site-header',
                ),
            ),
        ),
        'menu_order' => 30,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'active' => true,
    ));

});