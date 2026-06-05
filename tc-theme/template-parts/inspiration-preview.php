<?php
/**
 * Inspiration Preview template part.
 * Pulls latest 4 published WP posts; falls back to ACF fallback cards if posts < 4.
 */
if (!defined('ABSPATH')) exit;

$eyebrow = function_exists('get_field') ? (get_field('inspiration_eyebrow') ?: 'Inspiration') : 'Inspiration';
$heading = function_exists('get_field') ? (get_field('inspiration_heading') ?: 'Not sure where to start?') : 'Not sure where to start?';
$intro = function_exists('get_field') ? (get_field('inspiration_intro') ?: 'Ideas, guides and project stories from T&C specialists.') : 'Ideas, guides and project stories from T&C specialists.';
$hub_url = function_exists('get_field') ? (get_field('inspiration_hub_url') ?: home_url('/inspiration/')) : home_url('/inspiration/');

$posts = get_posts(['post_type' => 'post', 'posts_per_page' => 4, 'post_status' => 'publish']);
$cards = [];
if (count($posts) >= 4) {
    foreach ($posts as $p) {
        $cats = get_the_category($p->ID);
        $cards[] = [
            'image' => (function($pid) { $hero = function_exists('get_field') ? get_field('article_hero_image', $pid) : ''; return (is_string($hero) && $hero) ? $hero : (get_the_post_thumbnail_url($pid, 'large') ?: ''); })($p->ID),
            'category' => !empty($cats) ? $cats[0]->name : 'Article',
            'title' => get_the_title($p->ID),
            'excerpt' => has_excerpt($p->ID) ? get_the_excerpt($p->ID) : wp_trim_words(strip_tags($p->post_content), 22),
            'date' => get_the_date('M j, Y', $p->ID),
            'link_url' => get_permalink($p->ID),
        ];
    }
} else {
    $fallback = function_exists('get_field') ? (get_field('inspiration_fallback_cards') ?: []) : [];
    foreach ($fallback as $fb) {
        $cards[] = [
            'image' => (is_array($fb['image'] ?? null) && !empty($fb['image']['url'])) ? $fb['image']['url'] : '',
            'category' => $fb['category'] ?? 'Article',
            'title' => $fb['title'] ?? '',
            'excerpt' => $fb['excerpt'] ?? '',
            'date' => $fb['date'] ?? '',
            'link_url' => is_array($fb['link_url'] ?? null) ? ($fb['link_url']['url'] ?? '#') : ($fb['link_url'] ?? '#'),
        ];
    }
}

if (count($cards) < 4) {
    while (count($cards) < 4) {
        $cards[] = ['image' => '', 'category' => 'Guide', 'title' => 'Coming soon', 'excerpt' => 'Editorial content from T&C specialists - check back soon.', 'date' => '', 'link_url' => '#'];
    }
}

