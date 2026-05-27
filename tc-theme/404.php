<?php
/**
 * 404 Not Found template.
 */
get_header();
?>
<main id="primary" class="site-main tc-404">
    <section class="tc-404-hero bg-[#63666A] py-24 md:py-32 text-center text-white">
        <div class="max-w-3xl mx-auto px-6">
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-6">404</p>
            <h1 class="text-4xl md:text-6xl font-medium leading-tight mb-6">Looks like this page wandered off.</h1>
            <p class="text-base md:text-lg text-white/85 leading-relaxed max-w-2xl mx-auto">
                The link may be broken, or the page may have moved. Here are some popular destinations instead:
            </p>
        </div>
    </section>

    <section class="tc-404-nav bg-white py-20 md:py-24">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3.5">
                <?php
                $tiles = [
                    ['name' => 'Structure Essentials', 'desc' => 'Roofing, piping, framing & more', 'url' => home_url('/structure-essentials/')],
                    ['name' => 'Surfaces & Finishes', 'desc' => 'Tiles, stone, sanitaryware', 'url' => home_url('/surfaces-finishes/')],
                    ['name' => 'Softs & Decor', 'desc' => 'Carpets, curtains, furniture', 'url' => home_url('/softs-decor/')],
                    ['name' => 'Read Inspiration', 'desc' => 'Articles & project stories', 'url' => home_url('/inspiration/')],
                ];
                foreach ($tiles as $t): ?>
                    <a href="<?php echo esc_url($t['url']); ?>" class="group block bg-white border border-[#ECECEC] hover:border-[#FFCD00] p-8 transition-all duration-300 hover:-translate-y-0.5">
                        <div class="w-10 h-1 bg-[#FFCD00] mb-6"></div>
                        <h2 class="text-xl font-medium text-[#3A3D40] mb-2"><?php echo esc_html($t['name']); ?></h2>
                        <p class="text-sm text-[#63666A] leading-relaxed mb-4"><?php echo esc_html($t['desc']); ?></p>
                        <span class="text-sm text-[#FFCD00] inline-block border-b border-[#FFCD00] group-hover:translate-x-1 transition-transform">Explore &rarr;</span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="tc-404-cta bg-[#3A3D40] py-20 md:py-28 text-white">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <p class="text-xs tracking-[0.2em] uppercase text-[#FFCD00] font-medium mb-4">STILL CAN'T FIND IT?</p>
            <h2 class="text-3xl md:text-4xl font-medium mb-4">We're here to help.</h2>
            <p class="text-base md:text-lg text-white/80 mb-10 max-w-xl mx-auto leading-relaxed">
                If you were looking for something specific, our team can point you in the right direction.
            </p>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a href="<?php echo esc_url(home_url('/quote/')); ?>" class="bg-[#FFCD00] text-[#3A3D40] px-8 py-4 font-medium hover:bg-[#FFD52E] transition-colors text-base inline-block">Speak to our team</a>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="border border-white text-white px-8 py-4 hover:bg-white/10 transition-colors text-base inline-block">Back to home</a>
            </div>
        </div>
    </section>
</main>
<?php get_footer();