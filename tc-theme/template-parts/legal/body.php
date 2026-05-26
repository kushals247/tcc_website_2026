<?php
if (!defined('ABSPATH')) exit;
?>
<section class="tc-legal-body bg-white py-12 md:py-16">
    <div class="max-w-3xl mx-auto px-6">
        <div class="tc-article-content">
            <?php the_content(); ?>
        </div>
    </div>
</section>
<style>
.tc-article-content { color: #63666A; }
.tc-article-content p { font-size: 1.125rem; line-height: 1.75; margin-bottom: 1.5rem; }
.tc-article-content h2 { color: #3A3D40; font-family: 'Montserrat', sans-serif; font-weight: 500; font-size: 1.875rem; line-height: 1.3; margin-top: 3rem; margin-bottom: 1rem; }
.tc-article-content h3 { color: #3A3D40; font-family: 'Montserrat', sans-serif; font-weight: 500; font-size: 1.5rem; line-height: 1.3; margin-top: 2.5rem; margin-bottom: 0.75rem; }
.tc-article-content h4 { color: #3A3D40; font-family: 'Montserrat', sans-serif; font-weight: 500; font-size: 1.25rem; line-height: 1.3; margin-top: 2rem; margin-bottom: 0.5rem; }
.tc-article-content ul, .tc-article-content ol { padding-left: 1.5rem; margin-bottom: 1.5rem; }
.tc-article-content ul { list-style: disc; }
.tc-article-content ol { list-style: decimal; }
.tc-article-content li { margin-bottom: 0.5rem; font-size: 1.125rem; line-height: 1.75; }
.tc-article-content blockquote { border-left: 4px solid #FFCD00; padding-left: 1.5rem; font-style: italic; color: #3A3D40; margin: 2rem 0; font-size: 1.25rem; }
.tc-article-content a { color: #FFCD00; border-bottom: 1px solid #FFCD00; transition: opacity 0.2s; }
.tc-article-content a:hover { opacity: 0.7; }
.tc-article-content img { max-width: 100%; height: auto; margin: 2rem 0; display: block; }
.tc-article-content figure { margin: 2rem 0; }
.tc-article-content figcaption { font-size: 0.875rem; color: #63666A; text-align: center; margin-top: 0.5rem; }
.tc-article-content hr { border: 0; border-top: 1px solid #ECECEC; margin: 3rem 0; }
.tc-article-content strong { font-weight: 600; color: #3A3D40; }
</style>