$hero = array_shift($cards);
$rest = array_slice($cards, 0, 3);
?>
<section id="inspiration" class="tc-insp" style="padding: 96px 24px; background: #FFFFFF; color: #63666A; font-family: 'Montserrat', system-ui, sans-serif;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div class="tc-insp__header" style="text-align: center; max-width: 640px; margin: 0 auto 56px;" data-tc-insp-header>
            <div style="display: inline-block; background: #FFCD00; color: #63666A; padding: 7px 14px; font-size: 11px; letter-spacing: 0.18em; font-weight: 500; text-transform: uppercase; margin-bottom: 20px;"><?php echo esc_html($eyebrow); ?></div>
            <h2 style="font-size: clamp(28px, 4vw, 40px); font-weight: 500; line-height: 1.1; margin: 0 0 16px; color: #63666A;"><?php echo esc_html($heading); ?></h2>
            <p style="font-size: 16px; line-height: 1.6; margin: 0; color: #63666A; opacity: 0.75;"><?php echo esc_html($intro); ?></p>
        </div>

        <a href="<?php echo esc_url($hero['link_url']); ?>" class="tc-insp__hero" data-tc-insp-hero
           style="display: grid; grid-template-columns: 1fr; gap: 24px; background: #FFFFFF; border: 1px solid #ECECEC; text-decoration: none; color: #63666A; margin-bottom: 32px; overflow: hidden; transition: border-color 200ms ease, box-shadow 200ms ease;">
            <div style="aspect-ratio: 16/9; background-color: #F5F6F7; <?php echo $hero['image'] ? 'background-image: url(' . esc_url($hero['image']) . ');' : ''; ?> background-size: cover; background-position: center;"></div>
            <div style="padding: 24px 28px 28px;">
                <div style="display: inline-block; background: #FFCD00; color: #63666A; padding: 4px 10px; font-size: 10px; font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 14px;"><?php echo esc_html($hero['category']); ?></div>
                <h3 style="font-size: clamp(20px, 2.5vw, 28px); font-weight: 500; line-height: 1.25; margin: 0 0 12px; color: #63666A;"><?php echo esc_html($hero['title']); ?></h3>
                <p style="font-size: 14px; line-height: 1.6; color: #63666A; opacity: 0.75; margin: 0 0 16px;"><?php echo esc_html($hero['excerpt']); ?></p>
                <?php if ($hero['date']) : ?><div style="font-size: 12px; color: #C0C0C0; margin-bottom: 12px;"><?php echo esc_html($hero['date']); ?></div><?php endif; ?>
                <span style="font-size: 13px; font-weight: 500; color: #63666A; border-bottom: 2px solid #FFCD00; padding-bottom: 2px; display: inline-flex; align-items: center; gap: 4px;">Read article <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span>
            </div>
        </a>

        <div class="tc-insp__grid" style="display: grid; grid-template-columns: 1fr; gap: 14px;" data-tc-insp-grid>
            <?php foreach ($rest as $card) : ?>
            <a href="<?php echo esc_url($card['link_url']); ?>" class="tc-insp__card"
               style="display: flex; flex-direction: column; background: #FFFFFF; border: 1px solid #ECECEC; text-decoration: none; color: #63666A; overflow: hidden; transition: border-color 200ms ease, transform 200ms ease, box-shadow 200ms ease;">
                <div style="aspect-ratio: 4/3; background-color: #F5F6F7; <?php echo $card['image'] ? 'background-image: url(' . esc_url($card['image']) . ');' : ''; ?> background-size: cover; background-position: center;"></div>
                <div style="padding: 20px;">
                    <div style="display: inline-block; background: #FFCD00; color: #63666A; padding: 3px 8px; font-size: 10px; font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 10px;"><?php echo esc_html($card['category']); ?></div>
                    <div style="font-size: 16px; font-weight: 500; color: #63666A; margin-bottom: 8px; line-height: 1.3;"><?php echo esc_html($card['title']); ?></div>
                    <p style="font-size: 12px; line-height: 1.5; color: #63666A; opacity: 0.75; margin: 0 0 10px;"><?php echo esc_html($card['excerpt']); ?></p>
                    <?php if ($card['date']) : ?><div style="font-size: 11px; color: #C0C0C0; margin-bottom: 8px;"><?php echo esc_html($card['date']); ?></div><?php endif; ?>
                    <span style="font-size: 12px; font-weight: 500; color: #63666A; border-bottom: 2px solid #FFCD00; padding-bottom: 2px;">Read more →</span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <div style="text-align: center; margin-top: 40px;">
            <a href="<?php echo esc_url($hub_url); ?>" style="font-size: 14px; font-weight: 500; color: #63666A; border-bottom: 2px solid #FFCD00; padding-bottom: 2px; text-decoration: none;">Visit our advice hub →</a>
        </div>
    </div>
</section>
<style>
@media (min-width: 768px) { .tc-insp__hero { grid-template-columns: 1.5fr 1fr !important; gap: 0 !important; } .tc-insp__hero > div:first-child { aspect-ratio: auto !important; min-height: 320px; } }
@media (min-width: 900px) { .tc-insp__grid { grid-template-columns: 1fr 1fr 1fr !important; } }
@media (hover: hover) {
  .tc-insp__hero:hover, .tc-insp__card:hover { border-color: #FFCD00 !important; }
  .tc-insp__card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.08); }
}
.tc-insp__hero:focus-visible, .tc-insp__card:focus-visible { outline: 2px solid #FFCD00; outline-offset: 2px; }
</style>