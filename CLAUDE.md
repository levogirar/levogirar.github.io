# CLAUDE.md

## Project Overview

Personal portfolio website for Jonathan Chu Lo (Lead Solutions Engineer at Shopify, Iberia market). Static HTML/CSS/JS site hosted on GitHub Pages at `chulo.me`.

No build tools, no framework, no package manager. Direct file editing and commit-to-deploy.

## Repository Structure

```
/
├── index.html          # Main portfolio page (sole public-facing HTML at root)
├── style.css           # Global stylesheet (~900 lines)
├── CNAME               # Custom domain: chulo.me
├── README.md
├── assets/
│   ├── Atkinson-Web-2020/   # Atkinson Hyperlegible font files (EOT, SVG, TTF, WOFF, WOFF2)
│   ├── education/           # Education section images (JPEG)
│   ├── favicon/             # Favicons at 16/32/57/76/96/120/128/144/152/180/196px
│   ├── wuwana/              # Wuwana project screenshots
│   ├── profile.jpg
│   ├── website-cover.png
│   ├── wuwana-logo.svg
│   └── chu-jonathan-resume.pdf
├── projects/
│   ├── flappy-bird/         # p5.js game (sketch.js, bird.js, pipe.js)
│   ├── raycasting/          # p5.js visualization (sketch.js, particle.js, ray.js, boundary.js)
│   ├── search/              # Autocomplete demo (main.html, main.js, auto.js, style.css)
│   └── scrapers/            # PHP/JS web scraping utilities
└── wuwana/
    ├── facebook-review.html / .css
    └── google-place.html / .css
```

## Tech Stack

- **HTML5** — semantic elements, no templating engine
- **CSS** — vanilla, no preprocessor (no SCSS/LESS)
- **JavaScript** — vanilla JS; p5.js only in `projects/` for canvas demos
- **PHP** — scraper utilities in `projects/scrapers/` only
- **Hosting** — GitHub Pages (push to `main` = deploy)
- **Domain** — `chulo.me` via CNAME

## CSS Conventions

### Custom Properties (defined at `:root` in `style.css`)

Colors: `--grey700`, `--yellow`, `--blue`, `--salmon`, `--red`, `--sunflower`, `--storm`, `--pink`, `--citric`

Font sizes: `--font-xs`, `--font-s`, `--font-m`, `--font-l`, `--font-xl`

Always use these variables — never hardcode hex/rgb values.

### Naming

BEM-like class naming: `.section-name`, `.section-name__element`, `.section-name--modifier`

Examples: `.previous-jobs`, `.previous-jobs__role`, `.education-line`, `.action-button`

### Layout

- Max-width wrapper: **1000px** (desktop), **600px** (mobile)
- Flexbox for all layouts — no CSS Grid currently
- Mobile breakpoint: `@media screen and (max-width: 500px)`
- Mobile-first responsive approach

### Accessibility

- Font: Atkinson Hyperlegible (self-hosted in `assets/Atkinson-Web-2020/`) — chosen for readability
- Always respect `prefers-reduced-motion` for animations
- All images must have `alt` attributes
- Maintain WCAG color contrast ratios using the defined CSS variables

## HTML Conventions

- Semantic elements: `<section>`, `<header>`, `<footer>`, `<nav>`
- Inline SVG for icons (keeps assets self-contained)
- Full meta tag set: Open Graph + Twitter Cards on every HTML file
- Favicon set covering all sizes (reference `index.html` `<head>` as template)
- No JavaScript frameworks — DOM manipulation is vanilla JS only

## Development Workflow

1. Edit files directly (no build step required)
2. Test in browser locally by opening `index.html`
3. Commit changes to the appropriate branch
4. Push to `main` to deploy to GitHub Pages

```bash
# Make changes, then:
git add <files>
git commit -m "descriptive message"
git push origin main
```

GitHub Pages serves the repository root. There is no `gh-pages` branch or `docs/` folder — `main` IS the site.

## Branching

- `main` — production, deploys immediately to `chulo.me`
- Feature branches: `claude/<description>` or descriptive names
- Merge feature branches into `main` when work is complete

## Git Commit Style

Short imperative messages describing the change:
- `"Use clamp for fluid h1 typography"`
- `"Add education section images"`
- `"Update Shopify role description"`

No ticket references, no co-author footers unless explicitly required.

## Key Content Sections (index.html)

1. **Hero** — profile photo, name, title, LinkedIn CTA
2. **Work experience** — Shopify (current), Wuwana, Doggy Bathroom
3. **Education** — Juno College UX bootcamp, Universidad de Deusto MBA, Concordia University
4. **Wuwana project showcase** — product screenshots and description
5. **Footer** — copyright, LinkedIn

When editing content, keep the semantic structure and existing class names intact.

## Assets Guidelines

- Images: JPEG for photos, PNG for logos/UI, SVG for icons and vector graphics
- Fonts: already self-hosted; do not add external font CDN links
- New images go in the appropriate `assets/` subdirectory
- Optimize images before committing (keep file sizes reasonable)
- Resume PDF: `assets/chu-jonathan-resume.pdf`

## Projects Directory

Each project in `projects/` is a standalone demo:
- Self-contained HTML/CSS/JS (or PHP)
- May reference p5.js via CDN
- Not linked from `index.html` navigation (accessed by direct URL)
- No shared build pipeline with the main site

## What NOT to Do

- Do not add a build system (webpack, vite, parcel) unless explicitly requested
- Do not add a JavaScript framework (React, Vue, etc.) unless explicitly requested
- Do not introduce npm / `package.json`
- Do not hardcode color values — use CSS custom properties
- Do not add inline styles to HTML; keep styling in CSS files
- Do not break the existing favicon set or meta tags when editing `<head>`
- Do not push directly to `main` without review when working on significant changes
