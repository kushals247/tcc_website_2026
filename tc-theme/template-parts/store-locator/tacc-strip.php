<?php
if (!defined('ABSPATH')) exit;

$eyebrow = get_field('locator_tacc_eyebrow');
$heading = get_field('locator_tacc_heading');
$body = get_field('locator_tacc_body');
$branches = get_field('locator_tacc_branches');
$cta_label = get_field('locator_tacc_cta_label');
$cta_url = get_field('locator_tacc_cta_url');

if (!$branches) return;
?>
<section class="tc-locator-tacc bg-[#63666A] py-20 md:py-24">
    <div class="text-center max-w-3xl mx-auto px-6">
        <?php if ($eyebrow): ?>
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($heading): ?>
            <h2 class="text-3xl md:text-4xl font-medium text-white mb-4"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($body): ?>
            <p class="text-base text-white/85 max-w-2xl mx-auto leading-relaxed"><?php echo esc_html($body); ?></p>
        <?php endif; ?>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3.5 max-w-5xl mx-auto px-6 mt-12">
        <?php foreach ($branches as $branch):
            $name = $branch['name'] ?? '';
            $address = $branch['address'] ?? '';
            $maps_url = $branch['maps_url'] ?? '';
        ?>
            <div class="bg-black/20 p-6" data-reveal="card">
                <?php if ($name): ?><h3 class="text-lg font-medium text-white mb-3"><?php echo esc_html($name); ?></h3><?php endif; ?>
                <?php if ($address): ?><p class="text-sm text-white/85 leading-relaxed mb-3"><?php echo nl2br(esc_html($address)); ?></p><?php endif; ?>
                <?php if ($maps_url): ?><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" class="text-xs text-[#FFCD00] border-b border-[#FFCD00] inline-block">Get directions &rarr;</a><?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php if ($cta_label && $cta_url): ?>
        <div class="text-center px-6">
            <a href="<?php echo esc_url($cta_url); ?>" target="_blank" rel="noopener" class="inline-block bg-[#FFCD00] text-[#63666A] px-10 py-4 mt-12 font-medium hover:bg-[#FFD52E] transition-colors"><?php echo esc_html($cta_label); ?></a>
        </div>
    <?php endif; ?>
</section>