<?php
/**
 * T&C Theme Settings
 *
 * Centralises the Theme Settings ACF options page + dynamic CSS overrides +
 * Customizer cleanup. Everything that's user-editable for the brand-locked
 * design system lives here.
 *
 * Convention: hardcoded brand utility classes (e.g. bg-[#FFCD00]) in templates
 * are re-mapped to CSS variables via inline <style> in wp_head. Editing the
 * Theme Settings panel updates the site palette without any template changes.
 */

if (!defined('ABSPATH')) exit;

// ============================================================
// 1. Register the Theme Settings options page
// ============================================================
add_action('acf/init', function () {
    if (!function_exists('acf_add_options_page')) return;

    acf_add_options_page([
        'page_title' => 'T&C Theme Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug'  => 'tc-theme-settings',
        'capability' => 'manage_options',
        'redirect'   => false,
        'icon_url'   => 'dashicons-art',
        'position'   => 60,
    ]);
});

// ============================================================
// 2. Register the ACF field group for design tokens
// ============================================================
add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key' => 'group_theme_settings',
        'title' => 'T&C Theme Settings',
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'instruction_placement' => 'label',
        'fields' => [
            // ---------- Brand Colors ----------
            [
                'key' => 'field_ts_colors_tab',
                'label' => 'Brand colours',
                'type' => 'tab',
            ],
            [
                'key' => 'field_ts_color_primary',
                'label' => 'Primary (yellow accent)',
                'name' => 'ts_color_primary',
                'type' => 'color_picker',
                'default_value' => '#FFCD00',
                'instructions' => 'Brand yellow. Used for CTAs, eyebrows, accents, hover states.',
            ],
            [
                'key' => 'field_ts_color_primary_hover',
                'label' => 'Primary hover',
                'name' => 'ts_color_primary_hover',
                'type' => 'color_picker',
                'default_value' => '#FFD52E',
                'instructions' => 'Slightly lighter yellow for button hover states.',
            ],
            [
                'key' => 'field_ts_color_cool_gray',
                'label' => 'Cool gray (secondary)',
                'name' => 'ts_color_cool_gray',
                'type' => 'color_picker',
                'default_value' => '#63666A',
                'instructions' => 'Body text colour. Also used as background on cool-gray bands.',
            ],
            [
                'key' => 'field_ts_color_charcoal',
                'label' => 'Charcoal (headings)',
                'name' => 'ts_color_charcoal',
                'type' => 'color_picker',
                'default_value' => '#3A3D40',
                'instructions' => 'Heading colour. Also used as background on CTA strips.',
            ],
            [
                'key' => 'field_ts_color_border',
                'label' => 'Border light',
                'name' => 'ts_color_border',
                'type' => 'color_picker',
                'default_value' => '#ECECEC',
                'instructions' => 'Default card and input border colour.',
            ],
            [
                'key' => 'field_ts_color_bg_light',
                'label' => 'Background light',
                'name' => 'ts_color_bg_light',
                'type' => 'color_picker',
                'default_value' => '#F5F6F7',
                'instructions' => 'Subtle off-white used for filter strips and image placeholders.',
            ],

            // ---------- Typography ----------
            [
                'key' => 'field_ts_typography_tab',
                'label' => 'Typography',
                'type' => 'tab',
            ],
            [
                'key' => 'field_ts_font_primary',
                'label' => 'Primary font family',
                'name' => 'ts_font_primary',
                'type' => 'text',
                'default_value' => 'Montserrat, sans-serif',
                'instructions' => 'Used for headings, body, navigation, CTAs. Include fallbacks.',
            ],
            [
                'key' => 'field_ts_font_load_google',
                'label' => 'Load Montserrat from Google Fonts',
                'name' => 'ts_font_load_google',
                'type' => 'true_false',
                'default_value' => 1,
                'ui' => 1,
                'instructions' => 'Disable if you self-host the font or want to change to a different font family.',
            ],

            // ---------- Layout ----------
            [
                'key' => 'field_ts_layout_tab',
                'label' => 'Layout',
                'type' => 'tab',
            ],
            [
                'key' => 'field_ts_section_padding',
                'label' => 'Section vertical padding',
                'name' => 'ts_section_padding',
                'type' => 'select',
                'choices' => [
                    'compact' => 'Compact',
                    'regular' => 'Regular (default)',
                    'spacious' => 'Spacious',
                ],
                'default_value' => 'regular',
                'instructions' => 'Tunes the py- spacing across all sections. Affects feel of the whole site.',
            ],

            // ---------- Component options ----------
            [
                'key' => 'field_ts_components_tab',
                'label' => 'Components',
                'type' => 'tab',
            ],
            [
                'key' => 'field_ts_card_border_radius',
                'label' => 'Card border radius',
                'name' => 'ts_card_border_radius',
                'type' => 'select',
                'choices' => [
                    'none' => 'None (sharp corners)',
                    'small' => 'Small (2px)',
                    'medium' => 'Medium (6px)',
                ],
                'default_value' => 'none',
            ],
            [
                'key' => 'field_ts_button_border_radius',
                'label' => 'Button border radius',
                'name' => 'ts_button_border_radius',
                'type' => 'select',
                'choices' => [
                    'none' => 'None (sharp corners)',
                    'small' => 'Small (2px)',
                    'medium' => 'Medium (6px)',
                    'full' => 'Full (pill)',
                ],
                'default_value' => 'none',
            ],
        ],
        'location' => [[
            ['param' => 'options_page', 'operator' => '==', 'value' => 'tc-theme-settings'],
        ]],
    ]);
});

