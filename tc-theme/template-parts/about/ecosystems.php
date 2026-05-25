<?php
if (!defined('ABSPATH')) exit;

$eyebrow = get_field('about_ecosystems_eyebrow');
$heading = get_field('about_ecosystems_heading');
$intro = get_field('about_ecosystems_intro');

$ecosystems = [
    ['slug' => 'structure-essentials', 'name' => 'Structure Essentials', 'desc' => 'The bones of every great space — roofing, framing, plumbing, and the unseen systems that hold everything together.'],
    ['slug' => 'surfaces-finishes', 'name' => 'Surfaces & Finishes', 'desc' => 'The visual language of your space — tiles, stone, sanitaryware, and the finishing layers that bring rooms to life.'],
    ['slug' => 'softs-decor', 'name' => 'Softs & Decor', 'desc' => 'The human layer — textiles, furniture, lighting, and the details that make a room feel complete.'],
];
?>
<section class="tc-about-ecosystems bg-white py-20 md:py-24">
    <div class="text-center max-w-3xl mx-auto px-6">
        <?php if ($eyebrow): ?>
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4"><?php echo esc_html($eyebrow); ?></p>
        <?php endif; ?>
        <?php if ($heading): ?>
            <h2 class="text-3xl md:text-4xl font-medium text-[#3A3D40] mb-4"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($intro): ?>
            <p class="text-base text-[#63666A] leading-relaxed"><?php echo esc_html($intro); ?></p>
        <?php endif; ?>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3.5 max-w-6xl mx-auto px-6 mt-12">
        <?php foreach ($ecosystems as $eco): ?>
            <a href="<?php echo esc_url(home_url('/' . $eco['slug'] . '/')); ?>" class="block bg-white border border-[#ECECEC] hover:border-[#FFCD00] p-8 transition-all duration-300 hover:-translate-y-0.5" data-reveal="card">
                <div class="w-10 h-1 bg-[#FFCD00] mb-6"></div>
                <h3 class="text-2xl font-medium text-[#3A3D40] mb-3"><?php echo esc_html($eco['name']); ?></h3>
                <p class="text-base text-[#63666A] leading-relaxed mb-4"><?php echo esc_html($eco['desc']); ?></p>
                <span class="text-sm text-[#FFCD00] border-b border-[#FFCD00] inline-block">Explore &rarr;</span>
            </a>
        <?php endforeach; ?>
    </div>
</section>