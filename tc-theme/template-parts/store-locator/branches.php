<?php
if (!defined('ABSPATH')) exit;

$eyebrow = get_field('locator_tc_eyebrow');
$heading = get_field('locator_tc_heading');
$branches = get_field('locator_tc_branches');

if (!$branches) return;
?>
<section class="tc-locator-branches bg-white py-20 md:py-24">
    <div class="text-center max-w-3xl mx-auto px-6">
        <?php if ($eyebrow): ?>
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($heading): ?>
            <h2 class="text-3xl md:text-4xl font-medium text-[#3A3D40]"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3.5 max-w-6xl mx-auto px-6 mt-12">
        <?php foreach ($branches as $branch):
            $img = $branch['image'] ?? null;
            $img_url = is_array($img) ? ($img['url'] ?? '') : (is_string($img) ? $img : '');
            $img_alt = is_array($img) && !empty($img['alt']) ? $img['alt'] : ($branch['name'] ?? '');
            $name = $branch['name'] ?? '';
            $badge = $branch['badge'] ?? '';
            $address = $branch['address'] ?? '';
            $phone = $branch['phone'] ?? '';
            $whatsapp = $branch['whatsapp'] ?? '';
            $hours = $branch['hours'] ?? '';
            $maps_url = $branch['maps_url'] ?? '';
            $wa_digits = $whatsapp ? preg_replace('/\D+/', '', $whatsapp) : '';
        ?>
            <div class="bg-white border border-[#ECECEC] hover:border-[#FFCD00] transition-all duration-300 overflow-hidden" data-reveal="card">
                <?php if ($img_url): ?>
                    <div class="aspect-[4/3] overflow-hidden bg-[#F5F6F7]">
                        <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" class="w-full h-full object-cover" loading="lazy">
                    </div>
                <?php endif; ?>
                <div class="p-6 space-y-3">
                    <?php if ($name): ?>
                        <h3 class="text-xl font-medium text-[#3A3D40]">
                            <?php echo esc_html($name); ?>
                            <?php if ($badge): ?><span class="inline-block text-xs px-2 py-1 bg-[#FFCD00] text-[#3A3D40] ml-2 rounded"><?php echo esc_html($badge); ?></span><?php endif; ?>
                        </h3>
                    <?php endif; ?>
                    <?php if ($address): ?>
                        <p class="text-sm text-[#63666A] leading-relaxed"><?php echo nl2br(esc_html($address)); ?></p>
                    <?php endif; ?>
                    <?php if ($phone): ?>
                        <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>" class="text-sm text-[#3A3D40] hover:text-[#FFCD00] flex items-center gap-2">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            <?php echo esc_html($phone); ?>
                        </a>
                    <?php endif; ?>
                    <?php if ($wa_digits): ?>
                        <a href="https://wa.me/<?php echo esc_attr($wa_digits); ?>" target="_blank" rel="noopener" class="text-sm text-[#3A3D40] hover:text-[#FFCD00] flex items-center gap-2">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347zm-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.999-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.886 9.884z"/></svg>
                            WhatsApp
                        </a>
                    <?php endif; ?>
                    <?php if ($hours): ?>
                        <p class="text-xs text-[#63666A]"><?php echo nl2br(esc_html($hours)); ?></p>
                    <?php endif; ?>
                    <?php if ($maps_url): ?>
                        <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" class="text-sm text-[#FFCD00] border-b border-[#FFCD00] inline-block">Get directions &rarr;</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>