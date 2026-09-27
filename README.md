# Liquid Glass — Apple-Inspired WordPress Block Theme

A production-ready WordPress theme built on a coherent "Liquid Glass" design system: translucent layered surfaces, restrained depth, system typography, full dark mode, WCAG 2.2 AA accessibility, and native Gutenberg integration with zero external dependencies (no page builders, no icon fonts, no jQuery, no SaaS).

- **Requires:** WordPress 6.4+ · PHP 7.4+
- **Text domain:** `liquid-glass`
- **License:** GPL v2 or later

> **This repository *is* the theme.** All theme files live at the top level, and `.gitattributes` + CI are set up so you can get a WordPress-installable zip straight from GitHub (see below).

## Install from GitHub

### Option A — Download the Release asset (recommended)

1. Go to the repo's **Releases** page and download **`liquid-glass.zip`** (CI attaches it automatically on every `v*` tag).
2. In wp-admin: **Appearance → Themes → Add New → Upload Theme** → choose `liquid-glass.zip` → **Install Now** → **Activate**.

### Option B — Green "Code → Download ZIP" button

Thanks to `.gitattributes` (`export-ignore`), GitHub's auto-generated source archive contains **only** the theme files (no `.github/`, `bin/`, etc.). The theme header sits at the **root** of that archive. WordPress's uploader expects everything inside a single top-level folder, so re-wrap it in one command:

```bash
mkdir liquid-glass && unzip -q <repo>-main.zip -d liquid-glass && zip -rq liquid-glass.zip liquid-glass
```

Then upload `liquid-glass.zip` in wp-admin. (Alternatively, install it straight from GitHub with a helper plugin such as **GitHub Updater**.)

### Option C — Build the zip locally

```bash
git clone https://github.com/<owner>/<repo>.git liquid-glass-src
cd liquid-glass-src
bash bin/build-zip.sh          # -> ./liquid-glass.zip
```

Then upload `liquid-glass.zip` in wp-admin (**Appearance → Themes → Add New → Upload Theme**), or copy the `liquid-glass/` folder into `wp-content/themes/`.

### After activation

1. **Homepage:** create a page (e.g. "Home") and leave its content **empty** — the bundled Liquid Glass homepage pattern renders automatically; or insert the pattern **Liquid Glass: Homepage** from the pattern inserter. Then choose it under **Settings → Reading → A static page**.
2. **Menu:** create one at **Appearance → Menus** and assign it to **Primary** (or build it in the Site Editor).
3. Optional: add widgets to Footer columns 1–3 and the Sidebar area.

## Customization (no code required)

**Appearance → Customize → Liquid Glass Options:**

- Accent color and page background color
- Corner radius scale (sharp → soft → round)
- Content width / wide width
- Header behavior (static, sticky, floating glass)
- Ambient background illumination on/off
- Light / Dark / Auto appearance (visitors can also toggle it in the header; "Auto" follows `prefers-color-scheme`)

The site identity (logo, title, tagline) uses the standard WordPress Customizer panel. All colors, type scale, spacing, radii, shadows and gradients are defined in `theme.json`, so the editor sidebar's appearance tools work out of the box.

## Repository layout

```
.                           # = the liquid-glass/ theme folder when zipped
├── style.css               # Theme header only (styles live in assets/css/)
├── screenshot.png          # Theme preview shown in wp-admin (1200×900)
├── theme.json              # Design tokens: palette, gradients, type, spacing, layout, block styles
├── functions.php           # Constants + inc/ loader
├── header.php footer.php index.php front-page.php single.php page.php
├── archive.php search.php 404.php comments.php
├── parts/                  # header / footer / sidebar template parts
├── template-parts/         # content card partials
├── inc/                    # setup, enqueue, customizer, template tags, patterns
├── patterns/               # PHP-registered block patterns (hero, features, latest-articles, cta, homepage)
├── assets/                 # css/ js/ images/
│
├── .gitattributes          # export-ignore rules → clean GitHub "Download ZIP" archives
├── .github/workflows/      # CI: builds & attaches liquid-glass.zip to Releases on v* tags
└── bin/build-zip.sh        # local one-command zip builder
```

## Developer notes

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

## Releasing a new version

1. Bump `Version:` in `style.css` and `LIQUID_GLASS_VERSION` in `functions.php`.
2. Commit to `main`, then tag and push:
   ```bash
   git tag -a v1.0.0 -m "Liquid Glass 1.0.0"
   git push origin main --follow-tags
   ```
3. GitHub Actions builds `liquid-glass.zip` and attaches it to the Release automatically.
