<?php
/**
 * Single source of truth for the T&C site Information Architecture.
 * Drives mega menu, pillar pages, footer, sub-cat archives.
 * Generated 2026-06-09 from PIM mapping; structural data only.
 */
if (!defined('ABSPATH')) exit;

function tc_get_ia_structure() {
    return [
        'structure-essentials' => [
            'name' => 'Structure Essentials',
            'eyebrow' => 'BUILD',
            'description' => 'Foundational, behind-the-wall, and structural systems.',
            'l1' => [
                'mixers-showers-and-taps' => ['name' => 'Mixers, Showers & Taps', 'icon' => 'droplet', 'l2' => [
                    'plumbing-valves' => ['name' => 'Plumbing Valves'],
                ]],
                'plumbing-fittings' => ['name' => 'Plumbing Fittings', 'icon' => 'pipe', 'l2' => [
                    'pumps' => ['name' => 'Pumps'],
                    'valves' => ['name' => 'Valves'],
                    'accessories' => ['name' => 'Accessories'],
                    'water-meters' => ['name' => 'Water Meters'],
                    'water-heating' => ['name' => 'Water Heating'],
                    'hot-water-cylinders' => ['name' => 'Hot Water Cylinders'],
                    'instant-hot-water' => ['name' => 'Instant Hot Water'],
                    'miscellaneous' => ['name' => 'Miscellaneous'],
                ]],
                'ceilings' => ['name' => 'Ceilings', 'icon' => 'layout-board-split', 'l2' => [
                ]],
                'roto-moulded-products' => ['name' => 'Roto-Moulded Products', 'icon' => 'tank', 'l2' => [
                    'storage-tanks' => ['name' => 'Storage Tanks'],
                    'additional-products' => ['name' => 'Additional Products'],
                ]],
                'construction-chemicals' => ['name' => 'Construction Chemicals', 'icon' => 'flask', 'l2' => [
                    'waterproofing' => ['name' => 'Waterproofing'],
                    'insulation' => ['name' => 'Insulation'],
                    'technical-applications' => ['name' => 'Technical Applications'],
                ]],
                'lgs-framing' => ['name' => 'LGS Framing', 'icon' => 'frame', 'l2' => [
                ]],
                'lighting' => ['name' => 'Lighting', 'icon' => 'bulb', 'l2' => [
                    'switches-and-sockets' => ['name' => 'Switches & Sockets'],
                ]],
                'ironmongery' => ['name' => 'Ironmongery', 'icon' => 'screw', 'l2' => [
                ]],
                'hvac' => ['name' => 'HVAC', 'icon' => 'wind', 'l2' => [
                ]],
                'roofing' => ['name' => 'Roofing', 'icon' => 'home-2', 'l2' => [
                    'corrugated-roofing' => ['name' => 'Corrugated Roofing'],
                    'stone-coated-roofing' => ['name' => 'Stone-coated Roofing'],
                ]],
                'piping-systems' => ['name' => 'Piping Systems', 'icon' => 'pipe', 'l2' => [
                    'hdpe-pipes' => ['name' => 'HDPE Pipes'],
                    'hdpe-fabricated-fittings' => ['name' => 'HDPE Fabricated Fittings'],
                    'dwc-pipes' => ['name' => 'DWC Pipes'],
                    'dwc-fabricated-fittings' => ['name' => 'DWC Fabricated Fittings'],
                    'spiral-pipes' => ['name' => 'Spiral Pipes'],
                    'spiral-fabricated-fittings' => ['name' => 'Spiral Fabricated Fittings'],
                    'ppr-pipes' => ['name' => 'PPR Pipes'],
                    'telecom-pipes' => ['name' => 'Telecom Pipes'],
                    'pp-compression-fittings' => ['name' => 'PP Compression Fittings'],
                    'hdpe-butt-fusion-fittings' => ['name' => 'HDPE Butt-fusion Fittings'],
                    'hdpe-socket-welding' => ['name' => 'HDPE Socket Welding'],
                    'ppr-fittings' => ['name' => 'PPR Fittings'],
                    'multilayer-pipes-and-fittings' => ['name' => 'Multilayer Pipes & Fittings'],
                    'dwc-fittings-imported' => ['name' => 'DWC Fittings - Imported'],
                    'drainage-fittings' => ['name' => 'Drainage Fittings'],
                    'ducting' => ['name' => 'Ducting'],
                    'installation-equipment' => ['name' => 'Installation Equipment'],
                    'miscellaneous-toppipe-fittings' => ['name' => 'Miscellaneous Toppipe Fittings'],
                ]],
            ],
        ],
        'surfaces-finishes' => [
            'name' => 'Surfaces & Finishes',
            'eyebrow' => 'FINISH',
            'description' => 'Tiles, stone, sanitaryware, fittings and the finishes you see.',
            'l1' => [
                'tiles' => ['name' => 'Tiles', 'icon' => 'grid-pattern', 'l2' => [
                    'ceramic-tiles' => ['name' => 'Ceramic Tiles'],
                    'mosaic-tiles' => ['name' => 'Mosaic Tiles'],
                    'porcelain-tiles' => ['name' => 'Porcelain Tiles'],
                    'pvc-vinyl-tiles' => ['name' => 'PVC Vinyl Tiles'],
                ]],
                'glass-blocks' => ['name' => 'Glass Blocks', 'icon' => 'rectangle-vertical', 'l2' => [
                ]],
                'marble-granite-and-quartz' => ['name' => 'Marble, Granite & Quartz', 'icon' => 'mountain', 'l2' => [
                    'marble-tiles' => ['name' => 'Marble Tiles'],
                    'granite-worktops' => ['name' => 'Granite Worktops'],
                    'quartz-worktops' => ['name' => 'Quartz Worktops'],
                    'sintered-stone-worktops' => ['name' => 'Sintered Stone Worktops'],
                ]],
                'kitchen-sinks' => ['name' => 'Kitchen Sinks', 'icon' => 'bowl', 'l2' => [
                ]],
                'sanitaryware' => ['name' => 'Sanitaryware', 'icon' => 'wash', 'l2' => [
                    'basins' => ['name' => 'Basins'],
                    'bathtubs' => ['name' => 'Bathtubs'],
                    'bidets' => ['name' => 'Bidets'],
                    'urinals' => ['name' => 'Urinals'],
                    'shower-trays' => ['name' => 'Shower Trays'],
                    'wcs' => ['name' => 'WCs'],
                    'flushing-systems' => ['name' => 'Flushing Systems'],
                    'miscellaneous' => ['name' => 'Miscellaneous'],
                    'shower-units' => ['name' => 'Shower Units'],
                ]],
                'mixers-showers-and-taps' => ['name' => 'Mixers, Showers & Taps', 'icon' => 'droplet', 'l2' => [
                    'hand-showers' => ['name' => 'Hand Showers'],
                    'overhead-showers' => ['name' => 'Overhead Showers'],
                    'shower-systems' => ['name' => 'Shower Systems'],
                    'side-showers' => ['name' => 'Side Showers'],
                    'shower-sets' => ['name' => 'Shower Sets'],
                    'shower-accessories' => ['name' => 'Shower Accessories'],
                    'basin-mixers' => ['name' => 'Basin Mixers'],
                    'shower-mixers' => ['name' => 'Shower Mixers'],
                    'bidet-mixers' => ['name' => 'Bidet Mixers'],
                    'bath-mixers' => ['name' => 'Bath Mixers'],
                    'infrared-mixers' => ['name' => 'Infrared Mixers'],
                    'sink-mixers' => ['name' => 'Sink Mixers'],
                    'thermostatic-bath-mixers' => ['name' => 'Thermostatic Bath Mixers'],
                    'thermostatic-shower-mixers' => ['name' => 'Thermostatic Shower Mixers'],
                    'flush-valves' => ['name' => 'Flush Valves'],
                    'taps-and-mixers' => ['name' => 'Taps & Mixers'],
                    'accessories' => ['name' => 'Accessories'],
                    'mixers' => ['name' => 'Mixers'],
                    'miscellaneous' => ['name' => 'Miscellaneous'],
                ]],
                'bathroom-accessories' => ['name' => 'Bathroom Accessories', 'icon' => 'tools-kitchen-2', 'l2' => [
                ]],
                'tile-fitting-accessories' => ['name' => 'Tile Fitting Accessories', 'icon' => 'screw', 'l2' => [
                ]],
                'flooring' => ['name' => 'Flooring', 'icon' => 'grid-3x3', 'l2' => [
                    'wpc' => ['name' => 'WPC'],
                    'spc' => ['name' => 'SPC'],
                    'engineered-wood' => ['name' => 'Engineered Wood'],
                    'bamboo' => ['name' => 'Bamboo'],
                    'laminate' => ['name' => 'Laminate'],
                    'miscellaneous' => ['name' => 'Miscellaneous'],
                ]],
                'bathroom-furniture' => ['name' => 'Bathroom Furniture', 'icon' => 'armchair', 'l2' => [
                ]],
                'gypsum-and-cornices' => ['name' => 'Gypsum & Cornices', 'icon' => 'frame', 'l2' => [
                ]],
                'construction-chemicals' => ['name' => 'Construction Chemicals', 'icon' => 'flask', 'l2' => [
                    'adhesive' => ['name' => 'Adhesive'],
                    'grout' => ['name' => 'Grout'],
                    'tile-applications' => ['name' => 'Tile Applications'],
                    'wall-finish-applications' => ['name' => 'Wall Finish Applications'],
                    'floor-finish-applications' => ['name' => 'Floor Finish Applications'],
                ]],
            ],
        ],
        'softs-decor' => [
            'name' => 'Softs & Decor',
            'eyebrow' => 'DECORATE',
            'description' => 'Furniture, fabrics, lighting and the layers that make a space.',
            'l1' => [
                'carpets' => ['name' => 'Carpets', 'icon' => 'rug', 'l2' => [
                    'rugs' => ['name' => 'Rugs'],
                    'tiles' => ['name' => 'Tiles'],
                    'wall-to-wall' => ['name' => 'Wall to Wall'],
                    'accessories' => ['name' => 'Accessories'],
                ]],
                'home-furniture' => ['name' => 'Home Furniture', 'icon' => 'armchair-2', 'l2' => [
                    'living-room-furniture' => ['name' => 'Living Room Furniture'],
                    'bedroom-furniture' => ['name' => 'Bedroom Furniture'],
                    'dining-room-furniture' => ['name' => 'Dining Room Furniture'],
                ]],
                'office-furniture' => ['name' => 'Office Furniture', 'icon' => 'desk', 'l2' => [
                    'desk-and-tables' => ['name' => 'Desk & Tables'],
                    'sofas-and-chairs' => ['name' => 'Sofas & Chairs'],
                    'cabinets' => ['name' => 'Cabinets'],
                    'workstation-screens' => ['name' => 'Workstation Screens'],
                    'cable-management' => ['name' => 'Cable Management'],
                ]],
                'garden-furniture' => ['name' => 'Garden Furniture', 'icon' => 'tree', 'l2' => [
                    'outdoor-furniture' => ['name' => 'Outdoor Furniture'],
                    'swings' => ['name' => 'Swings'],
                    'shades' => ['name' => 'Shades'],
                ]],
                'home-linen' => ['name' => 'Home Linen', 'icon' => 'wash-machine', 'l2' => [
                    'bath-linen' => ['name' => 'Bath Linen'],
                    'bed-linen' => ['name' => 'Bed Linen'],
                ]],
                'home-decor-and-storage' => ['name' => 'Home Decor & Storage', 'icon' => 'lamp', 'l2' => [
                    'home-decor' => ['name' => 'Home Decor'],
                    'storage' => ['name' => 'Storage'],
                ]],
                'kitchenware' => ['name' => 'Kitchenware', 'icon' => 'tools-kitchen-3', 'l2' => [
                    'tableware' => ['name' => 'Tableware'],
                    'misc-kitchenware' => ['name' => 'Misc Kitchenware'],
                ]],
                'lighting' => ['name' => 'Lighting', 'icon' => 'bulb', 'l2' => [
                    'interior-lighting' => ['name' => 'Interior Lighting'],
                    'exterior-lighting' => ['name' => 'Exterior Lighting'],
                    'commercial-lighting' => ['name' => 'Commercial Lighting'],
                ]],
                'fitness-and-wellness' => ['name' => 'Fitness & Wellness', 'icon' => 'barbell', 'l2' => [
                    'gym-equipment' => ['name' => 'Gym Equipment'],
                    'sports-equipment' => ['name' => 'Sports Equipment'],
                    'accessories' => ['name' => 'Accessories'],
                ]],
                'furnishing-fabrics-and-wallpaper' => ['name' => 'Furnishing Fabrics & Wallpaper', 'icon' => 'wallpaper', 'l2' => [
                    'furnishing-fabric' => ['name' => 'Furnishing Fabric'],
                    'wall-paper' => ['name' => 'Wall Paper'],
                ]],
                'blinds' => ['name' => 'Blinds', 'icon' => 'blinds', 'l2' => [
                    'roman' => ['name' => 'Roman'],
                    'venetian' => ['name' => 'Venetian'],
                    'vertical' => ['name' => 'Vertical'],
                    'roller' => ['name' => 'Roller'],
                    'panel' => ['name' => 'Panel'],
                    'accessories' => ['name' => 'Accessories'],
                ]],
                'curtain-tracks' => ['name' => 'Curtain Tracks', 'icon' => 'border-horizontal', 'l2' => [
                ]],
            ],
        ],
    ];
}


