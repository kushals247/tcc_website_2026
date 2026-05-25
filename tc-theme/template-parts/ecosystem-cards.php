<?php
/**
 * Template part: Ecosystem cards section.
 *
 * Renders the three-ecosystem grid on the Home page. Pulls content from
 * the ACF field group `group_ecosystem_cards` when available, with sensible
 * defaults so the section always renders.
 *
 * @package tc-theme
 */

if (!defined('ABSPATH')) {
    exit;
}

// Section header copy (ACF with defaults).
$eyebrow = 'Three ecosystems';
$heading = 'How we work with you.';
$intro   = 'From foundation to finishing, organised the way you actually build.';

if (function_exists('get_field')) {
    $acf_eyebrow = get_field('ecosystem_section_eyebrow');
    $acf_heading = get_field('ecosystem_section_heading');
    $acf_intro   = get_field('ecosystem_section_intro');
    if (!empty($acf_eyebrow)) { $eyebrow = $acf_eyebrow; }
    if (!empty($acf_heading)) { $heading = $acf_heading; }
    if (!empty($acf_intro))   { $intro   = $acf_intro; }
}

// Default cards (used when ACF empty or fewer than 3 rows).
$default_cards = array(
    array(
        'card_number_label' => '01',
        'card_phase_label'  => 'BUILD',
        'card_name'         => 'Structure essentials',
        'card_description'  => 'Roofing, piping, water systems and structural solutions for residential and commercial projects.',
        'card_link_url'     => home_url('/structure-essentials/'),
        'card_link_label'   => 'Explore',
    ),
    array(
        'card_number_label' => '02',
        'card_phase_label'  => 'DESIGN',
        'card_name'         => 'Surfaces & finishes',
        'card_description'  => 'Premium tiles, bathrooms, kitchens and finishes — designed for how you live.',
        'card_link_url'     => home_url('/surfaces-finishes/'),
        'card_link_label'   => 'Explore',
    ),
    array(
        'card_number_label' => '03',
        'card_phase_label'  => 'STYLE',
        'card_name'         => 'Softs & decor',
        'card_description'  => 'Rugs, furniture, fabrics, lighting and decor that personalise your space.',
        'card_link_url'     => home_url('/softs-decor/'),
        'card_link_label'   => 'Explore',
    ),
);
// Fix unicode em dash without relying on heredoc escapes.
$default_cards[1]['card_description'] = 'Premium tiles, bathrooms, kitchens and finishes ' . html_entity_decode('&mdash;', ENT_QUOTES, 'UTF-8') . ' designed for how you live.';

// Pull ACF repeater if present.
$cards = array();
if (function_exists('get_field')) {
    $acf_cards = get_field('ecosystem_cards');
    if (is_array($acf_cards) && !empty($acf_cards)) {
        foreach ($acf_cards as $row) {
            if (!is_array($row)) { continue; }

            // Link field can be array (return_format = array) or URL string.
            $link_url = '';
            if (isset($row['card_link_url'])) {
                if (is_array($row['card_link_url']) && !empty($row['card_link_url']['url'])) {
                    $link_url = $row['card_link_url']['url'];
                } elseif (is_string($row['card_link_url'])) {
                    $link_url = $row['card_link_url'];
                }
            }

            $cards[] = array(
                'card_number_label' => isset($row['card_number_label']) ? (string) $row['card_number_label'] : '',
                'card_phase_label'  => isset($row['card_phase_label'])  ? (string) $row['card_phase_label']  : '',
                'card_name'         => isset($row['card_name'])         ? (string) $row['card_name']         : '',
                'card_description'  => isset($row['card_description'])  ? (string) $row['card_description']  : '',
                'card_link_url'     => $link_url,
                'card_link_label'   => isset($row['card_link_label'])   ? (string) $row['card_link_label']   : 'Explore',
            );
        }
    }
}

