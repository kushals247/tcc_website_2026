<?php
if (!defined('ABSPATH')) exit;

$country = get_field('brand_country');
$founded = get_field('brand_founded_year');
$certifications = get_field('brand_certifications');
$ecosystems = get_field('brand_ecosystems');
$available_at_tacc = get_field('brand_available_at_tacc');
$tacc_search_url = get_field('brand_tacc_search_url');
$is_inhouse = get_field('brand_is_inhouse');
$website = get_field('brand_website');

$eco_labels_map = [
    'structure-essentials' => 'Structure',
    'surfaces-finishes' => 'Surfaces &amp; Finishes',
    'softs-decor' => 'Softs &amp; Decor',
];

$items = [];

if ($country) {
    $items[] = esc_html($country);
}
if ($founded) {
    $items[] = 'Founded ' . esc_html($founded);
}
if (!empty($certifications) && is_array($certifications)) {
    $cert_labels = [];
    foreach ($certifications as $cert) {
        if (is_array($cert)) {
            $cert_labels[] = esc_html($cert['name'] ?? ($cert['label'] ?? reset($cert)));
        } else {
            $cert_labels[] = esc_html($cert);
        }
    }
    if (!empty($cert_labels)) {
        $items[] = implode(', ', $cert_labels);
    }
}
if (!empty($ecosystems) && is_array($ecosystems)) {
    $eco_human = [];
    foreach ($ecosystems as $slug) {
        if (isset($eco_labels_map[$slug])) {
            $eco_human[] = $eco_labels_map[$slug];
        }
    }
    if (!empty($eco_human)) {
        $items[] = implode('&nbsp;&middot;&nbsp;', $eco_human);
    }
}
if ($available_at_tacc) {
    $tacc_url = $tacc_search_url ?: 'https://tacc.co.ke/?s=' . rawurlencode(get_the_title());
    $items[] = '<a href="' . esc_url($tacc_url) . '" target="_blank" rel="noopener" class="text-[#FFCD00] border-b border-[#FFCD00]">Available at TACC &rarr;</a>';
}
if ($is_inhouse) {
    $items[] = '<img src="' . esc_url(tc_original_asset('tag', 'grey')) . '" alt="T&amp;C Original Product" class="inline-block h-4 w-auto align-middle" loading="lazy">';
}
if ($website) {
    $items[] = '<a href="' . esc_url($website) . '" target="_blank" rel="noopener" class="hover:text-[#FFCD00] transition-colors">Visit official site &rarr;</a>';
}

if (empty($items)) return;
?>
<section class="tc-single-brand-info bg-[#F5F6F7] py-6">
    <div class="max-w-5xl mx-auto px-6 text-center text-sm text-[#63666A]">
        <?php echo implode('<span class="mx-2">&middot;</span>', $items); ?>
    </div>
</section>