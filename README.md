# tcc_website_2026

Custom WordPress theme code for the T&C website relaunch (www.tileandcarpet.co.ke).

## Structure
- `tc-theme/` — Custom WordPress child theme (parent: Blocksy Free)
  - `style.css` — theme metadata
  - `functions.php` — enqueues, theme supports, ACF JSON sync paths, robots noindex during build
  - `theme.json` — design tokens (T&C palette, typography, spacing)
  - `header.php`, `footer.php`, `index.php` — placeholder templates (Phase 2 replaces with full templates)
  - `template-parts/` — reusable section templates (built in Phase 2)
  - `inc/acf-json/` — ACF field group JSON sync (populated in Phase 2)
  - `assets/` — CSS, JS, images

## Status
Phase 1 (Foundation) scaffold — minimal placeholder rendering proving the build pipeline works. Phase 2 builds the actual templates.

## Build context
The theme is deployed to and edited directly on a WordPress install via the Novamira MCP plugin. This repo serves as version history and disaster-recovery backup, not as the deploy mechanism.

## License
Proprietary. (c) Tile & Carpet Centre.
