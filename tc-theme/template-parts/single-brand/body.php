<?php
if (!defined('ABSPATH')) exit;

$collections = get_field('brand_key_collections');
$has_collections = !empty($collections) && is_array($collections);
?>
<section class="tc-single-brand-body bg-white py-12 md:py-16">
    <div class="max-w-6xl mx-auto px-6">
        <?php if ($has_collections): ?>
            <div class="grid grid-cols-1 md:grid-cols-[2fr_1fr] gap-12">
                <div class="brand-content">
                    <?php the_content(); ?>
                </div>
                <aside>
                    <h2 class="text-xl font-medium text-[#3A3D40] mb-4 pb-3 border-b border-[#ECECEC]">Key collections</h2>
                    <?php foreach ($collections as $col):
                        $name = $col['collection_name'] ?? ($col['name'] ?? '');
                        $desc = $col['collection_description'] ?? ($col['description'] ?? '');
                        if (!$name) continue;
                    ?>
                        <div class="bg-[#F5F6F7] p-5 mb-3">
                            <p class="text-base font-medium text-[#3A3D40] mb-2"><?php echo esc_html($name); ?></p>
                            <?php if ($desc): ?>
                                <p class="text-sm text-[#63666A] leading-relaxed"><?php echo esc_html($desc); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </aside>
            </div>
        <?php else: ?>
            <div class="max-w-3xl mx-auto">
                <div class="brand-content">
                    <?php the_content(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<style>
.tc-single-brand-body .brand-content { color: #63666A; }
.tc-single-brand-body .brand-content p { font-size: 1.125rem; line-height: 1.75; margin-bottom: 1.5rem; }
.tc-single-brand-body .brand-content h2 { color: #3A3D40; font-family: 'Montserrat', sans-serif; font-weight: 500; font-size: 1.875rem; line-height: 1.3; margin-top: 3rem; margin-bottom: 1rem; }
.tc-single-brand-body .brand-content h3 { color: #3A3D40; font-family: 'Montserrat', sans-serif; font-weight: 500; font-size: 1.5rem; line-height: 1.3; margin-top: 2.5rem; margin-bottom: 0.75rem; }
.tc-single-brand-body .brand-content h4 { color: #3A3D40; font-family: 'Montserrat', sans-serif; font-weight: 500; font-size: 1.25rem; line-height: 1.3; margin-top: 2rem; margin-bottom: 0.5rem; }
.tc-single-brand-body .brand-content ul, .tc-single-brand-body .brand-content ol { padding-left: 1.5rem; margin-bottom: 1.5rem; }
.tc-single-brand-body .brand-content ul { list-style: disc; }
.tc-single-brand-body .brand-content ol { list-style: decimal; }
.tc-single-brand-body .brand-content li { margin-bottom: 0.5rem; font-size: 1.125rem; line-height: 1.75; }
.tc-single-brand-body .brand-content blockquote { border-left: 4px solid #FFCD00; padding-left: 1.5rem; font-style: italic; color: #3A3D40; margin: 2rem 0; font-size: 1.25rem; }
.tc-single-brand-body .brand-content a { color: #FFCD00; border-bottom: 1px solid #FFCD00; transition: opacity 0.2s; }
.tc-single-brand-body .brand-content a:hover { opacity: 0.7; }
.tc-single-brand-body .brand-content img { max-width: 100%; height: auto; margin: 2rem 0; display: block; }
.tc-single-brand-body .brand-content figure { margin: 2rem 0; }
.tc-single-brand-body .brand-content figcaption { font-size: 0.875rem; color: #63666A; text-align: center; margin-top: 0.5rem; }
.tc-single-brand-body .brand-content hr { border: 0; border-top: 1px solid #ECECEC; margin: 3rem 0; }
.tc-single-brand-body .brand-content strong { font-weight: 600; color: #3A3D40; }
</style>