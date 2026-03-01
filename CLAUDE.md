# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Future Digital Productions is a video production company website built with **Laravel 12** (PHP backend) + **Blade templates** + **Tailwind CSS v4** (via Vite). Content is managed through a **Sanity CMS** studio that lives in the `sanity/` subdirectory.

## Commands

### Laravel Application (root)

```bash
composer run dev        # Start all services: PHP server, queue listener, Pail log viewer, and Vite
composer run test       # Clear config cache and run PHPUnit
php artisan test        # Run all tests
php artisan test --filter=ExampleTest  # Run a single test
npm run dev             # Vite dev server only
npm run build           # Build frontend assets
php artisan pint        # Run Laravel Pint (PHP code style fixer)
```

### Sanity Studio (`sanity/` directory)

```bash
cd sanity
npm run dev             # Start local Sanity Studio
npm run deploy          # Deploy studio to sanity.io
npm run seed            # Seed content (sanity exec scripts/seed.mjs)
```

### Initial Setup

```bash
composer run setup      # Full first-time setup: install deps, .env, key, migrate, npm build
```

## Architecture

### Request Flow

```
Browser → Laravel Route (routes/web.php)
        → Controller (app/Http/Controllers/)
        → SanityRepository (app/Repositories/SanityRepository.php)
        → Sanity service (app/Services/Sanity.php) — GROQ query with cache
        → Blade view (resources/views/)
```

### Key Architectural Decisions

**Two-layout system**: The app has two Blade layouts:
- `layouts/app.blade.php` — the original layout (no `$siteSettings` passed, no SEO meta)
- `layouts/site.blade.php` — the more complete layout with `$siteSettings`, SEO meta, and inline JS fallback when Vite isn't built. Most pages currently use `layouts/app.blade.php`.

**Sanity as headless CMS**: All content (services, portfolio items, testimonials, site settings, pages) lives in Sanity. The `Sanity` service class (`app/Services/Sanity.php`) makes authenticated GET requests to the Sanity GROQ API, with results cached using Laravel's cache system. `SanityRepository` (`app/Repositories/SanityRepository.php`) holds all GROQ queries and cache TTLs — this is the single source of truth for content fetching.

**Currently hardcoded content**: Several views (notably `pages/home.blade.php`) still use hardcoded PHP arrays for services and testimonials rather than fetching from Sanity. The infrastructure to fetch from Sanity exists but the controllers haven't been wired up to pass Sanity data to views yet.

**CSS approach**: Custom CSS is written in `resources/css/app.css` using CSS custom properties for the design tokens. Tailwind v4 is included but most styling is done with custom classes (`.section`, `.card`, `.strip`, `.cta-block`, `.container`, `.narrow`, etc.). Tailwind utility classes appear on body/html in the layouts but bespoke CSS classes dominate.

**No JS framework**: JavaScript is vanilla. The main `site.blade.php` layout contains inline JS for nav scroll behaviour, scroll-reveal animations (`[data-reveal]` / `is-visible`), and mobile menu toggling. Individual pages may include their own `<script>` blocks (e.g., testimonial carousel on the homepage).

### Sanity Schema Types

Documents: `page`, `service`, `portfolioItem`, `portfolioCategory`, `testimonial`, `siteSettings`

Objects: `heroMedia` (supports image or Vimeo video), `navItem`, `seo`, `benefitItem`

### Required Environment Variables

```
SANITY_PROJECT_ID=     # Sanity project ID
SANITY_DATASET=        # Defaults to "production"
SANITY_API_VERSION=    # Defaults to "2024-01-01"
SANITY_TOKEN=          # Optional; needed only for private datasets/drafts
```

### Routes

All routes are in `routes/web.php`. Service pages use a `services/` prefix group. The `QuoteController` handles both GET (show form) and POST (submit) for `/get-a-quote`.

### View Structure

```
resources/views/
  layouts/         # app.blade.php (basic), site.blade.php (full with SEO)
  pages/           # One file per page route; services/ subdirectory for service pages
  partials/        # nav.blade.php, footer.blade.php, hero.blade.php
  components/      # button.blade.php (used as <x-button href="...">)
```

### Sanity Studio Structure

The studio is a standalone app in `sanity/` with its own `package.json` and `node_modules`. It runs independently from the Laravel app. Schema types in `sanity/schemaTypes/` define the content model. The custom structure in `sanity/structure.ts` controls the Studio sidebar layout.