// ============================================================
// 3. Inject dynamic CSS overrides in <head>
// ============================================================
// Maps the hardcoded Tailwind utility classes used across templates to CSS variables
// sourced from the Theme Settings ACF page. Allows palette changes without
// touching templates. Uses !important to win specificity over Tailwind utilities.
add_action('wp_head', function () {
    if (!function_exists('get_field')) return;

    $primary       = get_field('ts_color_primary', 'tc-theme-settings')       ?: '#FFCD00';
    $primary_hover = get_field('ts_color_primary_hover', 'tc-theme-settings') ?: '#FFD52E';
    $cool_gray     = get_field('ts_color_cool_gray', 'tc-theme-settings')     ?: '#63666A';
    $charcoal      = get_field('ts_color_charcoal', 'tc-theme-settings')      ?: '#3A3D40';
    $border        = get_field('ts_color_border', 'tc-theme-settings')        ?: '#ECECEC';
    $bg_light      = get_field('ts_color_bg_light', 'tc-theme-settings')      ?: '#F5F6F7';
    $font_primary  = get_field('ts_font_primary', 'tc-theme-settings')        ?: 'Montserrat, sans-serif';
    $card_radius   = get_field('ts_card_border_radius', 'tc-theme-settings')  ?: 'none';
    $btn_radius    = get_field('ts_button_border_radius', 'tc-theme-settings') ?: 'none';

    $radius_map = [
        'none' => '0',
        'small' => '2px',
        'medium' => '6px',
        'full' => '9999px',
    ];
    $card_radius_val = $radius_map[$card_radius] ?? '0';
    $btn_radius_val  = $radius_map[$btn_radius] ?? '0';

    echo "\n<style id='tc-theme-overrides'>\n";
    echo ":root {";
    echo "--tc-primary: {$primary};";
    echo "--tc-primary-hover: {$primary_hover};";
    echo "--tc-cool-gray: {$cool_gray};";
    echo "--tc-charcoal: {$charcoal};";
    echo "--tc-border: {$border};";
    echo "--tc-bg-light: {$bg_light};";
    echo "--tc-font-primary: {$font_primary};";
    echo "--tc-card-radius: {$card_radius_val};";
    echo "--tc-btn-radius: {$btn_radius_val};";
    echo "}\n";

    // Map hardcoded Tailwind arbitrary-value classes to the CSS variables
    // Primary (yellow #FFCD00)
    echo ".bg-\\[\\#FFCD00\\] { background-color: var(--tc-primary) !important; }\n";
    echo ".text-\\[\\#FFCD00\\] { color: var(--tc-primary) !important; }\n";
    echo ".border-\\[\\#FFCD00\\] { border-color: var(--tc-primary) !important; }\n";
    echo ".hover\\:border-\\[\\#FFCD00\\]:hover { border-color: var(--tc-primary) !important; }\n";
    echo ".hover\\:text-\\[\\#FFCD00\\]:hover { color: var(--tc-primary) !important; }\n";
    echo ".focus\\:border-\\[\\#FFCD00\\]:focus { border-color: var(--tc-primary) !important; }\n";
    // Primary hover (#FFD52E)
    echo ".hover\\:bg-\\[\\#FFD52E\\]:hover { background-color: var(--tc-primary-hover) !important; }\n";
    echo ".bg-\\[\\#FFD52E\\] { background-color: var(--tc-primary-hover) !important; }\n";
    // Cool gray (#63666A)
    echo ".bg-\\[\\#63666A\\] { background-color: var(--tc-cool-gray) !important; }\n";
    echo ".text-\\[\\#63666A\\] { color: var(--tc-cool-gray) !important; }\n";
    echo ".border-\\[\\#63666A\\] { border-color: var(--tc-cool-gray) !important; }\n";
    echo ".hover\\:bg-\\[\\#63666A\\]:hover { background-color: var(--tc-cool-gray) !important; }\n";
    echo ".hover\\:text-\\[\\#63666A\\]:hover { color: var(--tc-cool-gray) !important; }\n";
    // Charcoal (#3A3D40)
    echo ".bg-\\[\\#3A3D40\\] { background-color: var(--tc-charcoal) !important; }\n";
    echo ".text-\\[\\#3A3D40\\] { color: var(--tc-charcoal) !important; }\n";
    echo ".hover\\:bg-\\[\\#3A3D40\\]:hover { background-color: var(--tc-charcoal) !important; }\n";
    // Border light (#ECECEC)
    echo ".border-\\[\\#ECECEC\\] { border-color: var(--tc-border) !important; }\n";
    echo ".bg-\\[\\#ECECEC\\] { background-color: var(--tc-border) !important; }\n";
    // Background light (#F5F6F7)
    echo ".bg-\\[\\#F5F6F7\\] { background-color: var(--tc-bg-light) !important; }\n";
    echo ".hover\\:bg-\\[\\#F5F6F7\\]:hover { background-color: var(--tc-bg-light) !important; }\n";

    // Font family — applies to <body> globally
    echo "body { font-family: var(--tc-font-primary) !important; color: var(--tc-charcoal) !important; }\n";

    // Component radii — gentle nudge across visible cards + buttons
    if ($card_radius !== 'none') {
        echo ".tc-pillar-subcat-grid a.group, .tc-brands-grid a.group, .tc-insp-grid a.group, .tc-pillar-articles a.group, .tc-about-projects a, .tc-locator-branches a { border-radius: var(--tc-card-radius) !important; overflow: hidden; }\n";
    }
    if ($btn_radius !== 'none') {
        echo "a[class*='bg-[#FFCD00]'], button[class*='bg-[#FFCD00]'], input[type=submit] { border-radius: var(--tc-btn-radius) !important; }\n";
    }

    // Section padding scale
    $padding = get_field('ts_section_padding', 'tc-theme-settings') ?: 'regular';
    if ($padding === 'compact') {
        echo ".py-20 { padding-top: 3rem !important; padding-bottom: 3rem !important; }\n";
        echo ".md\\:py-24 { padding-top: 4rem !important; padding-bottom: 4rem !important; }\n";
        echo ".md\\:py-32 { padding-top: 5rem !important; padding-bottom: 5rem !important; }\n";
    } elseif ($padding === 'spacious') {
        echo ".py-20 { padding-top: 6rem !important; padding-bottom: 6rem !important; }\n";
        echo ".md\\:py-24 { padding-top: 8rem !important; padding-bottom: 8rem !important; }\n";
        echo ".md\\:py-32 { padding-top: 10rem !important; padding-bottom: 10rem !important; }\n";
    }

    echo "</style>\n";
}, 99);

