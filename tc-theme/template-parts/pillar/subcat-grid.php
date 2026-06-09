<?php
/**
 * Pillar > sub-cat grid — PIM-driven from IA structure.
 * Reads L1 sub-cats for the current pillar's ecosystem and renders them as cards.
 * Editorial bits (eyebrow / heading / intro) still come from ACF on the pillar page.
 */
if (!defined('ABSPATH')) exit;
if (!function_exists('tc_get_ia_ecosystem')) return;

// Map pillar page slug → ecosystem slug. Pillars use the same slug as ecosystem,
// so resolve via the queried page's slug.
$pillar_id = get_queried_object_id();
$pillar_slug = $pillar_id ? get_post_field('post_name', $pillar_id) : '';
$eco = tc_get_ia_ecosystem($pillar_slug);
if (!$eco) return;

$eyebrow = get_field('pillar_subcat_eyebrow') ?: 'EXPLORE';
$heading = get_field('pillar_subcat_heading') ?: ('Inside ' . $eco['name']);
$intro = get_field('pillar_subcat_intro') ?: $eco['description'];

// Per-L1 ACF override map (optional): pillar_subcat_overrides repeater
// of {l1_slug, image, description} — used when admin wants custom thumbs / blurbs.
$overrides_repeater = function_exists('get_field') ? (get_field('pillar_subcat_overrides') ?: []) : [];
$overrides = [];
foreach ($overrides_repeater as $row) {
    if (!empty($row['l1_slug'])) $overrides[$row['l1_slug']] = $row;
}

$l1_items = $eco['l1'];
if (empty($l1_items)) return;
?>
<section class="tc-pillar-subcat-grid bg-white py-20 md:py-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12 md:mb-16 max-w-2xl mx-auto">
            <?php if ($eyebrow): ?><p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p><?php endif; ?>
            <?php if ($heading): ?><h2 class="text-3xl md:text-4xl font-medium text-[#3A3D40] mb-4"><?php echo esc_html($heading); ?></h2><?php endif; ?>
            <?php if ($intro): ?><p class="text-base text-[#63666A] leading-relaxed"><?php echo esc_html($intro); ?></p><?php endif; ?>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3.5">
            <?php foreach ($l1_items as $l1_slug => $l1):
                $url = home_url('/' . $pillar_slug . '/' . $l1_slug . '/');
                $override = $overrides[$l1_slug] ?? null;
                $img = $override['image'] ?? null;
                $img_url = is_array($img) ? ($img['url'] ?? '') : (is_string($img) ? $img : '');
                $img_alt = is_array($img) && !empty($img['alt']) ? $img['alt'] : $l1['name'];
                $desc = $override['description'] ?? '';
                $l2_count = count($l1['l2']);
            ?>
                <a href="<?php echo esc_url($url); ?>" class="group block bg-white border border-[#ECECEC] hover:border-[#FFCD00] transition-all duration-300 hover:-translate-y-0.5" data-reveal="card">
                    <?php if ($img_url): ?>
                        <div class="aspect-[3/2] overflow-hidden bg-[#F5F6F7]">
                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500" loading="lazy">
                        </div>
                    <?php else: ?>
                        <div class="aspect-[3/2] bg-[#F5F6F7] flex items-center justify-center">
                            <i class="ti ti-<?php echo esc_attr($l1['icon']); ?>" style="font-size: 48px; color: #C0C0C0;" aria-hidden="true"></i>
                        </div>
                    <?php endif; ?>
                    <div class="p-6">
                        <h3 class="text-xl font-medium text-[#3A3D40] mb-2"><?php echo esc_html($l1['name']); ?></h3>
                        <?php if ($desc): ?>
                            <p class="text-sm text-[#63666A] leading-relaxed mb-3"><?php echo esc_html($desc); ?></p>
                        <?php elseif ($l2_count > 0): ?>
                            <p class="text-sm text-[#63666A] leading-relaxed mb-3"><?php echo (int)$l2_count; ?> categories within</p>
                        <?php endif; ?>
                        <span class="text-sm text-[#FFCD00] inline-block border-b border-[#FFCD00] group-hover:translate-x-1 transition-transform">Explore &rarr;</span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