/** Returns the ecosystem definition or null. */
function tc_get_ia_ecosystem($eco_slug) {
    $ia = tc_get_ia_structure();
    return $ia[$eco_slug] ?? null;
}

/** Returns the L1 sub-cat under an ecosystem, or null. */
function tc_get_ia_l1($eco_slug, $l1_slug) {
    $eco = tc_get_ia_ecosystem($eco_slug);
    return $eco['l1'][$l1_slug] ?? null;
}

/** Returns the L2 sub-cat under an L1, or null. */
function tc_get_ia_l2($eco_slug, $l1_slug, $l2_slug) {
    $l1 = tc_get_ia_l1($eco_slug, $l1_slug);
    return $l1['l2'][$l2_slug] ?? null;
}

/** Returns ordered array of [eco_slug, l1_slug, l2_slug?] for the current page. */
function tc_get_ia_context_for_page($post_id = null) {
    if (!$post_id) { $post_id = get_queried_object_id(); }
    if (!$post_id) return null;
    $post = get_post($post_id);
    if (!$post) return null;
    $path = get_page_uri($post);
    $segments = array_values(array_filter(explode('/', $path)));
    if (count($segments) < 1) return null;
    $eco_slug = $segments[0];
    $eco = tc_get_ia_ecosystem($eco_slug);
    if (!$eco) return null;
    $ctx = ['eco_slug' => $eco_slug, 'l1_slug' => null, 'l2_slug' => null];
    if (count($segments) >= 2 && isset($eco['l1'][$segments[1]])) {
        $ctx['l1_slug'] = $segments[1];
        if (count($segments) >= 3 && isset($eco['l1'][$segments[1]]['l2'][$segments[2]])) {
            $ctx['l2_slug'] = $segments[2];
        }
    }
    return $ctx;
}

/** URL for an L1 archive page. */
function tc_get_ia_l1_url($eco_slug, $l1_slug) {
    return home_url('/' . $eco_slug . '/' . $l1_slug . '/');
}

/** URL for an L2 archive page. */
function tc_get_ia_l2_url($eco_slug, $l1_slug, $l2_slug) {
    return home_url('/' . $eco_slug . '/' . $l1_slug . '/' . $l2_slug . '/');
}
