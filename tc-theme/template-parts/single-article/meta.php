<?php
if (!defined('ABSPATH')) exit;

$post_obj = get_post();
$author_name = get_field('article_author_name');

$read_time = (int) get_field('article_read_time');
if (!$read_time) {
    $word_count = str_word_count(strip_tags($post_obj->post_content));
    $read_time = max(1, (int) ceil($word_count / 200));
}

$cats = get_the_category();
$cat_links = [];
foreach ($cats as $c) {
    if ($c->slug === 'uncategorized') continue;
    $cat_links[] = '<a href="' . esc_url(home_url('/inspiration/?cat=' . $c->slug)) . '" class="hover:text-[#FFCD00] transition-colors">' . esc_html($c->name) . '</a>';
}
?>
<section class="tc-single-article-meta bg-[#F5F6F7] py-6">
    <div class="max-w-5xl mx-auto px-6 text-center text-sm text-[#63666A]">
        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
        <?php if (!empty($cat_links)): ?>
            <span class="mx-2">&middot;</span>
            <span><?php echo implode(', ', $cat_links); ?></span>
        <?php endif; ?>
        <span class="mx-2">&middot;</span>
        <span><?php echo esc_html($read_time); ?> min read</span>
        <?php if ($author_name): ?>
            <span class="mx-2">&middot;</span>
            <span>By <?php echo esc_html($author_name); ?></span>
        <?php endif; ?>
    </div>
</section>