// ============================================================
// 4. Hide Blocksy Customizer panels we have overridden
// ============================================================
add_action('customize_register', function ($wp_customize) {
    // Blocksy registers panels with slug 'blocksy_panel_*'. Remove the ones we own.
    $remove_panels = [
        'blocksy_panel_header',
        'blocksy_panel_footer',
        'blocksy_panel_typography',
        'blocksy_panel_general',
        'blocksy_panel_buttons',
        'blocksy_panel_blog',
        'blocksy_panel_woocommerce',
    ];
    foreach ($remove_panels as $panel) {
        $wp_customize->remove_panel($panel);
    }
    // Also remove the WP default colors + custom CSS sections (we provide our own)
    $wp_customize->remove_section('colors_section');
    $wp_customize->remove_section('custom_css');
}, 99);

// ============================================================
// 5. Add a notice at the top of the Customizer pointing users to ACF pages
// ============================================================
add_action('customize_controls_print_styles', function () {
    ?>
    <style>
        #customize-info::after {
            content: 'T\&C site: header, footer, colours, fonts, and component styles are managed in Appearance → Site Header and Appearance → Theme Settings (not here).';
            display: block;
            padding: 12px 14px;
            margin: 12px 14px;
            background: #fff8db;
            border-left: 4px solid #FFCD00;
            color: #3A3D40;
            font-size: 12px;
            line-height: 1.5;
        }
    </style>
    <?php
});

// ============================================================
// 6. Conditional Google Fonts loading (toggle in Theme Settings)
// ============================================================
// (Existing Montserrat enqueue stays in functions.php; this just adds a toggle
// check that can dequeue it if user disables.)
add_action('wp_enqueue_scripts', function () {
    if (!function_exists('get_field')) return;
    $load_google = get_field('ts_font_load_google', 'tc-theme-settings');
    if ($load_google === false || $load_google === 0 || $load_google === '0') {
        wp_dequeue_style('tc-montserrat');
        wp_deregister_style('tc-montserrat');
    }
}, 100);