// Ensure exactly 3 cards, falling back to defaults per slot.
while (count($cards) < 3) {
    $cards[] = $default_cards[count($cards)];
}
$cards = array_slice($cards, 0, 3);
?>
<section id="ecosystems" class="tc-ecosystems" style="padding: 96px 24px; background: #FFFFFF; color: #63666A; font-family: 'Montserrat', system-ui, sans-serif;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div data-tc-eco-header style="max-width: 640px; margin: 0 auto 56px; text-align: center; ">
            <span style="display: inline-block; background: #FFCD00; color: #63666A; padding: 7px 14px; font-size: 11px; letter-spacing: 0.18em; font-weight: 500; text-transform: uppercase; margin-bottom: 20px;"><?php echo esc_html($eyebrow); ?></span>
            <h2 style="font-size: clamp(28px, 4vw, 40px); font-weight: 500; line-height: 1.1; margin: 0 0 16px; color: #63666A;"><?php echo esc_html($heading); ?></h2>
            <p style="font-size: 16px; line-height: 1.6; margin: 0; color: #63666A; opacity: 0.75;"><?php echo esc_html($intro); ?></p>
        </div>

        <div data-tc-eco-grid style="display: grid; grid-template-columns: 1fr; gap: 14px;">
            <?php foreach ($cards as $i => $card) :
                $num_label   = isset($card['card_number_label']) ? $card['card_number_label'] : '';
                $phase_label = isset($card['card_phase_label'])  ? $card['card_phase_label']  : '';
                $card_name   = isset($card['card_name'])         ? $card['card_name']         : '';
                $card_desc   = isset($card['card_description'])  ? $card['card_description']  : '';
                $link_url    = isset($card['card_link_url'])     ? $card['card_link_url']     : '#';
                $link_label  = isset($card['card_link_label'])   ? $card['card_link_label']   : 'Explore';
                if (empty($link_url)) { $link_url = '#'; }
                $aria_text   = trim($link_label . ' ' . $card_name . ' ' . html_entity_decode('&mdash;', ENT_QUOTES, 'UTF-8') . ' ' . $card_desc);
            ?>
            <a class="tc-eco-card" data-tc-eco-card data-card-index="<?php echo (int) $i; ?>" href="<?php echo esc_url($link_url); ?>" aria-label="<?php echo esc_attr($aria_text); ?>" style="display: flex; flex-direction: column; justify-content: space-between; background: #FFFFFF; border: 1px solid #ECECEC; padding: 26px; min-height: 220px; text-decoration: none; color: #63666A; transition: border-color 200ms ease, transform 200ms ease, box-shadow 200ms ease;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <span style="width: 32px; height: 32px; background: #FFCD00; color: #63666A; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 500;"><?php echo esc_html($num_label); ?></span>
                    <span style="color: #C0C0C0; font-size: 10px; letter-spacing: 0.18em; font-weight: 500;"><?php echo esc_html($phase_label); ?></span>
                </div>
                <div>
                    <div style="font-size: 20px; font-weight: 500; margin: 24px 0 10px; color: #63666A;"><?php echo esc_html($card_name); ?></div>
                    <p style="font-size: 13px; line-height: 1.5; color: #63666A; opacity: 0.75; margin: 0 0 18px;"><?php echo esc_html($card_desc); ?></p>
                    <span style="font-size: 13px; font-weight: 500; color: #63666A; border-bottom: 2px solid #FFCD00; padding-bottom: 2px; display: inline-flex; align-items: center; gap: 4px;">
                        <?php echo esc_html($link_label); ?>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#63666A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>

    <style>
        @media (min-width: 768px) { [data-tc-eco-grid] { grid-template-columns: 1fr 1fr 1fr !important; } }
        @media (hover: hover) {
            .tc-eco-card:hover { border-color: #FFCD00 !important; transform: translateY(-2px) !important; box-shadow: 0 12px 32px rgba(0,0,0,0.08); }
        }
        @media (hover: none) { .tc-eco-card:active { transform: scale(0.98); } }
        .tc-eco-card:focus-visible { outline: 2px solid #FFCD00; outline-offset: 2px; }
        @media (prefers-reduced-motion: reduce) {
            [data-tc-eco-header], [data-tc-eco-card] { opacity: 1 !important; transform: none !important; }
        }
    </style>
</section>