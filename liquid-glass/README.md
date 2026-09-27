# Liquid Glass — Apple-Inspired WordPress Block Theme

A production-ready WordPress theme built on a coherent "Liquid Glass" design system: translucent layered surfaces, restrained depth, system typography, full dark mode, WCAG 2.2 AA accessibility, and native Gutenberg integration with zero external dependencies (no page builders, no icon fonts, no jQuery, no SaaS).

- **Requires:** WordPress 6.4+ · PHP 7.4+
- **Text domain:** `liquid-glass`
- **License:** GPL v2 or later

## Installation

1. In wp-admin go to **Appearance → Themes → Add New → Upload Theme**.
2. Choose `liquid-glass.zip` and click **Install Now**, then **Activate**.
   - Alternatively upload the unzipped `liquid-glass/` folder to `wp-content/themes/`.
3. Set up your homepage: create a page (e.g. "Home"), leave its content **empty** and the bundled Liquid Glass homepage pattern renders automatically; or insert the pattern **Liquid Glass: Homepage** from the pattern inserter. Then choose it under **Settings → Reading → A static page**.
4. Create a menu at **Appearance → Menus** and assign it to the **Primary** location (or build one in the Site Editor).
5. Optional: add widgets to Footer columns 1–3 and the Sidebar area.

## Customization (no code required)

**Appearance → Customize → Liquid Glass Options:**

- Accent color and page background color
- Corner radius scale (sharp → soft → round)
- Content width / wide width
- Header behavior (static, sticky, floating glass)
- Ambient background illumination on/off
- Light / Dark / Auto appearance (visitors can also toggle it in the header; "Auto" follows `prefers-color-scheme`)

The site identity (logo, title, tagline) uses the standard WordPress Customizer panel. All colors, type scale, spacing, radii, shadows and gradients are defined in `theme.json`, so the editor sidebar's appearance tools work out of the box.

## Developer notes

```
liquid-glass/
├── style.css            # Theme header only (styles live in assets/css/)
├── theme.json           # Design tokens: palette, gradients, type, spacing, layout, block styles
├── functions.php        # Constants + inc/ loader
├── header.php footer.php index.php front-page.php single.php page.php
├── archive.php search.php 404.php comments.php
├── parts/               # header / footer / sidebar template parts
├── template-parts/      # content card partials
├── inc/                 # setup, enqueue, customizer, template tags, patterns
├── patterns/            # PHP-registered block patterns (hero, features, latest-articles, cta, homepage)
└── assets/ css/ js/ images/
```

- **Design tokens** are CSS custom properties (`--glass-*`, `--text-*`, `--spacing-*`, …) declared in `assets/css/tokens.css` and mirrored in `theme.json`. Change the visual identity in those two files only.
- **Glass layers** L0–L5 are documented inline in `tokens.css`; use the component classes (`glass-surface`, `glass-card`, `glass-panel`, `glass-button`, `glass-header`, `glass-navigation`, `glass-modal`, `glass-alert`) rather than new ad-hoc blur rules.
- **Patterns** return an array from each file in `/patterns`; `inc/block-patterns.php` registers them automatically.
- **Hooks/filters:** `liquid_glass_custom_css` (string appended to inline CSS), `liquid_glass_accent_color`, `liquid_glass_content_width`.
- All output is escaped at render time; all Customizer input is sanitized. Strings are translation-ready — wrap in `__()`/`_e()` with the `liquid-glass` text domain when extending.

## Accessibility & performance

- Semantic landmarks, skip link, visible focus rings, keyboard-operable menus, labelled controls.
- `prefers-reduced-motion` disables transitions/animations; `prefers-reduced-transparency` swaps glass for solid surfaces.
- `@supports` fallbacks keep every surface readable without `backdrop-filter`.
- System font stack, deferred vanilla JS (~4 KB total), lazy-loaded images, no external requests.

## Known limitations

- The legacy Primary menu and the Site-Editor Navigation block are both styled, but mixing them shows the legacy menu first.
- RTL stylesheet is not yet bundled.
