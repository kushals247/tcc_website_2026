<?php
/**
 * Template Part: Site Navigation Header
 *
 * Renders the site-wide fixed navigation header. Reads ACF Options Page
 * fields registered under the 'tc-site-header' options page. Provides
 * desktop and mobile navigation structures plus the inline CSS hooks
 * toggled by assets/js/nav-scroll-state.js (Task 6).
 *
 * Brand palette: #FFFFFF, #FFCD00, #63666A, #ECECEC, #F5F6F7, #C0C0C0.
 * Typography: Montserrat (enqueued globally).
 *
 * @package tc-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$tc_logo_white     = function_exists( 'get_field' ) ? get_field( 'nav_logo_white_svg', 'option' ) : null;
$tc_logo_dark      = function_exists( 'get_field' ) ? get_field( 'nav_logo_dark_svg', 'option' ) : null;
$tc_ecosystem_links = function_exists( 'get_field' ) ? get_field( 'nav_ecosystem_links', 'option' ) : array();
$tc_brands_label   = function_exists( 'get_field' ) ? get_field( 'nav_brands_label', 'option' ) : '';
$tc_brands_url     = function_exists( 'get_field' ) ? get_field( 'nav_brands_url', 'option' ) : '';
$tc_search_enabled = function_exists( 'get_field' ) ? (bool) get_field( 'nav_search_enabled', 'option' ) : false;
$tc_cta_label      = function_exists( 'get_field' ) ? get_field( 'nav_cta_label', 'option' ) : '';
$tc_cta_url        = function_exists( 'get_field' ) ? get_field( 'nav_cta_url', 'option' ) : '';

$tc_brands_label = $tc_brands_label ? $tc_brands_label : 'Brands';
$tc_brands_url   = $tc_brands_url ? $tc_brands_url : home_url( '/brands/' );
$tc_cta_label    = $tc_cta_label ? $tc_cta_label : 'Visit showroom';
$tc_cta_url      = $tc_cta_url ? $tc_cta_url : home_url( '/store-locator/' );

$tc_placeholder_logo = TC_THEME_URI . '/assets/img/logo-placeholder.svg';

$tc_white_logo_url = ( is_array( $tc_logo_white ) && ! empty( $tc_logo_white['url'] ) ) ? $tc_logo_white['url'] : $tc_placeholder_logo;
$tc_white_logo_alt = ( is_array( $tc_logo_white ) && ! empty( $tc_logo_white['alt'] ) ) ? $tc_logo_white['alt'] : 'Tile & Carpet Centre';
$tc_dark_logo_url  = ( is_array( $tc_logo_dark ) && ! empty( $tc_logo_dark['url'] ) ) ? $tc_logo_dark['url'] : $tc_placeholder_logo;
$tc_dark_logo_alt  = ( is_array( $tc_logo_dark ) && ! empty( $tc_logo_dark['alt'] ) ) ? $tc_logo_dark['alt'] : 'Tile & Carpet Centre';
?>
<nav
    id="tc-nav"
    class="tc-nav tc-nav--transparent"
    aria-label="Primary"
    style="position: fixed; top: 0; left: 0; right: 0; z-index: 50; transition: background-color 300ms ease, height 300ms ease, color 300ms ease; height: 80px; background-color: transparent; color: #FFFFFF; font-family: 'Montserrat', system-ui, sans-serif;"
>
    <div class="tc-nav__inner" style="max-width: 1440px; margin: 0 auto; padding: 0 28px; height: 100%; display: flex; align-items: center; justify-content: space-between;">

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="tc-nav__logo" style="display: inline-flex; align-items: center; text-decoration: none;" aria-label="Tile &amp; Carpet Centre home">
            <img
                src="<?php echo esc_url( $tc_white_logo_url ); ?>"
                alt="<?php echo esc_attr( $tc_white_logo_alt ); ?>"
                data-logo-variant="white"
                style="height: 36px; width: auto; display: inline-block;"
            />
            <img
                src="<?php echo esc_url( $tc_dark_logo_url ); ?>"
                alt="<?php echo esc_attr( $tc_dark_logo_alt ); ?>"
                data-logo-variant="dark"
                style="height: 36px; width: auto; display: none;"
            />
        </a>

        <div data-tc-desktop-nav style="display: none; align-items: center; gap: 24px; font-size: 13px; font-weight: 500;">
            <?php if ( is_array( $tc_ecosystem_links ) && ! empty( $tc_ecosystem_links ) ) : ?>
                <?php foreach ( $tc_ecosystem_links as $tc_index => $tc_link ) :
                    $tc_link_label = isset( $tc_link['label'] ) ? $tc_link['label'] : '';
                    $tc_link_url   = isset( $tc_link['url'] ) ? $tc_link['url'] : '#';
                    if ( '' === $tc_link_label ) { continue; }
                ?>
                    <a href="<?php echo esc_url( $tc_link_url ); ?>" style="color: inherit; text-decoration: none;"><?php echo esc_html( $tc_link_label ); ?></a>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if ( is_array( $tc_ecosystem_links ) && ! empty( $tc_ecosystem_links ) ) : ?><span aria-hidden="true" style="opacity: 0.4;">|</span><?php endif; ?>

            <a href="<?php echo esc_url( $tc_brands_url ); ?>" style="color: inherit; text-decoration: none;"><?php echo esc_html( $tc_brands_label ); ?></a>

            <?php if ( $tc_search_enabled ) : ?>
                <button type="button" aria-label="Search" style="background: transparent; border: 0; padding: 0; color: inherit; cursor: pointer; display: inline-flex; align-items: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                        <circle cx="11" cy="11" r="7"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
            <?php endif; ?>

            <a class="tc-nav__cta" href="<?php echo esc_url( $tc_cta_url ); ?>" style="background-color: #FFCD00; color: #63666A; padding: 9px 18px; font-size: 12px; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center;"><?php echo esc_html( $tc_cta_label ); ?></a>
        </div>

        <div data-tc-mobile-toggle style="display: inline-flex; align-items: center;">
            <button
                id="tc-mobile-menu-toggle"
                type="button"
                aria-label="Open menu"
                aria-expanded="false"
                aria-controls="tc-mobile-menu"
                style="background: transparent; border: 0; padding: 8px; color: inherit; cursor: pointer; display: inline-flex; align-items: center;"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>
    </div>
</nav>

<div
    id="tc-mobile-menu-backdrop"
    aria-hidden="true"
    style="position: fixed; inset: 0; background-color: rgba(0,0,0,0.4); opacity: 0; pointer-events: none; transition: opacity 300ms ease; z-index: 55;"
></div>

<aside
    id="tc-mobile-menu"
    class="tc-mobile-menu"
    aria-hidden="true"
    aria-label="Mobile menu"
    style="position: fixed; top: 0; right: 0; bottom: 0; width: 100%; max-width: 380px; background-color: #FFCD00; color: #63666A; transform: translateX(100%); transition: transform 350ms cubic-bezier(0.4, 0, 0.2, 1); z-index: 60; padding: 24px; overflow-y: auto; font-family: 'Montserrat', system-ui, sans-serif;"
>
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 32px;">
        <img src="<?php echo esc_url( $tc_dark_logo_url ); ?>" alt="<?php echo esc_attr( $tc_dark_logo_alt ); ?>" style="height: 36px; width: auto;" />
        <button
            id="tc-mobile-menu-close"
            type="button"
            aria-label="Close menu"
            style="background: transparent; border: 0; padding: 8px; color: #63666A; cursor: pointer; display: inline-flex; align-items: center;"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    <nav aria-label="Mobile primary" style="display: flex; flex-direction: column; gap: 20px;">
        <?php if ( is_array( $tc_ecosystem_links ) && ! empty( $tc_ecosystem_links ) ) : ?>
            <?php foreach ( $tc_ecosystem_links as $tc_link ) :
                $tc_link_label = isset( $tc_link['label'] ) ? $tc_link['label'] : '';
                $tc_link_url   = isset( $tc_link['url'] ) ? $tc_link['url'] : '#';
                if ( '' === $tc_link_label ) { continue; }
            ?>
                <a href="<?php echo esc_url( $tc_link_url ); ?>" style="color: #63666A; text-decoration: none; font-size: 22px; font-weight: 500;"><?php echo esc_html( $tc_link_label ); ?></a>
            <?php endforeach; ?>
        <?php endif; ?>

        <a href="<?php echo esc_url( $tc_brands_url ); ?>" style="color: #63666A; text-decoration: none; font-size: 22px; font-weight: 500;"><?php echo esc_html( $tc_brands_label ); ?></a>

        <a href="<?php echo esc_url( $tc_cta_url ); ?>" style="background-color: #FFFFFF; color: #63666A; padding: 14px; font-size: 14px; font-weight: 500; text-decoration: none; text-align: center; display: block; margin-top: 12px;"><?php echo esc_html( $tc_cta_label ); ?></a>
    </nav>
</aside>

<style>
@media (min-width: 768px) {
  [data-tc-desktop-nav] { display: flex !important; }
  [data-tc-mobile-toggle] { display: none !important; }
}
.tc-nav.tc-nav--compact {
  background-color: #FFFFFF !important;
  color: #63666A !important;
  height: 60px !important;
  border-bottom: 1px solid #ECECEC;
  box-shadow: 0 1px 3px rgba(0,0,0,0.06);
}
.tc-nav.tc-nav--compact [data-logo-variant="white"] { display: none; }
.tc-nav.tc-nav--compact [data-logo-variant="dark"] { display: inline-block !important; }
.tc-nav a:focus-visible, .tc-nav button:focus-visible { outline: 2px solid #FFCD00; outline-offset: 2px; }
.tc-mobile-menu.is-open { transform: translateX(0) !important; }
#tc-mobile-menu-backdrop.is-visible { opacity: 1 !important; pointer-events: auto !important; }
</style>