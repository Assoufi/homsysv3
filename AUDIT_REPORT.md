# HOMYS.MA — Comprehensive Digital Product Audit Report

**Prepared by:** Senior Digital Product Consultant (UX/UI, Product, SEO, Performance, Laravel, CRO, Accessibility)  
**Date:** July 19, 2026  
**Version:** 1.0  
**Scope:** Complete audit of https://homsys.ma — IT Recruitment Agency Platform (Laravel 12)

---

## Executive Summary

Homsys.ma is a functional but **critically outdated** Laravel-based recruitment platform. While the core business logic works, the technology stack, user experience, design system, and technical architecture are approximately **8–10 years behind modern standards**. The site uses a purchased Bootstrap 3 theme (Butterfly from BootstrapTaste, circa 2015) with jQuery 2.2.3, Font Awesome 4.5, and legacy jQuery plugins (WOW.js, Isotope, scrollToFixed).

**Overall Score: 38/100**

| Dimension | Score | Status |
|-----------|-------|--------|
| **Technical Architecture (Laravel)** | 35/100 | Critical — Legacy patterns, no service layer, N+1 queries, no caching |
| **Frontend / UI / UX** | 25/100 | Critical — Bootstrap 3, hardcoded content, no design system, poor mobile |
| **SEO / Technical SEO** | 30/100 | Critical — No structured data, thin content, duplicate meta, no content strategy |
| **Performance / Core Web Vitals** | 28/100 | Critical — No optimization, old libraries, render-blocking resources |
| **Accessibility (WCAG 2.2)** | 32/100 | Poor — Missing ARIA, contrast issues, keyboard traps, no skip links |
| **Conversion Rate Optimization** | 30/100 | Poor — Weak CTAs, no trust signals, friction in application flow |
| **Security Perception** | 45/100 | Fair — Basic Laravel auth, but outdated dependencies, no CSP |
| **Maintainability / Scalability** | 25/100 | Critical — Spaghetti code, mixed layouts, no tests, no coding standards |

---

## PART 1 — GLOBAL WEBSITE AUDIT (Scoring & Analysis)

### 1.1 Branding — **Score: 4/10**

| Issue | Why It Matters | Solution | Priority |
|-------|----------------|----------|----------|
| Logo kept but no brand system | Logo exists in isolation; no color palette, typography scale, icon style, illustration style, or brand voice defined | Create a **Brand Guidelines** document: primary/secondary colors, typography (modern Google Font), spacing scale, icon library (Lucide/Phosphor), illustration style, photography direction, tone of voice | **HIGH** |
| Inconsistent visual language | Bootstrap 3 default buttons, custom CSS overrides, mixed icon sets (Font Awesome 4 + custom `homsys-icon` font), hardcoded colors (`homsys-bgcolor`, `homsys-blue`) | Define design tokens (CSS custom properties) and migrate to a modern utility-first system (Tailwind CSS v4) or a curated Bootstrap 5 custom build | **HIGH** |
| No favicon / touch icons audit | Only `logo-homsys-sigle.png` referenced in OG tags; no `apple-touch-icon`, `manifest.json`, `favicon.ico` variants | Generate full favicon suite via RealFaviconGenerator; add Web App Manifest for PWA installability | **MEDIUM** |

---

### 1.2 Visual Identity — **Score: 3/10**

| Issue | Why It Matters | Solution | Priority |
|-------|----------------|----------|----------|
| Bootstrap 3.3.6 (2015) + jQuery 2.2.3 (2016) + Font Awesome 4.5 (2015) | Security vulnerabilities, no modern CSS features (Grid, Flexbox, custom properties), massive bundle size, browser compatibility issues | Migrate to **Bootstrap 5.3** (or Tailwind CSS v4) + **Vanilla JS / Alpine.js** + **Lucide/Phosphor icons** (SVG) | **CRITICAL** |
| Custom icon font `homsys-icon` (likely IcoMoon export) | Non-accessible, hard to maintain, no tree-shaking, blurry on high-DPI | Replace with **SVG icon system** (inline sprite or component-based) | **HIGH** |
| Hardcoded colors throughout CSS (`homsys-bgcolor`, `homsys-blue`, inline styles) | Impossible to theme, no dark mode, inconsistent spacing | Design token system → CSS custom properties → utility classes | **HIGH** |
| WOW.js (animate.css) for scroll animations | Janky, blocks main thread, accessibility issues (reduced motion ignored) | Use **IntersectionObserver** + CSS `animation` with `prefers-reduced-motion` | **MEDIUM** |

---

### 1.3 Homepage — **Score: 4/10**

| Issue | Why It Matters | Solution | Priority |
|-------|----------------|----------|----------|
| **Hardcoded job listings** in `home.blade.php` (lines 10–113) | Content not from database; stale data (2020 dates); impossible to manage via CMS | Fetch latest 6 jobs from `Offre` model; use partial `partials/job-card.blade.php` | **CRITICAL** |
| **Hardcoded categories** with fake counts (lines 158–167) | Misleads candidates; no dynamic category management | Create `Category` model + migration; seed real data; display actual counts via `withCount('offres')` | **HIGH** |
| **Hardcoded testimonials** (lines 174–205) | No CMS; fake names/photos; no trust signals | Build `Testimonial` model + admin CRUD; show real client logos + photos + video testimonials | **HIGH** |
| **Hardcoded blog posts** with external images (lines 215–260) | Hotlinking images (bandwidth theft); broken links likely; no CMS | Create `Article` model + Filament admin; use local optimized images (WebP/AVIF); proper slugs | **HIGH** |
| **Fake counters** (`nb_offres + 1000`, `nb_cv + 10000`) | Destroys trust if discovered; illegal in some jurisdictions | Show **real** counts; add "Depuis 2009 — X candidats placés" with verifiable data | **CRITICAL** |
| No hero value proposition | Generic tagline "Viser plus haut..." doesn't differentiate | Craft **unique value proposition**: "Le seul cabinet IT marocain spécialisé Freelance + CDI + Portage, avec 92% de taux de satisfaction client" | **HIGH** |
| No trust badges / certifications / partner logos in hero | Candidates/employers need immediate credibility signals | Add: "Partenaire Microsoft / AWS / Oracle", "150+ clients", "4.8/5 Google Reviews", "Membre APEC" | **HIGH** |

---

### 1.4 Navigation — **Score: 3/10**

| Issue | Why It Matters | Solution | Priority |
|-------|----------------|----------|----------|
| Two different layouts: `layouts.front` + `layouts.front2` + `layouts.app` + `template.blade.php` | Inconsistent UX; maintenance nightmare; different nav on different pages | **Unify to single layout** (`layouts.app`) with slot-based sections | **CRITICAL** |
| jQuery-based mobile menu (`.res-nav_click` + `slideToggle`) | Broken on touch; no focus trap; no ESC close; animation jank | Use **Alpine.js** `<nav x-data="{ open: false }">` with `<transition>` | **HIGH** |
| Sticky header via `scrollToFixed` (jQuery plugin) | Layout shift on scroll; CLS issues; no CSS `position: sticky` fallback | Native CSS `position: sticky; top: 0; z-index: 100` + `backdrop-filter` for glassmorphism | **HIGH** |
| No mega-menu for categories/services | 8 categories crammed in footer; hard to discover | Mega-menu on "Offres" / "Services" with icons, counts, "Voir tout" | **MEDIUM** |
| No breadcrumb component | Users lose context on deep pages (job detail, candidate profile) | Add `<nav aria-label="Fil d'Ariane">` with `schema.org/BreadcrumbList` JSON-LD | **HIGH** |

---

### 1.5 Information Architecture — **Score: 4/10**

| Issue | Why It Matters | Solution | Priority |
|-------|----------------|----------|----------|
| Flat URL structure: `/offres/{id}`, `/candidats/create`, `/portage` | No hierarchy; poor SEO; no topic clusters | Restructure: `/offres`, `/offres/freelance`, `/offres/cdi`, `/offres/{ville}`, `/offres/{techno}`, `/entreprises`, `/candidats`, `/conseils` | **HIGH** |
| No category/skill taxonomy | Cannot filter by technology, seniority, remote, salary | Create `Skill`, `Category`, `ContractType`, `Location` models; many-to-many with `Offre` | **HIGH** |
| Duplicate routes: `/portage` defined twice (lines 17, 20 in `web.php`) | Confusion; SEO duplicate content | Remove duplicate; canonicalize | **LOW** |
| No employer-facing section (only admin) | 30% audience = companies; no self-service posting | Build **Employer Portal**: `/entreprises` dashboard, job posting wizard, candidate pipeline | **HIGH** |
| No blog/article section (hardcoded only) | Misses huge SEO opportunity for "recrutement IT Maroc", "salaire développeur Maroc" | Launch **Blog/Resources** with categories: Conseils CV, Tendances IT, Études de salaire, Témoignages | **HIGH** |

---

### 1.6 Candidate Journey — **Score: 3/10**

| Step | Current State | Impact | Improved Version |
|------|---------------|--------|------------------|
| **Discovery** | Homepage → hardcoded jobs → search | Low trust; stale data | Dynamic job feed + smart filters + "Emplois pour vous" (personalized) |
| **Search** | Basic keyword + city + contract type (GET `/offres/search`) | No filters for tech stack, salary, remote, experience, company size | Faceted search: Stack (React, Laravel, Python...), Seniorité, Télétravail, Salaire, Type, Date |
| **Job Detail** | `show.blade.php` — raw HTML, no schema.org, no apply tracking | Poor SEO; no analytics; no "Sauvegarder" | Rich job card + JSON-LD `JobPosting` + "Sauvegarder" (heart icon) + "Partager" (Web Share API) |
| **Apply** | Redirect to `/offres/postule/{id}` → form with file upload | High friction; no LinkedIn import; no profile prefill | **One-click apply** if profile complete; LinkedIn/Indeed import; progress bar; auto-save draft |
| **Post-apply** | Simple success flash message | No confirmation email tracking; no status page | Candidate dashboard: "Mes candidatures" with status timeline (Reçu → Étude → Entretien → Offre) |
| **Profile** | Basic CRUD in `candidats.update` | No skills tags, no portfolio, no availability calendar | Rich profile: Skills (multi-select), Portfolio links, Video CV, Disponibilité, Prétentions salariales |

---

### 1.7 Employer Journey — **Score: 1/10** (Almost Non-Existent)

| Gap | Business Impact | Solution |
|-----|-----------------|----------|
| No employer landing page | 30% of traffic has no destination | `/entreprises` — value prop, pricing, case studies, "Publier une offre" CTA |
| No self-service job posting | Manual admin only; scales poorly | Employer dashboard: create/edit/boost/close jobs; candidate pipeline (Kanban) |
| No employer branding | Companies can't showcase culture | Company profile page: photos, video, team, benefits, Glassdoor-style reviews |
| No package pricing | Lost revenue (packs of 5, 10, 20 jobs) | Pricing page: "Essentiel / Pro / Enterprise" with featured, urgent, highlighted options |
| No invoicing / subscription | Manual billing | Stripe/Paddle integration; recurring billing; PDF invoices |

---

### 1.8 Job Search Experience — **Score: 3/10**

| Issue | Why It Matters | Solution | Priority |
|-------|----------------|----------|----------|
| Search only on `titre_offre` + `description_offre` (LIKE %) | Misses skills, company, location synonyms; slow on large datasets | **Full-text search**: Meilisearch / Typesense / Laravel Scout + Algolia; index: title, description, skills, company, city, contract_type, salary_range | **HIGH** |
| No faceted filters UI (sidebar has hardcoded checkboxes) | Users can't refine by stack, seniority, remote, salary | Dynamic facets from indexed data; URL-synced filters (nuqs / Laravel query strings) | **HIGH** |
| No "Sauvegarder cette recherche" / Email alerts | Missed retention channel | `JobAlert` model: user + criteria + frequency (quotidien/hebdo); queue email via `Schedule` | **MEDIUM** |
| Pagination via `paginate()` default (15) — no "Voir plus" / infinite scroll | Mobile UX poor; no SEO-friendly pagination | `rel="next/prev"` + `link` headers; option for infinite scroll on mobile | **MEDIUM** |
| No sorting options (date, pertinence, salaire) | Users can't prioritize | Sort dropdown: "Plus récentes", "Mieux rémunérées", "Plus pertinentes" | **MEDIUM** |

---

### 1.9 Readability — **Score: 5/10**

| Issue | Why It Matters | Solution |
|-------|----------------|----------|
| Font: Lato (self-hosted, old weights) + Dosis (headings) — no variable font | Multiple font files; no `font-display: swap`; CLS risk | **Inter Variable** (Google Fonts, `preload`, `font-display: swap`) or **Plus Jakarta Sans** for modern tech feel |
| Base size 14px, line-height 24px — tight for French | French words 20% longer; reduced readability on mobile | Base 16px / 1.6 line-height; `clamp(1rem, 0.9rem + 0.5vw, 1.125rem)` fluid type |
| Low contrast: `#888888` on white (4.1:1) — fails WCAG AA for body text | Accessibility failure; legal risk in EU/Morocco | Minimum `#555555` (7:1) for body; `#333333` (12:1) for headings |
| Long lines in job description (`col-md-8` ~ 760px) | Hard to track; reduces comprehension | Max-width `65ch` / `720px`; `text-wrap: pretty` |
| No semantic HTML in job detail (`<p>{!! $offre->description_offre !!}</p>`) | Screen readers can't navigate structure | Prose component: `<article class="prose prose-lg max-w-none">` with proper `<h2>`, `<ul>`, `<strong>` |

---

### 1.10 Accessibility — **Score: 3/10** (Detailed in Part 8)

---

### 1.11 Mobile Experience — **Score: 2/10**

| Issue | Why It Matters | Solution |
|-------|----------------|----------|
| Bootstrap 3 grid (non-mobile-first) + custom `homsys-column-*` classes | Layout breaks < 768px; horizontal scroll; touch targets too small | **Mobile-first** grid (Bootstrap 5 or Tailwind); 44×44px minimum touch targets |
| Hamburger menu: jQuery `slideToggle` — no focus trap, no ESC, no `aria-expanded` | Keyboard/screen reader users trapped | Alpine.js `<div x-data="{ open: false }" @keydown.escape="open = false">` |
| Job cards: 2-col on desktop → 1-col on mobile but fixed height via `homsys-table-layer` | Content overflow; cut-off text | Flexbox card: `display: flex; flex-direction: column;` with `min-height: 0` |
| Banner search form: 4 inline fields → horizontal scroll on mobile | Unusable on < 400px | Stack fields vertically on mobile; `<select>` native; sticky "Rechercher" at bottom |
| No bottom navigation / sticky CTA on mobile | Thumb zone unreachable; apply button hidden | Sticky footer bar: `<footer class="fixed bottom-0 left-0 right-0 md:hidden">` with "Postuler" + "Sauvegarder" |

---

### 1.12 Tablet Experience — **Score: 3/10**

| Issue | Solution |
|-------|----------|
| No specific tablet breakpoints (only `col-md-*`) | Add `col-lg-*` / `col-xl-*` / `lg:` / `xl:` utilities; test 768px, 1024px |
| Sidebar filters always visible (left col) — wastes space | Collapsible off-canvas filter drawer on `< lg` |
| Job cards 2-col on tablet — OK but tight | 1-col on `< 900px`, 2-col on `≥ 900px` |

---

### 1.13 Desktop Experience — **Score: 5/10**

| Issue | Solution |
|-------|----------|
| Max container width ~1170px (Bootstrap 3) — narrow for 1440p+ | Fluid container `max-width: 1400px`; 12-col grid with 24px gutters |
| Hover effects inconsistent (some cards lift, some don't) | Unified elevation system: `shadow-sm` → `shadow-md` → `shadow-lg` on hover |
| No keyboard focus visible on custom buttons (`.homsys-option-btn`) | `:focus-visible { outline: 2px solid var(--color-primary); outline-offset: 2px; }` |
| ShareThis script loads async but blocks main thread | Replace with native Web Share API + fallback links |

---

### 1.14 Responsiveness — **Score: 3/10**

| Breakpoint | Current | Target |
|------------|---------|--------|
| `< 576px` (mobile) | Broken layout, horizontal scroll, tiny touch targets | Single column, 16px base, 44px touch targets, sticky CTA |
| `576–768px` (large mobile) | 2-col cards too narrow | 1-col cards, stacked forms |
| `768–992px` (tablet) | Sidebar visible, cramped | Off-canvas filters, 2-col job grid |
| `992–1200px` (laptop) | Works but dated | 3-col job grid, sidebar filters |
| `> 1200px` (desktop) | Max 1170px | 1400px max, 4-col job grid option |

---

### 1.15 User Trust — **Score: 3/10**

| Trust Signal | Current | Required |
|--------------|---------|----------|
| Real stats (not +1000 fake) | ❌ Fake counters | ✅ Real counts + "Vérifié par Huissier" badge |
| Client logos (real, clickable) | ❌ Static JPG `references.jpg` | ✅ Carousel with links to case studies |
| Testimonials (video + photo + name + role) | ❌ Fake Lorem Ipsum | ✅ 10+ video testimonials (candidates + employers) |
| Google Reviews / Trustpilot widget | ❌ None | ✅ Embed Google Places reviews (4.8★) |
| Certifications / Partnerships | ❌ None mentioned | ✅ Microsoft Partner, AWS Select, LinkedIn Talent Partner |
| Team photos / "About us" real people | ❌ Stock photo `about-us-thumb.png` | ✅ Real team photos + LinkedIn links |
| Legal mentions / RGPD / CGU accessible | ⚠️ Footer only | ✅ Dedicated `/mentions-legales`, `/rgpd`, `/cgu` pages |
| HTTPS / SSL / Security headers | ❓ Unknown (check) | ✅ HSTS, CSP, X-Frame-Options, Referrer-Policy |

---

### 1.16 CTA Effectiveness — **Score: 3/10**

| CTA | Current | Problem | Improved |
|-----|---------|---------|----------|
| Hero "Rechercher" | Submit button in banner form | No value prop; generic | "Trouver ma mission IT →" + "Je suis entreprise" split CTA |
| Job card "Détail / Postuler" | Small button, low contrast | Weak verb; same style for view vs apply | Primary: "Postuler" (filled) / Secondary: "Voir détails" (outline) |
| Footer "Contactez-nous" | Generic link | No urgency; no form preview | Sticky "Parlons de votre projet" + Calendly embed |
| Candidate "Déposer mon CV" | Link in footer | Buried; no value prop | Hero CTA: "Déposer mon CV en 30s — Gratuit & Confidentiel" |
| Employer "Publier une offre" | Only in admin | Invisible to employers | Top nav "Pour les entreprises" → dedicated landing |

---

### 1.17 Contact Page — **Score: 4/10**

| Issue | Solution |
|-------|----------|
| Form in footer only (no dedicated `/contact` page) | Create `/contact` with: map, phone, email, form, FAQ accordion, response time SLA |
| reCAPTCHA v2 (checkbox) — intrusive | Switch to **reCAPTCHA v3** (invisible) or **hCaptcha** / **Turnstile** |
| No department routing (commercial, technique, candidature) | Dropdown "Objet" → routes to correct email/Slack channel |
| No auto-reply / confirmation email | Laravel Notification: immediate confirmation + ticket number |

---

### 1.18 Forms — **Score: 4/10**

| Form | Issues | Fixes |
|------|--------|-------|
| Candidate registration (`candidats.create`) | Two-step (User → Candidat); no password strength; no inline validation | Single-page multi-step (Alpine.js); zxcvbn password meter; real-time email check |
| Spontaneous application (`candidats.spontane`) | Requires CV upload before account; no LinkedIn import | Allow "Apply with LinkedIn" → prefill profile → optional CV |
| Job application (`offres.postule`) | Separate page; repeats fields if logged in | **One-click apply** if profile complete; otherwise prefilled modal |
| Contact form | In footer; no honeypot; basic validation | Honeypot + Turnstile; server-side rate limit (Redis) |

---

### 1.19 Footer — **Score: 4/10**

| Issue | Solution |
|-------|----------|
| Two different footers (`layouts.footer` vs `template.blade.php`) | Unify; single source of truth |
| Copyright "© 2016" — stale | Dynamic `{{ now()->year }}` |
| Social links: btn-primary/btn-info (Bootstrap 3 classes) | Modern icon buttons with `aria-label` |
| No newsletter signup | Add `/newsletter` route + Mailchimp/Resend integration |
| Missing: Sitemap links, Legal, RGPD, Cookies | Full footer: Navigation + Legal + Social + Newsletter + Certifications |

---

### 1.20 Header — **Score: 3/10**

| Issue | Solution |
|-------|----------|
| Logo + nav only; no search, no user menu, no language switcher | Sticky header: Logo | Search (cmd+K) | Offres | Candidats | Entreprises | Blog | Connexion / Inscription |
| No "Postuler" / "Publier une offre" sticky CTA | Desktop: top-right primary buttons; Mobile: sticky bottom bar |
| Language: French only but no `lang="fr"` on `<html>` | `<html lang="fr" dir="ltr">` + hreflang ready for future `/en` |

---

### 1.21 Content Quality — **Score: 3/10**

| Problem | Evidence | Fix |
|---------|----------|-----|
| **Thin content** — Homepage has 200 words total | Google considers < 300 words "thin" | 1500+ words: value props, process, stats, testimonials, FAQ |
| **Duplicate content** — Same "Nos références" section on Home + About | Canonicalization issues | Unique content per page; componentize shared sections |
| **Keyword stuffing** in meta keywords (27 keywords!) | Ignored by Google; looks spammy | Remove meta keywords; focus on title + description + H1 + content |
| **No content strategy** — Blog posts are 2020 COVID articles | Zero topical authority | Editorial calendar: "Salaire Dev React Maroc 2025", "Comment recruter un CTO freelance", "Portage salarial vs Freelance" |
| **No E-E-A-T signals** — No author bios, no expertise proof | Poor rankings for competitive terms | Author pages: "Rédigé par Amine, Tech Recruiter 10 ans exp." + LinkedIn |

---

### 1.22 Visual Hierarchy — **Score: 4/10**

| Issue | Fix |
|-------|-----|
| No consistent heading scale (h2 38px, h3 16px — inverted!) | Type scale: `h1: clamp(2.5rem, 5vw, 4rem)`, `h2: clamp(2rem, 3vw, 3rem)`, `h3: 1.5rem`, `h4: 1.25rem` |
| All job cards same visual weight — no "Featured / Urgent" distinction | Badge system: `badge-featured` (gradient), `badge-urgent` (pulse), `badge-new` (dot) |
| Sidebar filters same prominence as job list | Visual hierarchy: Job list = primary; Filters = secondary (muted bg, collapsible) |
| Counters (2,632 / 19,865 / 144) same size as body text | Hero metrics: `text-4xl font-bold tabular-nums` with count-up animation |

---

### 1.23 Performance — **Score: 2/10** (Detailed in Part 6)

---

### 1.24 SEO — **Score: 3/10** (Detailed in Part 5)

---

### 1.25 Security Perception — **Score: 4/10**

| Indicator | Current | Target |
|-----------|---------|--------|
| HTTPS / HSTS | ❓ | ✅ Preload list |
| CSP Header | ❌ | ✅ `script-src 'self' 'nonce-...'` |
| X-Frame-Options | ❌ | ✅ `DENY` |
| Referrer-Policy | ❌ | ✅ `strict-origin-when-cross-origin` |
| Permissions-Policy | ❌ | ✅ `geolocation=(), microphone=()` |
| Cookie Secure / SameSite | ⚠️ Laravel default | ✅ `SESSION_SECURE_COOKIE=true`, `SESSION_SAME_SITE=lax` |
| reCAPTCHA v2 on contact | ⚠️ User friction | ✅ Turnstile (invisible) |
| Password requirements | Min 6 chars | ✅ Min 12 + zxcvbn + breach check (HaveIBeenPwned API) |
| Rate limiting | ❌ None visible | ✅ `throttle:5,1` on auth, `throttle:30,1` on contact |

---

### 1.26 Overall User Experience — **Score: 3/10**

**Summary:** The site feels abandoned. Candidates see 2020 job dates, fake stats, broken search. Employers have no self-service. Mobile is broken. Trust signals are fabricated. The technical debt makes iteration impossible.

**Top 3 Immediate Actions:**
1. **Migrate to single layout + Tailwind CSS v4 + Alpine.js** — Foundation for all UI work
2. **Replace hardcoded content with dynamic models** (Category, Testimonial, Article, Company)
3. **Launch Employer Portal** — Unlock 30% revenue audience

---

## PART 2 — UX REVIEW (Page-by-Page)

### 2.1 Homepage (`/`)

| Element | Issue | Impact | Improved Version |
|---------|-------|--------|------------------|
| **Hero** | Generic tagline; search form only; no trust badges | Bounce rate > 70% likely | Split hero: Left = Value prop + stats + "Trouver mission" CTA; Right = Live job feed (3 latest) + "Voir les 247 offres" |
| **Job List** | Hardcoded 6 jobs from 2020 | Zero credibility | Dynamic latest 6; each card: Logo, Title, Company, Location, Contract, Tags (React, Laravel), Salary range, "Postuler" primary |
| **Counters** | Fake (+1000) | Legal + trust risk | Real numbers + "Mis à jour il y a 2h" |
| **Categories** | Hardcoded list + fake counts | Useless for navigation | Dynamic chips with counts; click → filtered search |
| **Testimonials** | 2 fake Lorem Ipsum | No social proof | Video carousel (3) + Quote wall (6) with photos, roles, companies |
| **Blog** | 3 hardcoded 2020 articles | SEO dead | Latest 3 real articles + "Voir tous les conseils" |
| **References** | Static JPG | Can't click/verify | Logo carousel (auto-scroll) + hover pause; each links to case study |

---

### 2.2 Job Listing (`/offres`)

| Element | Issue | Impact | Improved Version |
|---------|-------|--------|------------------|
| **Sidebar Filters** | Hardcoded HTML (lines 21–203); `display:none` on all; Isotope JS | Filters don't work; mobile hidden; no URL sync | **Faceted search** via Meilisearch: Tech stack (multi-select), Contract (chips), Location (autocomplete), Seniority (radio), Salary (range slider), Remote (toggle). URL: `/offres?stack=react,node&contract=freelance&remote=true` |
| **Job Cards** | `homsys-joblisting-classic` — fixed height, truncated text, no logo | Can't scan; no company branding | **Card v2**: Company logo (40px) | Title + Company | Location + Contract badges | Tags (3 max) | Salary | "Postuler" (primary) / "Sauvegarder" (ghost) |
| **Pagination** | Laravel default `links()` — no `rel=next/prev` | SEO crawl waste | `<link rel="next" href="...">` + JSON-LD `ItemList` |
| **Empty State** | "Aucune offre" text only | Dead end | "Aucune offre pour 'React + Freelance à Casablanca'. Essayez : élargir la localisation, retirer le filtre salaire, ou créer une alerte email" + CTA "Créer une alerte" |
| **Sort** | None | Can't prioritize | Dropdown: "Plus récentes" (default), "Mieux payées", "Plus pertinentes", "Date de début" |

---

### 2.3 Job Detail (`/offres/{id}`)

| Element | Issue | Impact | Improved Version |
|---------|-------|--------|------------------|
| **Header** | Title only; no company logo, no badges | Low trust; can't identify employer | Hero card: Logo (60px) | Title | Company (link to profile) | Badges: Contract · Location · Remote · Seniority · Salary | "Postuler" (sticky on scroll) |
| **Content** | Raw `{!! $offre->poste !!}` — no structure | Screen readers see wall of text | **Prose component** with semantic HTML: `<h2>Mission</h2><ul>...</ul><h2>Profil</h2>...` |
| **Sidebar** | Apply button duplicated (2x); ShareThis; Back button | Cluttered; no "Sauvegarder" | Sticky sidebar: **Primary** "Postuler" | **Secondary** "Sauvegarder" (heart) | **Share** (Web Share API) | **Company** card (logo, size, sector, link) | **Similar jobs** (3) |
| **JSON-LD** | None | Zero rich snippets | Full `JobPosting` + `Organization` + `BreadcrumbList` |
| **Meta** | Title = job title only | Low CTR in SERP | `<title>{{ $offre->titre_offre }} — {{ $offre->type_offre }} à {{ $offre->ville_offre }} | HOMSYS</title>` + description with salary + stack |
| **Apply Flow** | Redirect to separate page with full form | 60% drop-off at redirect | **Modal** if logged in + profile complete; else **One-page** with progress: 1. Profil (prefilled) 2. CV + LM 3. Questions 4. Confirmation |

---

### 2.4 Candidate Registration (`/candidats/create`)

| Step | Current | Improved |
|------|---------|----------|
| 1. Account | Separate page; username + email + password ×2 | **Single page**: Email → magic link **or** password (zxcvbn) → auto-login |
| 2. Profile | Separate view; 15 fields; CV required | **Progressive profiling**: Step 1 (required): Prénom, Nom, Téléphone, Ville, Disponibilité. Step 2 (optional): Competences (multi-select), Expérience, Salaire, Portfolio, LinkedIn, Video CV. CV upload optional at end. |
| 3. Confirmation | Redirect to `/offres` | Dashboard: "Profil 60% complet — Ajoutez vos compétences pour +3x de vues" + "Offres recommandées" |

---

### 2.5 Candidate Dashboard (`/candidats/index`)

| Missing Feature | Value |
|-----------------|-------|
| **Mes candidatures** with status timeline | Retention + transparency |
| **Offres sauvegardées** | Re-engagement |
| **Alertes email** | Passive candidate capture |
| **Profil complet %** + gamification | Completion rate ↑ |
| **CV versions** (PDF + Live) | Flexibility |
| **Disponibilité calendar** | Faster matching |
| **Entretiens à venir** (Calendly/Google Cal sync) | Professional UX |

---

### 2.6 Employer Dashboard (MISSING — `/entreprises`)

| Module | Description |
|--------|-------------|
| **Tableau de bord** | Stats: Offres actives, Candidatures reçues, Temps moyen réponse, Taux conversion |
| **Mes offres** | CRUD + Boost (featured/urgent) + Clone + Archive + Analytics (vues, clics, candidatures) |
| **Pipeline candidats** | Kanban: Nouveau → Étudié → Entretien → Offre → Embauché / Refusé (drag-drop) |
| **Profil entreprise** | Logo, photos, vidéo, description, stack, avantages, équipe, avis Glassdoor-style |
| **Facturation** | Historique, factures PDF, abonnement Stripe |
| **Équipe** | Inviter collègues (roles: Admin, Recruteur, Lecteur) |

---

### 2.7 Search & Filters — **Critical Gaps**

| Feature | Status | Implementation |
|---------|--------|----------------|
| Full-text search (typo-tolerant) | ❌ LIKE % | Meilisearch (self-hosted) or Typesense Cloud |
| Faceted navigation | ❌ Hardcoded | Dynamic facets from index |
| URL synchronization | ❌ | `nuqs` (React) or Laravel `request()->query()` + `url()->current()` |
| Search analytics | ❌ | Log queries → Meilisearch analytics → popular searches widget |
| Autocomplete / Suggestions | ❌ | Meilisearch `search` on keystroke (debounced 150ms) |
| "Emplois similaires" | ❌ | Vector similarity (pgvector) or collaborative filtering |

---

### 2.8 Breadcrumbs — **Missing Entirely**

```blade
<!-- Component: partials/breadcrumb.blade.php -->
<nav aria-label="Fil d'Ariane" class="mb-4">
  <ol class="flex items-center gap-2 text-sm text-neutral-500" itemscope itemtype="https://schema.org/BreadcrumbList">
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <a href="{{ url('/') }}" itemprop="item"><span itemprop="name">Accueil</span></a>
      <meta itemprop="position" content="1">
    </li>
    @foreach ($breadcrumbs as $i => $crumb)
      <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="flex items-center gap-2">
        <svg class="w-4 h-4" aria-hidden="true"><use href="#chevron-right"/></svg>
        @if ($crumb['url'])
          <a href="{{ $crumb['url'] }}" itemprop="item"><span itemprop="name">{{ $crumb['label'] }}</span></a>
        @else
          <span itemprop="name" aria-current="page">{{ $crumb['label'] }}</span>
        @endif
        <meta itemprop="position" content="{{ $i + 2 }}">
      </li>
    @endforeach
  </ol>
</nav>
```

---

### 2.9 CTAs — **Audit Summary**

| Page | Current CTA | Conversion Barrier | Optimized CTA |
|------|-------------|-------------------|---------------|
| Home | "Voir toutes les offres" (ghost) | Weak verb | "🔍 Explorer les 247 missions IT" (primary) + "🏢 Je recrute" (secondary) |
| Job List | "Détail / Postuler" | Ambiguous | Split: "Postuler" (primary, filled) / "Détails" (secondary, outline) |
| Job Detail | 2× "POSTULER" + ShareThis | Clutter, no save | Sticky: "Postuler" (primary) | "♥ Sauvegarder" (ghost) | "⤴ Partager" (ghost) |
| Candidate Register | "Suivant" (step 1) | No value prop | "Créer mon compte gratuit →" + "Déjà inscrit ? Se connecter" |
| Spontaneous Apply | "Postuler" (after 7 fields) | High friction | "Déposer mon CV en 30s" + "Importer depuis LinkedIn" |
| Contact (Footer) | "ENVOYER" | Buried | Sticky "Parlons de votre projet" (bottom-right desktop, bottom bar mobile) |

---

### 2.10 Content Hierarchy — **Issues**

- **H1 missing** on many pages (Home uses H2 "Dernières offres publiées")
- **H2/H3 inverted** (Dosis 38px for H2, Lato 16px for H3)
- **No landmark regions** (`<main>`, `<aside>`, `<nav>`, `<header>`, `<footer>`)
- **Sidebar competes** with main content visually

**Fix:** Enforce heading outline: `h1` → `h2` → `h3`; use `<section aria-labelledby="...">`; CSS `order` for mobile sidebar.

---

### 2.11 Spacing — **Inconsistent**

| Context | Current | System |
|---------|---------|--------|
| Section vertical | `br><br><br>` (lines 82–83 in template) | `py-16 md:py-24` (64px / 96px) |
| Card padding | Inline styles + `.homsys-table-layer` | `p-6` (24px) |
| Grid gap | Custom `.homsys-row` / `.homsys-column-*` | `gap-6` / `gap-8` |
| Form field gap | `<br>` + margins | `space-y-4` |

**Adopt:** 4px base unit → `space-1` (4px) ... `space-8` (32px) ... `space-16` (64px)

---

### 2.12 Typography — **Detailed in Part 12**

---

### 2.13 Button Consistency — **Chaos**

| Variant | Classes Found | Standardized |
|---------|---------------|--------------|
| Primary | `homsys-bgcolor`, `btn btn-success`, `homsys-static-btn`, `homsys-option-btn` | `btn btn-primary` |
| Secondary | `homsys-option-btn homsys-blue`, `btn btn-warning`, `btn btn-info` | `btn btn-secondary` |
| Ghost | `homsys-classic-btn`, `homsys-read-more` | `btn btn-ghost` |
| Danger | `btn btn-danger` (rare) | `btn btn-danger` |
| Icon-only | `homsys-like-list`, `fa-heart` | `btn btn-icon` + `aria-label` |

**All buttons:** `min-h-[44px] min-w-[44px]` for touch; `transition-colors duration-150`; `:focus-visible` ring.

---

### 2.14 Card Design — **Fragmented**

| Card Type | Current Class | Unified Component |
|-----------|---------------|-------------------|
| Job (list) | `homsys-joblisting-classic-wrap` | `<x-job-card :job-card :job="$offre" variant="list" />` |
| Job (featured home) | `homsys-featured-listing-text` | `<x-job-card :job="$offre" variant="featured" />` |
| Company | `homsys-logo-thumb` (image only) | `<x-company-card :company="$company" />` |
| Blog | `homsys-blog-grid-text` | `<x-article-card :article="$article" />` |
| Candidate | None (table rows) | `<x-candidate-card :candidate="$candidat" />` |
| Stat/Counter | `homsys-counter` + `word-counter` | `<x-stat-card :value="$nb" label="Offres" icon="briefcase" />` |

---

### 2.15 Visual Balance — **Off**

- Homepage: 6 sections stacked, no breathing room, same background color
- Job list: Sidebar 25% / Content 75% but sidebar empty (hidden filters)
- Job detail: 8/4 split but sidebar has duplicate CTA

**Rule:** 60/30/10 color; whitespace as active element; max 3 visual weights per viewport.

---

### 2.16 Empty States — **Missing**

| Context | Current | Improved |
|---------|---------|----------|
| No jobs found | "Aucune offre" | Illustration + "Essayez ces filtres" + "Créer une alerte" |
| No applications | Blank table | "Vous n'avez pas encore postulé. <a href='/offres'>Découvrir les offres</a>" |
| No saved jobs | N/A | "Sauvegardez vos offres préférées pour les retrouver ici" |
| No CV uploaded | N/A | "Ajoutez votre CV pour postuler en 1 clic" + drag-drop zone |

---

### 2.17 Loading States — **None**

| Need | Solution |
|------|----------|
| Job list pagination | Skeleton cards (3–6) with `animate-pulse` |
| Job detail | Skeleton for hero + prose + sidebar |
| Search results | Spinner in search input + skeleton grid |
| CV upload | Progress bar + "Traitement du CV..." |
| Infinite scroll | "Chargement..." footer spinner |

---

### 2.18 Hover Effects — **Inconsistent**

| Element | Current | Standard |
|---------|---------|----------|
| Job card | None | `hover:shadow-lg hover:-translate-y-0.5 transition-shadow transition-transform` |
| Button | Some `homsys-bgcolor` change | `hover:bg-primary/90` + `active:scale-[0.98]` |
| Company logo | None | `hover:opacity-70` |
| Save heart | `fa-heart` → `fa-heart-o` (font toggle) | SVG stroke → fill + `text-red-500` |

---

### 2.19 Micro-interactions — **None Modern**

| Opportunity | Implementation |
|-------------|----------------|
| Heart save | `<button @click="saved = !saved" :class="{ 'text-red-500 fill-current': saved }" class="transition-transform duration-200 active:scale-90">` |
| Copy job link | Toast "Lien copié !" + checkmark animation |
| Filter chip add/remove | Animate in/out with `transition-all` |
| Sticky CTA appear | `IntersectionObserver` → `slide-in-from-bottom` |
| Form field focus | `ring-2 ring-primary ring-offset-2` |

---

### 2.20 Feedback Messages — **Basic**

| Type | Current | Improved |
|------|---------|----------|
| Success | Green alert (Bootstrap) | Toast (top-right) + `aria-live="polite"` + auto-dismiss 5s |
| Error | Red alert list | Inline field errors + toast summary |
| Validation | `@error` blade | Real-time (Alpine.js) + server fallback |
| Empty search | Text | Illustrated empty state + actionable suggestions |

---

### 2.21 Accessibility — **Detailed in Part 8**

---

### 2.22 Color Contrast — **Failures**

| Element | Current | WCAG AA | Fix |
|---------|---------|---------|-----|
| Body text `#888` on `#fff` | 4.1:1 | ❌ 4.5:1 | `#555` (7:1) |
| Placeholder text | `#999` | ❌ | `#767676` |
| Disabled button | `opacity: 0.65` | ❌ | `bg-neutral-300 text-neutral-500` |
| Focus outline | None (removed) | ❌ | `focus-visible:ring-2 ring-primary ring-offset-2` |
| Error text | `text-danger` (Bootstrap 3 `#a94442`) | ✅ 5.5:1 | Keep |

---

### 2.23 Form Usability — **Gaps**

| Field | Issue | Fix |
|-------|-------|-----|
| `telephone` (number input) | `type="number"` — strips leading 0, no +212 | `type="tel"` + `inputmode="tel"` + `libphonenumber-js` |
| `date_demarrage` | Text input | `<input type="date">` + flatpickr alternative |
| `competences` | Not in model | Multi-select (TomSelect / Choices.js) with 200+ IT skills taxonomy |
| `salaire` / `tjm` | Single number | Range: "300–500 €/jour" + currency selector (MAD/EUR) |
| File upload | Basic `<input type="file">` | Drag-drop zone + preview + validation (size, type, virus scan) |

---

### 2.24 Candidate Journey — **Friction Map**

```
Home → Search → Job Detail → Apply → Register → Profile → CV Upload → Submit
  ↓         ↓           ↓          ↓        ↓         ↓          ↓           ↓
 3s       5s          8s         12s      45s       60s        30s         5s
```

**Total: ~3 min** — Target: **< 60s** for logged-in candidates with complete profile.

**One-Click Apply Flow:**
1. Click "Postuler" → Check `candidat.profile_complete >= 80%`
2. If yes → Modal: "Confirmer votre candidature pour [Titre] chez [Entreprise] ?" → Submit → Toast "Candidature envoyée !"
3. If no → Redirect to `/mon-profil?complete=1` with progress steps

---

### 2.25 Employer Journey — **Non-Existent**

Build from scratch (see Part 9).

---

### 2.26 Trust Indicators — **Missing**

| Indicator | Implementation |
|-----------|----------------|
| **Client logos** | Carousel + `/nos-references` page with case studies |
| **Candidate testimonials** | Video (30s) + quote + photo + role + company |
| **Employer testimonials** | "HOMSYS nous a trouvé 3 Lead Dev en 2 semaines" — CTO, Marjane |
| **Stats with source** | "247 offres actives (maj il y a 2h)" — not "2,632+1000" |
| **Certifications** | Badges: Microsoft Partner, AWS, LinkedIn Talent Solutions |
| **Press/Media** | "Vu dans: L'Économiste, Le Matin, Medias24" |
| **Trustpilot/Google** | Embed widget (4.8★, 120 avis) |

---

### 2.27 Social Proof — **Zero Authentic**

Replace all Lorem Ipsum with real content. Seed database with 20 real testimonials (anonymized if needed).

---

### 2.28 Recruitment Funnel — **Leaky**

| Stage | Current Drop-off | Target |
|-------|------------------|--------|
| Visit → Search | 40% (est.) | 60% |
| Search → Job View | 30% | 45% |
| Job View → Apply Click | 15% | 25% |
| Apply Click → Submit | 40% (multi-step) | 70% (one-click) |
| Submit → Qualified | 20% | 35% (better matching) |

---

### 2.29 Registration Experience — **Two-Page, High Friction**

Merge into single page with progressive disclosure. Offer "Continuer avec LinkedIn" (OAuth).

---

### 2.30 Login Experience — **Basic**

- No "Se souvenir de moi" (remember token)
- No passwordless (magic link)
- No 2FA option
- Redirect logic hardcoded in `/logins` closure

---

### 2.31 Job Application Process — **Broken**

- Separate page (`/offres/postule/{id}`)
- Requires re-entering name/email/phone if not logged in
- CV upload mandatory (1MB limit — too low for PDF portfolios)
- No cover letter field (only "message")
- No confirmation email with reference number

---

### 2.32 Profile Creation — **Incomplete**

Missing: Skills (taxonomy), Languages, Certifications, Portfolio URLs, GitHub, LinkedIn, Video intro, Availability calendar, Salary expectations, Contract preferences, Remote preference, Notice period.

---

### 2.33 Overall Usability — **Score: 3/10**

**Heuristic Evaluation (Nielsen):**

| Heuristic | Score | Notes |
|-----------|-------|-------|
| Visibility of system status | 2/10 | No loading, no progress, no "saved" confirmation |
| Match system/real world | 4/10 | "Offre" vs "Mission" vs "Job" mixed; French OK but technical terms inconsistent |
| User control & freedom | 3/10 | No "Annuler" on apply; back button breaks multi-step |
| Consistency & standards | 2/10 | 4 layouts, 3 button styles, 2 footers |
| Error prevention | 3/10 | No inline validation; CV required before account |
| Recognition over recall | 2/10 | No saved searches, no recently viewed, no autocomplete |
| Flexibility & efficiency | 2/10 | No shortcuts, no power user features |
| Aesthetic & minimalist | 3/10 | Cluttered, dated, fake content |
| Error recovery | 3/10 | Generic "Erreur" messages; no field-level help |
| Help & documentation | 1/10 | No FAQ, no help center, no tooltips |

---

## PART 3 — UI REDESIGN: Visual Identity System

### 3.1 Color Palette (Modern, Tech, Trust, Moroccan Context)

```css
:root {
  /* === BRAND === */
  --color-brand-50:  #eff6ff;
  --color-brand-100: #dbeafe;
  --color-brand-200: #bfdbfe;
  --color-brand-300: #93c5fd;
  --color-brand-400: #60a5fa;
  --color-brand-500: #3b82f6;  /* Primary — Trust Blue */
  --color-brand-600: #2563eb;  /* Primary hover */
  --color-brand-700: #1d4ed8;
  --color-brand-800: #1e40af;
  --color-brand-900: #1e3a8a;
  --color-brand-950: #172554;

  /* === ACCENT — Moroccan Red (sparingly) === */
  --color-accent-500: #dc2626;  /* CTA highlight, urgent badges */
  --color-accent-600: #b91c1c;

  /* === SUCCESS / WARNING / DANGER === */
  --color-success-500: #16a34a;  /* Green — "Postulé", "Actif" */
  --color-success-600: #15803d;
  --color-warning-500: #f59e0b;  /* Amber — "En attente", "Urgent" */
  --color-warning-600: #d97706;
  --color-danger-500:  #ef4444;  /* Red — "Clôturé", "Rejeté" */
  --color-danger-600:  #dc2626;

  /* === NEUTRALS (Slate) === */
  --color-neutral-0:   #ffffff;
  --color-neutral-25:  #fafafa;
  --color-neutral-50:  #f8fafc;
  --color-neutral-100: #f1f5f9;
  --color-neutral-200: #e2e8f0;
  --color-neutral-300: #cbd5e1;
  --color-neutral-400: #94a3b8;
  --color-neutral-500: #64748b;
  --color-neutral-600: #475569;
  --color-neutral-700: #334155;
  --color-neutral-800: #1e293b;
  --color-neutral-900: #0f172a;
  --color-neutral-950: #020617;

  /* === SEMANTIC ALIASES === */
  --color-bg-primary:     var(--color-neutral-0);
  --color-bg-secondary:   var(--color-neutral-50);
  --color-bg-tertiary:    var(--color-neutral-100);
  --color-bg-card:        var(--color-neutral-0);
  --color-bg-hover:       var(--color-neutral-50);
  --color-bg-active:      var(--color-neutral-100);

  --color-text-primary:   var(--color-neutral-900);
  --color-text-secondary: var(--color-neutral-600);
  --color-text-tertiary:  var(--color-neutral-400);
  --color-text-inverse:   var(--color-neutral-0);
  --color-text-link:      var(--color-brand-600);
  --color-text-link-hover: var(--color-brand-700);

  --color-border-light:   var(--color-neutral-200);
  --color-border-medium:  var(--color-neutral-300);
  --color-border-focus:   var(--color-brand-500);
  --color-border-error:   var(--color-danger-500);

  /* === ELEVATION === */
  --shadow-xs: 0 1px 2px 0 rgb(0 0 0 / 0.05);
  --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
  --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
  --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
  --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
  --shadow-2xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);

  /* === GLASSMORPHISM (Header, Modals) === */
  --glass-bg: rgba(255, 255, 255, 0.85);
  --glass-border: rgba(148, 163, 184, 0.2);
  --glass-blur: saturate(180%) blur(16px);

  /* === DARK MODE (Optional — Phase 2) === */
  @media (prefers-color-scheme: dark) {
    :root:not(.light) {
      --color-bg-primary:     var(--color-neutral-950);
      --color-bg-secondary:   var(--color-neutral-900);
      --color-bg-tertiary:    var(--color-neutral-800);
      --color-bg-card:        var(--color-neutral-900);
      --color-bg-hover:       var(--color-neutral-800);
      --color-text-primary:   var(--color-neutral-50);
      --color-text-secondary: var(--color-neutral-400);
      --color-text-tertiary:  var(--color-neutral-500);
      --color-border-light:   var(--color-neutral-800);
      --color-border-medium:  var(--color-neutral-700);
      --glass-bg: rgba(15, 23, 42, 0.85);
      --glass-border: rgba(148, 163, 184, 0.15);
    }
  }
}
```

**Rationale:**
- **Blue 500/600** = Trust, technology, corporate (LinkedIn, Indeed, Microsoft)
- **Red 500** = Moroccan flag accent, urgency, "Postuler" primary action
- **Slate neutrals** = Modern, readable, works in dark mode
- **No purple/pink** — avoids "creative agency" feel; this is B2B recruitment
- **Semantic aliases** = Easy theming, dark mode ready

---

### 3.2 Typography

| Role | Font | Weights | Usage |
|------|------|---------|-------|
| **Display / Headlines** | **Plus Jakarta Sans** (Variable) | 400–800 | Hero, H1, H2, Stats, Buttons |
| **UI / Body / Data** | **Inter Variable** | 400–700 | Body, Forms, Tables, Navigation, Cards |
| **Code / Technical** | **JetBrains Mono Variable** | 400–700 | Skill tags, salary, code snippets |

```css
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400..700&family=Plus+Jakarta+Sans:wght@400..800&family=JetBrains+Mono:wght@400..700&display=swap');

:root {
  --font-display: 'Plus Jakarta Sans', system-ui, sans-serif;
  --font-ui: 'Inter', system-ui, sans-serif;
  --font-mono: 'JetBrains Mono', monospace;
}

/* Fluid Type Scale */
.text-display-2xl { font: 800 clamp(2.5rem, 5vw, 4rem)/1.1 var(--font-display); letter-spacing: -0.02em; }
.text-display-xl  { font: 700 clamp(2rem, 4vw, 3rem)/1.2 var(--font-display); letter-spacing: -0.01em; }
.text-display-lg  { font: 700 clamp(1.75rem, 3vw, 2.5rem)/1.25 var(--font-display); }
.text-h1          { font: 700 clamp(1.5rem, 2.5vw, 2.25rem)/1.3 var(--font-display); }
.text-h2          { font: 600 clamp(1.25rem, 2vw, 1.75rem)/1.35 var(--font-display); }
.text-h3          { font: 600 1.25rem/1.4 var(--font-display); }
.text-h4          { font: 600 1.125rem/1.4 var(--font-ui); }
.text-body-lg     { font: 400 1.125rem/1.7 var(--font-ui); }
.text-body        { font: 400 1rem/1.6 var(--font-ui); }
.text-body-sm     { font: 400 0.875rem/1.5 var(--font-ui); }
.text-caption     { font: 500 0.75rem/1.5 var(--font-ui); letter-spacing: 0.02em; text-transform: uppercase; }
.text-code        { font: 400 0.875rem/1.6 var(--font-mono); }
```

**Preload:**
```html
<link rel="preload" as="font" type="font/woff2" crossorigin href="https://fonts.gstatic.com/s/plusjakartasans/v10/...woff2">
<link rel="preload" as="font" type="font/woff2" crossorigin href="https://fonts.gstatic.com/s/inter/v18/...woff2">
```

---

### 3.3 Spacing System (4px Base)

```css
:root {
  --space-0: 0;
  --space-1: 0.25rem;   /* 4px */
  --space-2: 0.5rem;    /* 8px */
  --space-3: 0.75rem;   /* 12px */
  --space-4: 1rem;      /* 16px */
  --space-5: 1.25rem;   /* 20px */
  --space-6: 1.5rem;    /* 24px */
  --space-8: 2rem;      /* 32px */
  --space-10: 2.5rem;   /* 40px */
  --space-12: 3rem;     /* 48px */
  --space-16: 4rem;     /* 64px */
  --space-20: 5rem;     /* 80px */
  --space-24: 6rem;     /* 96px */
}
```

**Section Padding:** `py-12 md:py-16 lg:py-20` (48/64/80px)
**Container:** `max-w-7xl` (1280px) + `px-4 md:px-6 lg:px-8`

---

### 3.4 Grid System

```css
/* 12-column, 24px gutters, fluid container */
.container { 
  width: 100%; 
  max-width: 80rem; /* 1280px */
  margin-inline: auto; 
  padding-inline: 1rem; /* 16px mobile */
}
@media (min-width: 768px) { .container { padding-inline: 1.5rem; } } /* 24px */
@media (min-width: 1024px) { .container { padding-inline: 2rem; } } /* 32px */

.grid { display: grid; gap: 1.5rem; }
.grid-cols-1 { grid-template-columns: repeat(1, 1fr); }
.grid-cols-2 { grid-template-columns: repeat(2, 1fr); }
.grid-cols-3 { grid-template-columns: repeat(3, 1fr); }
.grid-cols-4 { grid-template-columns: repeat(4, 1fr); }

/* Responsive */
@media (min-width: 640px) { .sm\:grid-cols-2 { grid-template-columns: repeat(2, 1fr); } }
@media (min-width: 768px) { .md\:grid-cols-3 { grid-template-columns: repeat(3, 1fr); } }
@media (min-width: 1024px) { .lg\:grid-cols-4 { grid-template-columns: repeat(4, 1fr); } }
```

---

### 3.5 Icon Library — **Lucide (SVG, 24×24, stroke 2)**

```bash
# Install via npm or use CDN
# Key icons for recruitment:
# Briefcase, Building2, User, Users, Mail, Phone, MapPin, Calendar, Clock, 
# Heart, Star, Search, Filter, ChevronDown, ChevronRight, ExternalLink,
# Share2, Download, Upload, FileText, Link, Globe, Shield, CheckCircle,
# AlertCircle, Info, Loader2, Sparkles, Zap, TrendingUp, Award, Flag
```

**Component:** `<x-icon name="briefcase" class="w-5 h-5" />`

---

### 3.6 Illustration Style — **Custom "Tech Human" (Flat, 2-tone brand blue + neutral)**

- Use **undraw.co** or **Open Doodles** as base → recolor to brand palette
- Scenes: "Job search", "Video interview", "Team collaboration", "Remote work", "Career growth"
- **No generic stock photos** — custom illustrations build brand recognition

---

### 3.7 Photography Style — **Authentic, Diverse, Moroccan Context**

- Real developers in Casablanca/Rabat coworking spaces
- No "handshake" stock photos
- Show: Code on screen, whiteboard architecture, laptop + mint tea, team standup
- **Alt text mandatory:** "Amine, Lead Dev React, en pair programming chez HOMSYS client"

---

### 3.8 Animations & Transitions

```css
:root {
  --duration-fast: 100ms;
  --duration-base: 200ms;
  --duration-slow: 300ms;
  --ease-out: cubic-bezier(0.16, 1, 0.3, 1);
  --ease-in-out: cubic-bezier(0.4, 0, 0.2, 1);
  --ease-spring: cubic-bezier(0.34, 1.56, 0.64, 1);
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
}

/* Key transitions */
.transition-base { transition: all var(--duration-base) var(--ease-out); }
.transition-colors { transition: color var(--duration-fast), background-color var(--duration-fast), border-color var(--duration-fast); }
.transform-hover { transition: transform var(--duration-fast) var(--ease-out), box-shadow var(--duration-base) var(--ease-out); }
.transform-hover:hover { transform: translateY(-2px); box-shadow: var(--shadow-lg); }
```

---

### 3.9 Glassmorphism — **Header + Modals Only**

```css
.glass {
  background: var(--glass-bg);
  backdrop-filter: var(--glass-blur);
  -webkit-backdrop-filter: var(--glass-blur);
  border: 1px solid var(--glass-border);
}
```

**Usage:** Sticky header, dropdown menus, modal overlays, tooltip.

---

### 3.10 Dark Mode — **Phase 2 (Optional)**

- Implement via `class="dark"` on `<html>` + `localStorage` persistence
- Tailwind `dark:` variant or CSS `[data-theme="dark"]`
- Respect `prefers-color-scheme` default
- **Not in MVP** — adds complexity; focus on light mode perfection first

---

### 3.11 Modern Bootstrap 5 Components (If Staying with Bootstrap)

> **Recommendation: Migrate to Tailwind CSS v4 + Alpine.js** — smaller bundle, no jQuery, better DX, design tokens native.

If Bootstrap 5 required:

| Component | Customization |
|-----------|---------------|
| **Buttons** | `$btn-border-radius: 0.5rem; $btn-padding-y: 0.625rem; $btn-padding-x: 1.25rem; $btn-font-weight: 600; $btn-transition: all 0.15s ease;` |
| **Cards** | `$card-border-radius: 0.75rem; $card-border-width: 1px; $card-border-color: var(--color-border-light); $card-box-shadow: var(--shadow-sm); $card-cap-bg: transparent;` |
| **Badges** | `$badge-border-radius: 9999px; $badge-padding-x: 0.625rem; $badge-font-weight: 500; $badge-font-size: 0.75rem;` |
| **Forms** | `$input-border-radius: 0.5rem; $input-padding-y: 0.625rem; $input-padding-x: 0.875rem; $input-focus-border-color: var(--color-brand-500); $input-focus-box-shadow: 0 0 0 3px var(--color-brand-100);` |
| **Dropdowns** | `$dropdown-border-radius: 0.5rem; $dropdown-box-shadow: var(--shadow-lg); $dropdown-link-hover-bg: var(--color-neutral-100);` |
| **Pagination** | `$pagination-border-radius: 0.5rem; $pagination-hover-bg: var(--color-neutral-100); $pagination-active-bg: var(--color-brand-600);` |

---

### 3.12 Job Card Component (Reference Design)

```blade
{{-- components/job-card.blade.php --}}
<article class="job-card group relative bg-white border border-neutral-200 rounded-xl p-6 
           hover:border-brand-300 hover:shadow-lg transition-all duration-200
           flex flex-col h-full">
  {{-- Badge row --}}
  <div class="flex flex-wrap gap-2 mb-3">
    @if ($job->is_featured)
      <span class="badge badge-featured">✨ À la une</span>
    @endif
    @if ($job->is_urgent)
      <span class="badge badge-urgent animate-pulse">Urgent</span>
    @endif
    @if ($job->is_new)
      <span class="badge badge-new">Nouveau</span>
    @endif
    <span class="badge badge-contract badge-{{ $job->contract_slug }}">{{ $job->type_offre }}</span>
  </div>

  {{-- Header --}}
  <div class="flex items-start gap-3 mb-3">
    <img src="{{ $job->company->logo_url ?? asset('img/company-placeholder.svg') }}" 
         alt="" class="w-12 h-12 rounded-lg object-cover flex-shrink-0 bg-neutral-100" 
         loading="lazy" width="48" height="48">
    <div class="flex-1 min-w-0">
      <h3 class="text-h4 truncate">
        <a href="{{ $job->url }}" class="text-neutral-900 hover:text-brand-600 transition-colors">
          {{ $job->titre_offre }}
        </a>
      </h3>
      <p class="text-body-sm text-neutral-500 flex items-center gap-2">
        <span class="font-medium text-neutral-700">{{ $job->company->name }}</span>
        <span aria-hidden="true">·</span>
        <span><x-icon name="map-pin" class="w-3.5 h-3.5" /> {{ $job->ville_offre }}</span>
        @if ($job->remote)
          <span class="badge badge-remote"><x-icon name="wifi" class="w-3 h-3" /> Télétravail</span>
        @endif
      </p>
    </div>
  </div>

  {{-- Meta tags --}}
  <div class="flex flex-wrap gap-2 text-body-sm text-neutral-500 mb-4">
    <span class="flex items-center gap-1"><x-icon name="calendar" class="w-3.5 h-3.5" /> {{ $job->duree }}</span>
    @if ($job->salary_min || $job->salary_max)
      <span class="flex items-center gap-1 text-brand-600 font-medium">
        <x-icon name="credit-card" class="w-3.5 h-3.5" />
        {{ $job->salary_range }}
      </span>
    @endif
    <span class="flex items-center gap-1"><x-icon name="clock" class="w-3.5 h-3.5" /> {{ $job->posted_human }}</span>
  </div>

  {{-- Tech tags --}}
  @if ($job->skills->count())
    <div class="flex flex-wrap gap-1.5 mb-4" aria-label="Compétences requises">
      @foreach ($job->skills->take(4) as $skill)
        <span class="skill-tag px-2 py-0.5 rounded-full text-xs font-medium bg-brand-50 text-brand-700 border border-brand-100">
          {{ $skill->name }}
        </span>
      @endforeach
      @if ($job->skills->count() > 4)
        <span class="skill-tag px-2 py-0.5 rounded-full text-xs font-medium bg-neutral-100 text-neutral-600">
          +{{ $job->skills->count() - 4 }}
        </span>
      @endif
    </div>
  @endif

  {{-- Actions --}}
  <div class="flex items-center gap-2 pt-4 border-t border-neutral-100 mt-auto">
    <button class="btn btn-primary flex-1 justify-center" 
            wire:click="apply({{ $job->id }})"
            @unless (auth()->check() && auth()->user()->candidat->profile_complete >= 80)
              data-bs-toggle="modal" data-bs-target="#complete-profile-modal"
            @endunless>
      <x-icon name="send" class="w-4 h-4 mr-1" /> Postuler
    </button>
    <button class="btn btn-ghost p-2" 
            wire:click="toggleSave({{ $job->id }})"
            aria-label="{{ $job->saved ? 'Retirer des favoris' : 'Sauvegarder' }}">
      <x-icon name="heart" class="w-5 h-5 {{ $job->saved ? 'fill-current text-red-500' : 'text-neutral-400' }}" />
    </button>
  </div>
</article>
```

---

### 3.13 Company Card

```blade
<article class="company-card group p-6 bg-white border border-neutral-200 rounded-xl 
           hover:border-brand-300 hover:shadow-lg transition-all">
  <div class="flex items-center gap-4 mb-4">
    <img src="{{ $company->logo_url }}" alt="" class="w-16 h-16 rounded-lg object-cover bg-neutral-100">
    <div>
      <h3 class="text-h4">{{ $company->name }}</h3>
      <p class="text-body-sm text-neutral-500">{{ $company->sector }} · {{ $company->size_label }} · {{ $company->city }}</p>
    </div>
  </div>
  <div class="flex flex-wrap gap-1.5 mb-4">
    @foreach ($company->top_skills->take(5) as $skill)
      <span class="skill-tag">{{ $skill }}</span>
    @endforeach
  </div>
  <a href="{{ $company->url }}" class="btn btn-ghost w-full justify-center">
    Voir {{ $company->active_jobs_count }} offres <x-icon name="chevron-right" class="w-4 h-4 ml-1" />
  </a>
</article>
```

---

### 3.14 Candidate Card (Admin / Employer View)

```blade
<article class="candidate-card p-4 bg-white border border-neutral-200 rounded-xl hover:shadow-md transition">
  <div class="flex items-start gap-4">
    <div class="w-14 h-14 rounded-xl bg-brand-100 flex items-center justify-center flex-shrink-0">
      @if ($candidate->avatar)
        <img src="{{ $candidate->avatar }}" alt="" class="w-full h-full rounded-xl object-cover">
      @else
        <x-icon name="user" class="w-7 h-7 text-brand-600" />
      @endif
    </div>
    <div class="flex-1 min-w-0">
      <div class="flex items-center gap-2 mb-1">
        <h4 class="text-h4 truncate">{{ $candidate->full_name }}</h4>
        @if ($candidate->is_available)
          <span class="badge badge-success">Disponible {{ $candidate->notice_period }}</span>
        @endif
      </div>
      <p class="text-body-sm text-neutral-500 flex flex-wrap gap-3">
        <span><x-icon name="map-pin" class="w-3.5 h-3.5 inline-block align-middle" /> {{ $candidate->city }}</span>
        <span><x-icon name="briefcase" class="w-3.5 h-3.5 inline-block align-middle" /> {{ $candidate->experience_years }} ans exp.</span>
        <span><x-icon name="credit-card" class="w-3.5 h-3.5 inline-block align-middle" /> {{ $candidate->salary_range }}</span>
      </p>
      <div class="flex flex-wrap gap-1.5 mt-2">
        @foreach ($candidate->skills->take(5) as $skill)
          <span class="skill-tag">{{ $skill }}</span>
        @endforeach
      </div>
    </div>
    <div class="flex flex-col gap-2">
      <button class="btn btn-primary text-sm" wire:click="inviteToJob({{ $candidate->id }})">
        Inviter
      </button>
      <button class="btn btn-ghost text-sm" wire:click="viewProfile({{ $candidate->id }})">
        Profil
      </button>
    </div>
  </div>
</article>
```

---

### 3.15 Dashboard Design Principles

| Principle | Implementation |
|-----------|----------------|
| **Density toggle** | User setting: Comfortable / Compact / Cozy (affects row height, padding) |
| **Sticky header** | Top bar: Logo | Global Search (Cmd+K) | Notifications | User Menu — `position: sticky; top: 0; z-index: 50` |
| **Sidebar** | Collapsible (icon-only) + responsive drawer on mobile; `w-64` / `w-16` |
| **Data tables** | TanStack Table (React/Vue) or Livewire Tables — sortable, filterable, column visibility, export CSV |
| **Kanban** | Drag-drop (SortableJS / dnd-kit) for candidate pipeline |
| **Empty states** | Illustration + actionable CTA + help link |
| **Real-time** | Laravel Echo + Pusher/Soketi for notifications, new applications |

---

### 3.16 Sticky Navigation (Desktop)

```blade
<header class="sticky top-0 z-50 glass border-b border-neutral-200">
  <div class="container flex items-center justify-between h-16">
    <a href="/" class="flex items-center gap-2" aria-label="HOMSYS - Accueil">
      <img src="{{ asset('img/logo.svg') }}" alt="" class="h-8 w-auto">
    </a>
    
    <nav class="hidden md:flex items-center gap-6" role="navigation" aria-label="Principal">
      <a href="/offres" class="nav-link">Offres d'emploi</a>
      <a href="/candidats" class="nav-link">Candidats</a>
      <a href="/entreprises" class="nav-link">Entreprises</a>
      <a href="/conseils" class="nav-link">Conseils carrière</a>
      <a href="/portage" class="nav-link">Portage salarial</a>
    </nav>

    <div class="flex items-center gap-3">
      <button class="btn btn-ghost btn-icon p-2" aria-label="Recherche globale" data-search-trigger>
        <x-icon name="search" class="w-5 h-5" />
      </button>
      @guest
        <a href="/connexion" class="btn btn-ghost text-sm hidden sm:inline-flex">Se connecter</a>
        <a href="/inscription" class="btn btn-primary text-sm">S'inscrire</a>
      @else
        <div class="relative" x-data="{ open: false }">
          <button class="btn btn-ghost gap-2" @click="open = !open" aria-expanded="false" aria-haspopup="true">
            <img src="{{ auth()->user()->avatar ?? asset('img/avatar-placeholder.svg') }}" 
                 alt="" class="w-8 h-8 rounded-full bg-neutral-100">
            <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
            <x-icon name="chevron-down" class="w-4 h-4" />
          </button>
          <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white border border-neutral-200 rounded-xl shadow-lg py-2"
               x-show="open" x-transition:enter="transition ease-out duration-100"
               x-transition:leave="transition ease-in duration-75" @click.outside="open = false">
            <a href="/mon-tableau-de-bord" class="dropdown-item flex items-center gap-2 px-4 py-2">
              <x-icon name="layout-dashboard" class="w-4 h-4" /> Tableau de bord
            </a>
            <a href="/mes-candidatures" class="dropdown-item flex items-center gap-2 px-4 py-2">
              <x-icon name="file-text" class="w-4 h-4" /> Mes candidatures
            </a>
            <a href="/mes-alertes" class="dropdown-item flex items-center gap-2 px-4 py-2">
              <x-icon name="bell" class="w-4 h-4" /> Alertes emploi
            </a>
            <a href="/mon-profil" class="dropdown-item flex items-center gap-2 px-4 py-2">
              <x-icon name="user" class="w-4 h-4" /> Mon profil
            </a>
            <hr class="my-2 border-neutral-200">
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="dropdown-item flex items-center gap-2 px-4 py-2 text-danger w-full text-left">
                <x-icon name="log-out" class="w-4 h-4" /> Déconnexion
              </button>
            </form>
          </div>
        </div>
      @endguest
    </div>
  </div>
</header>
```

---

### 3.17 Floating CTA (Mobile)

```blade
@if (request()->is('offres/*') || request()->is('offres'))
  <div class="fixed bottom-0 left-0 right-0 md:hidden z-40 bg-white border-t border-neutral-200 shadow-xl p-3 
              safe-area-bottom animate-slide-up" x-show="showFloatingCta" x-transition>
    <div class="container flex gap-3">
      <button class="btn btn-ghost flex-1" @click="toggleSave(jobId)">
        <x-icon :name="saved ? 'heart' : 'heart'" class="w-5 h-5 {{ saved ? 'fill-current text-red-500' : '' }}" />
        <span>{{ saved ? 'Sauvegardé' : 'Sauvegarder' }}</span>
      </button>
      <button class="btn btn-primary flex-1" wire:click="apply(jobId)">
        <x-icon name="send" class="w-5 h-5 mr-1" /> Postuler
      </button>
    </div>
  </div>
@endif
```

---

### 3.18 Responsive Navigation — **Alpine.js Pattern**

See header above — no jQuery, accessible, focus-trapped, ESC-close, click-outside-close.

---

### 3.19 Modern Footer

```blade
<footer class="bg-neutral-950 text-neutral-300" role="contentinfo">
  <div class="container py-16 md:py-24 lg:grid lg:grid-cols-2 lg:gap-12">
    <div class="lg:col-span-2">
      <a href="/" class="inline-block mb-6" aria-label="HOMSYS - Accueil">
        <img src="{{ asset('img/logo-white.svg') }}" alt="" class="h-10 w-auto">
      </a>
      <p class="text-body-lg max-w-xl text-neutral-400 mb-8">
        Le partenaire de référence pour le recrutement IT au Maroc. 
        Freelance, CDI, Portage — nous connectons les meilleurs talents aux meilleurs projets.
      </p>
      <div class="flex gap-4">
        <a href="https://linkedin.com/company/homsys-maroc" class="social-link" aria-label="LinkedIn" target="_blank" rel="noopener">
          <x-icon name="linkedin" class="w-5 h-5" />
        </a>
        <a href="https://facebook.com/HomsysMaroc" class="social-link" aria-label="Facebook" target="_blank" rel="noopener">
          <x-icon name="facebook" class="w-5 h-5" />
        </a>
        <a href="https://twitter.com/HomsysMaroc" class="social-link" aria-label="Twitter" target="_blank" rel="noopener">
          <x-icon name="twitter" class="w-5 h-5" />
        </a>
        <a href="https://github.com/homsys" class="social-link" aria-label="GitHub" target="_blank" rel="noopener">
          <x-icon name="github" class="w-5 h-5" />
        </a>
      </div>
    </div>

    <nav class="footer-grid lg:col-span-2" aria-label="Navigation footer">
      <div>
        <h3 class="text-neutral-100 font-semibold mb-4">Candidats</h3>
        <ul class="space-y-2">
          <li><a href="/offres" class="footer-link">Offres d'emploi</a></li>
          <li><a href="/deposer-cv" class="footer-link">Déposer mon CV</a></li>
          <li><a href="/portage" class="footer-link">Portage salarial</a></li>
          <li><a href="/conseils/cv" class="footer-link">Conseils CV & Entretien</a></li>
          <li><a href="/salaires" class="footer-link">Baromètre salaires IT</a></li>
        </ul>
      </div>
      <div>
        <h3 class="text-neutral-100 font-semibold mb-4">Entreprises</h3>
        <ul class="space-y-2">
          <li><a href="/entreprises/publier" class="footer-link">Publier une offre</a></li>
          <li><a href="/entreprises/tarifs" class="footer-link">Nos tarifs</a></li>
          <li><a href="/entreprises/chasse" class="footer-link">Chasse de têtes</a></li>
          <li><a href="/etudes-de-cas" class="footer-link">Études de cas</a></li>
        </ul>
      </div>
      <div>
        <h3 class="text-neutral-100 font-semibold mb-4">HOMSYS</h3>
        <ul class="space-y-2">
          <li><a href="/a-propos" class="footer-link">Qui sommes-nous</a></li>
          <li><a href="/notre-equipe" class="footer-link">Notre équipe</a></li>
          <li><a href="/references" class="footer-link">Nos références</a></li>
          <li><a href="/blog" class="footer-link">Blog & Actualités</a></li>
          <li><a href="/contact" class="footer-link">Contact</a></li>
        </ul>
      </div>
      <div>
        <h3 class="text-neutral-100 font-semibold mb-4">Légal</h3>
        <ul class="space-y-2">
          <li><a href="/mentions-legales" class="footer-link">Mentions légales</a></li>
          <li><a href="/cgu" class="footer-link">CGU</a></li>
          <li><a href="/rgpd" class="footer-link">RGPD & Données</a></li>
          <li><a href="/cookies" class="footer-link">Cookies</a></li>
          <li><a href="/accessibilite" class="footer-link">Accessibilité</a></li>
        </ul>
      </div>
    </nav>
  </div>

  <div class="border-t border-neutral-800">
    <div class="container py-6 flex flex-col md:flex-row justify-between items-center gap-4">
      <p class="text-body-sm text-neutral-500">
        © {{ now()->year }} HOMSYS. Tous droits réservés.
      </p>
      <p class="text-body-sm text-neutral-500">
        Basé à Casablanca, Maroc — Opère dans toute la francophonie
      </p>
    </div>
  </div>
</footer>

<style>
  .footer-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; }
  @media (min-width: 768px) { .footer-grid { grid-template-columns: repeat(4, 1fr); } }
  .footer-link { color: inherit; transition: color 0.15s; }
  .footer-link:hover { color: var(--color-brand-400); }
  .social-link { display: flex; width: 40px; height: 40px; align-items: center; justify-content: center; 
                 border-radius: 50%; background: var(--color-neutral-800); color: var(--color-neutral-400); transition: all 0.15s; }
  .social-link:hover { background: var(--color-brand-600); color: white; transform: translateY(-2px); }
</style>
```

---

### 3.20 Professional Hero Section (Homepage)

```blade
<section class="hero relative overflow-hidden bg-neutral-50 pt-16 pb-12 md:pt-24 md:pb-20 lg:pb-28">
  <div class="container">
    <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
      <div>
        <span class="badge badge-brand mb-4 inline-flex">🇲🇦 #1 Recrutement IT au Maroc</span>
        <h1 class="text-display-xl text-neutral-950 mb-6">
          Trouvez votre mission IT idéale <br class="hidden md:block">
          <span class="text-brand-600">en 3 clics</span>
        </h1>
        <p class="text-body-lg text-neutral-600 mb-8 max-w-xl">
          247 missions actives · Freelance, CDI, Portage · Télétravail possible · Réponse sous 48h
        </p>
        <div class="flex flex-wrap gap-3 mb-10">
          <a href="/offres" class="btn btn-primary text-lg px-8 py-3">
            <x-icon name="search" class="w-5 h-5 mr-2" /> Explorer les offres
          </a>
          <a href="/entreprises/publier" class="btn btn-secondary text-lg px-8 py-3">
            <x-icon name="briefcase" class="w-5 h-5 mr-2" /> Je recrute
          </a>
        </div>
        <div class="flex flex-wrap items-center gap-6 text-body-sm text-neutral-500">
          <div class="flex items-center gap-1.5">
            <x-icon name="shield-check" class="w-5 h-5 text-brand-500" />
            <span>Confidentialité garantie</span>
          </div>
          <div class="flex items-center gap-1.5">
            <x-icon name="zap" class="w-5 h-5 text-brand-500" />
            <span>Réponse < 48h</span>
          </div>
          <div class="flex items-center gap-1.5">
            <x-icon name="users" class="w-5 h-5 text-brand-500" />
            <span>150+ clients satisfaits</span>
          </div>
        </div>
      </div>

      <div class="relative">
        {{-- Live Job Feed --}}
        <div class="bg-white rounded-2xl border border-neutral-200 shadow-xl p-4 max-w-md mx-auto">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-h4">Dernières missions</h3>
            <a href="/offres" class="text-body-sm text-brand-600 hover:underline">Voir tout</a>
          </div>
          <div class="space-y-3 max-h-96 overflow-y-auto" id="live-jobs">
            @foreach ($latestJobs->take(5) as $job)
              <a href="{{ $job->url }}" class="job-mini-card flex items-center gap-3 p-3 rounded-xl hover:bg-neutral-50 transition">
                <div class="w-10 h-10 rounded-lg bg-brand-100 flex items-center justify-center flex-shrink-0">
                  <x-icon name="briefcase" class="w-5 h-5 text-brand-600" />
                </div>
                <div class="flex-1 min-w-0">
                  <p class="text-body font-medium text-neutral-900 truncate">{{ $job->titre_offre }}</p>
                  <p class="text-body-sm text-neutral-500 flex items-center gap-1">
                    <span>{{ $job->company->name }}</span>
                    <span aria-hidden="true">·</span>
                    <span><x-icon name="map-pin" class="w-3 h-3" /> {{ $job->ville_offre }}</span>
                  </p>
                </div>
                <span class="badge badge-contract badge-{{ $job->contract_slug }} whitespace-nowrap">{{ $job->type_offre }}</span>
              </a>
            @endforeach
          </div>
        </div>
        
        {{-- Floating Stats --}}
        <div class="absolute -bottom-6 -left-6 md:-left-10 lg:-left-16 grid grid-cols-3 gap-4">
          @foreach ([
            ['247', 'Offres actives', 'briefcase'],
            ['12 800', 'Talents inscrits', 'users'],
            ['94%', 'Taux satisfaction', 'heart']
          ] as $stat)
            <div class="bg-white rounded-xl shadow-lg p-5 text-center glass">
              <div class="text-display-lg font-extrabold text-brand-600 tabular-nums">{{ $stat[0] }}</div>
              <div class="text-body-sm text-neutral-500">{{ $stat[1] }}</div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
```

---

### 3.21 Statistics Section

```blade
<section class="py-16 bg-white border-y border-neutral-200">
  <div class="container">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
      @foreach ([
        ['247', 'Missions actives', 'briefcase', 'brand'],
        ['12 800', 'Talents dans notre pool', 'users', 'success'],
        ['156', 'Clients entreprises', 'building-2', 'warning'],
        ['94%', 'Taux de satisfaction', 'heart', 'danger'],
      ] as $stat)
        <div class="text-center">
          <div class="flex justify-center mb-2">
            <div class="w-12 h-12 rounded-xl bg-{{ $stat[3] }}-100 flex items-center justify-center">
              <x-icon name="{{ $stat[2] }}" class="w-6 h-6 text-{{ $stat[3] }}-600" />
            </div>
          </div>
          <div class="text-display-lg font-extrabold text-neutral-950 tabular-nums">{{ $stat[0] }}</div>
          <div class="text-body text-neutral-500">{{ $stat[1] }}</div>
        </div>
      @endforeach
    </div>
  </div>
</section>
```

---

### 3.22 Testimonials (Carousel)

```blade
<section class="py-20 bg-neutral-50">
  <div class="container">
    <header class="text-center max-w-2xl mx-auto mb-16">
      <span class="badge badge-brand mb-4">Témoignages</span>
      <h2 class="text-display-lg">Ils nous font confiance</h2>
      <p class="text-body-lg text-neutral-600 mt-4">
        Candidats et entreprises partagent leur expérience HOMSYS
      </p>
    </header>
    
    <div class="testimonial-carousel relative max-w-4xl mx-auto" 
         x-data="{ index: 0, testimonials: @json($testimonials) }">
      <template x-for="(t, i) in testimonials" :key="i">
        <div class="testimonial-card absolute inset-0 opacity-0 transition-opacity duration-300" 
             x-show="index === i" x-transition:enter="transition-opacity duration-300"
             x-transition:leave="transition-opacity duration-300">
          <blockquote class="bg-white rounded-2xl p-8 md:p-12 shadow-sm border border-neutral-200">
            <div class="flex items-center gap-2 text-brand-500 mb-4">
              <x-icon name="star" class="w-5 h-5 fill-current" /><x-icon name="star" class="w-5 h-5 fill-current" />
              <x-icon name="star" class="w-5 h-5 fill-current" /><x-icon name="star" class="w-5 h-5 fill-current" />
              <x-icon name="star" class="w-5 h-5 fill-current" />
            </div>
            <p class="text-body-lg text-neutral-700 mb-6 leading-relaxed">"{{ t.quote }}"</p>
            <footer class="flex items-center gap-4">
              @if (t.avatar)
                <img src="{{ t.avatar }}" alt="" class="w-12 h-12 rounded-full object-cover">
              @else
                <div class="w-12 h-12 rounded-full bg-brand-100 flex items-center justify-center">
                  <x-icon name="user" class="w-6 h-6 text-brand-600" />
                </div>
              @endif
              <div>
                <div class="font-semibold text-neutral-900">{{ t.name }}</div>
                <div class="text-body-sm text-neutral-500">{{ t.role }}, {{ t.company }}</div>
              </div>
            </footer>
          </blockquote>
        </div>
      </template>
      <div class="flex justify-center gap-2 mt-8" role="tablist" aria-label="Navigation témoignages">
        <template x-for="(t, i) in testimonials" :key="i">
          <button @click="index = i" 
                  :aria-selected="index === i" 
                  :aria-label="'Témoignage ' + (i + 1)"
                  class="w-2.5 h-2.5 rounded-full transition-all"
                  :class="index === i ? 'bg-brand-600 w-8' : 'bg-neutral-300 hover:bg-neutral-400'"></button>
        </template>
      </div>
    </div>
  </div>
</section>
```

---

### 3.23 Recruitment Process Timeline

```blade
<section class="py-20 bg-white">
  <div class="container">
    <header class="text-center max-w-2xl mx-auto mb-16">
      <h2 class="text-display-lg">Notre processus de recrutement</h2>
      <p class="text-body-lg text-neutral-600 mt-4">Transparence, rapidité, qualité — à chaque étape</p>
    </header>
    
    <ol class="process-timeline relative">
      @foreach ([
        ['Écouter & Conseiller', 'Analyse de votre besoin, définition du profil, stratégie de sourcing', 'headphones'],
        ['Chercher sur mesure', 'Diffusion ciblée, approche directe, activation réseau, qualification technique', 'search'],
        ['Évaluer & Présenter', 'Entretiens techniques, tests, vérification références, dossier candidat complet', 'clipboard-check'],
        ['Accompagner l\'intégration', 'Négociation, contractualisation, suivi période d\'essai, feedback continu', 'handshake'],
      ] as $i => $step)
        <li class="process-step relative flex gap-6 pb-12 last:pb-0">
          <div class="process-marker flex-shrink-0 w-12 h-12 rounded-full bg-brand-100 flex items-center justify-center border-4 border-white z-10 relative">
            <span class="text-h4 font-extrabold text-brand-600">{{ $i + 1 }}</span>
          </div>
          <div class="flex-1 pt-1">
            <h3 class="text-h4">{{ $step[0] }}</h3>
            <p class="text-body text-neutral-600 mt-1">{{ $step[1] }}</p>
          </div>
        </li>
      @endforeach
    </ol>
  </div>
</section>

<style>
  .process-timeline::before {
    content: ''; position: absolute; left: 22px; top: 0; bottom: 0; width: 2px; background: var(--color-brand-200);
  }
  .process-step:last-child::before { display: none; }
</style>
```

---

### 3.24 Partner Logos (Marquee)

```blade
<section class="py-16 bg-neutral-50 border-y border-neutral-200 overflow-hidden">
  <div class="container">
    <p class="text-center text-body-sm text-neutral-500 mb-8 uppercase tracking-wider">Ils nous font confiance</p>
    <div class="marquee" aria-label="Logos partenaires">
      <div class="marquee-content flex gap-12 md:gap-16 items-center" x-data="{ paused: false }"
           @mouseenter="paused = true" @mouseleave="paused = false">
        @foreach (['attijariwafa', 'bcp', 'cdg', 'maroc-telecom', 'ocp', 'inwi', 'rma', 'cnss'] as $logo)
          <img src="{{ asset("img/partners/{$logo}.svg") }}" alt="{{ ucfirst($logo) }}" class="h-10 w-auto opacity-60 grayscale hover:opacity-100 hover:grayscale-0 transition-all duration-300" loading="lazy">
        @endforeach
        {{-- Duplicate for infinite scroll --}}
        @foreach (['attijariwafa', 'bcp', 'cdg', 'maroc-telecom', 'ocp', 'inwi', 'rma', 'cnss'] as $logo)
          <img src="{{ asset("img/partners/{$logo}.svg") }}" alt="{{ ucfirst($logo) }}" class="h-10 w-auto opacity-60 grayscale hover:opacity-100 hover:grayscale-0 transition-all duration-300" loading="lazy">
        @endforeach
      </div>
    </div>
  </div>
</section>

<style>
  .marquee-content { animation: marquee 30s linear infinite; will-change: transform; }
  .marquee-content:hover { animation-play-state: paused; }
  @keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
</style>
```

---

### 3.25 FAQ (Accordion)

```blade
<section class="py-20 bg-white">
  <div class="container max-w-3xl">
    <header class="text-center mb-12">
      <h2 class="text-display-lg">Questions fréquentes</h2>
      <p class="text-body-lg text-neutral-600 mt-2">Tout ce qu'il faut savoir sur HOMSYS</p>
    </header>
    
    <dl class="space-y-3" x-data="{ open: null }">
      @foreach ([
        ['Combien coûte le dépôt de CV ?', 'C\'est 100% gratuit pour les candidats. Nous sommes rémunérés par les entreprises.'],
        ['Comment postuler en 1 clic ?', 'Complétez votre profil à 80%+, puis cliquez "Postuler" sur n\'importe quelle offre.'],
        ['Qu\'est-ce que le portage salarial ?', 'Vous restez freelance, nous gérons la facturation, la paie, la mutuelle, la retraite. Vous avez le statut salarié.'],
        ['Comment êtes-vous rémunérés ?', 'Honoraires au succès (placement CDI) ou marge sur TJM (freelance/portage). Pas de frais cachés.'],
        ['Garantissez-vous le recrutement ?', 'Oui, période d\'essai 3 mois. Si le candidat part, nous le remplaçons gratuitement.'],
      ] as $faq)
        <div class="faq-item border border-neutral-200 rounded-xl overflow-hidden bg-neutral-50/50">
          <button class="faq-question w-full px-6 py-4 flex items-center justify-between text-left bg-white hover:bg-neutral-50 transition"
                  @click="open = open === '{{ $loop->index }}' ? null : '{{ $loop->index }}'"
                  :aria-expanded="open === '{{ $loop->index }}'">
            <span class="text-body font-medium text-neutral-900 pr-4">{{ $faq[0] }}</span>
            <x-icon name="chevron-down" class="w-5 h-5 text-neutral-400 flex-shrink-0 transition-transform duration-200" 
                    :class="open === '{{ $loop->index }}' ? 'rotate-180' : ''" />
          </button>
          <div class="faq-answer px-6 pb-4 text-neutral-600" x-show="open === '{{ $loop->index }}'" x-transition:enter="transition ease-out duration-200" x-transition:leave="transition ease-in duration-150">
            <p class="text-body">{{ $faq[1] }}</p>
          </div>
        </div>
      @endforeach
    </dl>
    
    <div class="text-center mt-10">
      <a href="/faq" class="btn btn-ghost">Voir toutes les questions (24)</a>
    </div>
  </div>
</section>
```

---

### 3.26 Newsletter Signup

```blade
<section class="py-20 bg-brand-900 text-white relative overflow-hidden">
  <div class="container text-center relative z-10">
    <div class="max-w-2xl mx-auto">
      <x-icon name="mail" class="w-12 h-12 mx-auto text-brand-300 mb-4" />
      <h2 class="text-display-lg mb-3">Recevez les meilleures offres IT</h2>
      <p class="text-body-lg text-brand-200 mb-6">
        2 400+ talents reçoivent chaque mardi notre sélection personnalisée. 
        Pas de spam, désinscription en 1 clic.
      </p>
      <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto" @submit.prevent="subscribe">
        @csrf
        <label for="newsletter-email" class="sr-only">Votre email professionnel</label>
        <input type="email" id="newsletter-email" name="email" required
               class="flex-1 px-4 py-3 rounded-xl text-neutral-900 placeholder-brand-300 focus:ring-2 focus:ring-brand-400"
               placeholder="votre@email.ma"
               x-model="email"
               @keydown.enter="subscribe">
        <button type="submit" class="btn btn-primary px-8 py-3 whitespace-nowrap" :disabled="loading">
          <template x-if="!loading">S'inscrire</template>
          <template x-if="loading"><x-icon name="loader-2" class="w-5 h-5 animate-spin" /></template>
        </button>
      </form>
      <p class="text-body-sm text-brand-400 mt-4">En vous inscrivant, vous acceptez notre <a href="/cgu" class="underline hover:text-white">politique de confidentialité</a>.</p>
    </div>
  </div>
  <div class="absolute inset-0 bg-[url('data:image/svg+xml,...')] opacity-5" aria-hidden="true"></div>
</section>
```

---

### 3.27 Blog Preview

```blade
<section class="py-20 bg-neutral-50">
  <div class="container">
    <header class="flex items-center justify-between mb-12">
      <div>
        <h2 class="text-display-lg">Conseils & Actualités IT</h2>
        <p class="text-body-lg text-neutral-600 mt-1">Expertise recrutement, tendances tech, carrière</p>
      </div>
      <a href="/blog" class="btn btn-ghost">Voir tous les articles <x-icon name="chevron-right" class="w-4 h-4 ml-1" /></a>
    </header>
    
    <div class="grid md:grid-cols-3 gap-6">
      @foreach ($latestArticles->take(3) as $article)
        <article class="article-card bg-white rounded-2xl overflow-hidden border border-neutral-200 hover:shadow-xl transition-shadow">
          <a href="{{ $article->url }}">
            <img src="{{ $article->image_url }}" alt="" class="w-full h-48 object-cover" loading="lazy">
          </a>
          <div class="p-6">
            <div class="flex items-center gap-2 mb-3">
              <span class="badge badge-brand">{{ $article->category->name }}</span>
              <time class="text-body-sm text-neutral-400">{{ $article->published_at->format('d M Y') }}</time>
            </div>
            <h3 class="text-h4 mb-2">
              <a href="{{ $article->url }}" class="text-neutral-900 hover:text-brand-600 transition">{{ $article->title }}</a>
            </h3>
            <p class="text-body text-neutral-600 line-clamp-3">{{ $article->excerpt }}</p>
            <a href="{{ $article->url }}" class="inline-flex items-center gap-1 text-body font-medium text-brand-600 hover:text-brand-700 mt-4">
              Lire la suite <x-icon name="chevron-right" class="w-4 h-4" />
            </a>
          </div>
        </article>
      @endforeach
    </div>
  </div>
</section>
```

---

## PART 4 — RESPONSIVE DESIGN

### 4.1 Breakpoint Strategy

| Breakpoint | Target | Container | Grid Columns | Key Adjustments |
|------------|--------|-----------|--------------|-----------------|
| **Mobile** `< 640px` | 320–639px | 100% - 32px | 1 | Stack all; sticky bottom CTA; drawer nav; bottom sheets for filters |
| **Large Mobile** `640–767px` | 640–767px | 100% - 32px | 1–2 | 2-col job cards optional; search form 2-col |
| **Tablet** `768–1023px` | 768–1023px | 100% - 48px | 2–3 | Sidebar off-canvas; 2-col job grid; sticky header compact |
| **Laptop** `1024–1279px` | 1024–1279px | 100% - 48px | 3 | Sidebar visible; 3-col job grid; full nav |
| **Desktop** `1280–1535px` | 1280–1535px | 1280px | 3–4 | Max-width container; 4-col option for job cards |
| **Large Desktop** `≥ 1536px` | 1536px+ | 1400px | 4 | Generous whitespace; 4-col job grid |

---

### 4.2 Responsive Grid Examples

```blade
{{-- Job Grid --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
  @foreach ($jobs as $job)
    <x-job-card :job="$job" variant="grid" />
  @endforeach
</div>

{{-- Category Chips --}}
<div class="flex flex-wrap gap-2">
  @foreach ($categories as $cat)
    <a href="{{ $cat->url }}" class="badge badge-category px-3 py-1.5 whitespace-nowrap">
      {{ $cat->name }} <span class="ml-1 opacity-70">{{ $cat->jobs_count }}</span>
    </a>
  @endforeach
</div>

{{-- Dashboard Sidebar --}}
<aside class="hidden lg:block w-64 flex-shrink-0" x-data="{ collapsed: false }">
  <nav class="bg-white border-r border-neutral-200 h-screen sticky top-16" :class="collapsed ? 'w-16' : 'w-64'">
    <!-- Navigation items -->
  </nav>
</aside>
<aside class="lg:hidden fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-xl transform transition-transform duration-300" 
       x-show="sidebarOpen" x-transition.enter="translate-x-0" x-transition.leave="-translate-x-full"
       @click.outside="sidebarOpen = false">
  <!-- Mobile drawer -->
</aside>
```

---

### 4.3 Touch-Friendly Components

| Component | Minimum Size | Implementation |
|-----------|--------------|----------------|
| Buttons | 44×44px | `min-h-[44px] min-w-[44px] px-4` |
| Tap targets (links) | 44×44px | `touch-action: manipulation` |
| Form inputs | 44px height | `h-11` (44px) |
| Checkboxes/Radios | 24×24px | `w-6 h-6` + label click area |
| Dropdown triggers | 44px height | `h-11` |
| Carousel arrows | 48×48px | `p-3` (12px padding) |

---

### 4.4 Adaptive Typography

```css
/* Fluid type — no media queries needed for text */
:root {
  --fs-display-2xl: clamp(2.5rem, 5vw, 4rem);
  --fs-display-xl:  clamp(2rem, 4vw, 3rem);
  --fs-display-lg:  clamp(1.75rem, 3vw, 2.5rem);
  --fs-h1:          clamp(1.5rem, 2.5vw, 2.25rem);
  --fs-h2:          clamp(1.25rem, 2vw, 1.75rem);
  --fs-h3:          1.25rem;
  --fs-h4:          1.125rem;
  --fs-body-lg:     1.125rem;
  --fs-body:        1rem;
  --fs-body-sm:     0.875rem;
  --fs-caption:     0.75rem;
}
```

---

### 4.5 Responsive Images

```blade
{{-- Component: x-responsive-image --}}
<picture>
  <source type="image/avif" srcset="{{ $avifSrc }}" sizes="{{ $sizes }}">
  <source type="image/webp" srcset="{{ $webpSrc }}" sizes="{{ $sizes }}">
  <img src="{{ $fallbackSrc }}" 
       alt="{{ $alt }}" 
       class="{{ $class }}" 
       width="{{ $width }}" 
       height="{{ $height }}"
       loading="{{ $loading ?? 'lazy' }}"
       decoding="async">
</picture>
```

**Sizes example:** `sizes="(max-width: 640px) 100vw, (max-width: 1024px) 50vw, 33vw"`

---

### 4.6 Sticky Actions

| Page | Sticky Element | Mobile | Desktop |
|------|----------------|--------|---------|
| Job Detail | Apply + Save | Bottom bar (safe-area) | Sidebar (position: sticky; top: 100px) |
| Job List | Filters toggle | FAB (bottom-right) | Sidebar |
| Candidate Dashboard | Primary action | Bottom bar | Header |
| Employer Dashboard | Post Job | Bottom bar | Header top-right |

---

### 4.7 Bottom Navigation (Mobile) — **Candidate App Feel**

```blade
<nav class="fixed bottom-0 left-0 right-0 md:hidden z-50 bg-white border-t border-neutral-200 safe-area-bottom" 
     role="navigation" aria-label="Navigation principale mobile">
  <div class="grid grid-cols-4">
    <a href="/offres" class="nav-item flex flex-col items-center justify-center py-2 px-2" aria-label="Offres">
      <x-icon name="briefcase" class="w-6 h-6" />
      <span class="text-caption mt-1">Offres</span>
    </a>
    <a href="/mes-candidatures" class="nav-item flex flex-col items-center justify-center py-2 px-2" aria-label="Candidatures">
      <x-icon name="file-text" class="w-6 h-6" />
      <span class="text-caption mt-1">Candidatures</span>
    </a>
    <a href="/alertes" class="nav-item flex flex-col items-center justify-center py-2 px-2 relative" aria-label="Alertes">
      <x-icon name="bell" class="w-6 h-6" />
      <span class="text-caption mt-1">Alertes</span>
      @if ($unreadAlerts > 0)
        <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-[10px] rounded-full flex items-center justify-center">{{ $unreadAlerts }}</span>
      @endif
    </a>
    <a href="/mon-profil" class="nav-item flex flex-col items-center justify-center py-2 px-2" aria-label="Profil">
      <x-icon name="user" class="w-6 h-6" />
      <span class="text-caption mt-1">Profil</span>
    </a>
  </div>
</nav>
```

---

### 4.8 Mobile Optimization Checklist

- [ ] **Viewport meta:** `<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">`
- [ ] **Touch-action:** `touch-action: manipulation` on all interactive elements
- [ ] **Input types:** `email`, `tel`, `url`, `date`, `number` with `inputmode`
- [ ] **Autocomplete:** `autocomplete="email"`, `tel`, `off` appropriately
- [ ] **Virtual keyboard:** No layout shift on keyboard open (fixed bottom bar uses `viewport-fit=cover`)
- [ ] **Pull-to-refresh:** Disabled on app-like pages (`overscroll-behavior-y: contain`)
- [ ] **Safe areas:** `padding-bottom: env(safe-area-inset-bottom)` on fixed bottom elements
- [ ] **Orientation:** Test portrait/landscape; no horizontal scroll
- [ ] **Performance:** LCP < 2.5s on 3G; TBT < 200ms; CLS < 0.1

---

## PART 5 — SEO AUDIT

### 5.1 Current State Analysis

| Element | Status | Issues |
|---------|--------|--------|
| **Meta Title** | Partial | Home: "HOMSYS : Faites le choix d'un partenaire fiable" (too generic); Job pages: only job title; No brand suffix |
| **Meta Description** | Partial | Home: OK; Job pages: duplicate of title; Many pages missing |
| **H1** | ❌ Missing | Home uses H2 "Dernières offres publiées"; No H1 on any page |
| **H2/H3** | ⚠️ Inconsistent | Heading hierarchy broken; Dosis/Lato mix |
| **Semantic HTML** | ❌ Poor | `<div>` soup; No `<main>`, `<article>`, `<section>`, `<aside>`, `<nav>`, `<header>`, `<footer>` |
| **Internal Linking** | ❌ Minimal | No related jobs, no breadcrumbs, no topic clusters |
| **Keyword Strategy** | ❌ None | Meta keywords stuffed (27 keywords); No content strategy |
| **Recruitment Keywords** | ❌ Missing | "emploi IT Maroc", "freelance développeur Maroc", "portage salarial Maroc", "chasse de têtes IT Casablanca" |
| **IT Keywords** | ❌ Missing | No technology-specific landing pages |
| **Morocco SEO** | ⚠️ Basic | `.ma` domain; Geo meta tags; No local business schema |
| **French SEO** | ⚠️ Basic | `lang="fr"` missing on `<html>`; Content in French but no hreflang |
| **Schema.org** | ❌ None | No `JobPosting`, `Organization`, `BreadcrumbList`, `FAQPage`, `Article` |
| **JSON-LD** | ❌ None | Zero structured data |
| **Open Graph** | Partial | Basic tags in `head.blade.php`; No `og:image:width/height`, no `article:` tags for blog |
| **Twitter Cards** | ❌ None | No `twitter:card`, `twitter:site`, `twitter:creator` |
| **Canonical URLs** | ⚠️ Partial | Hardcoded `https://homsys.ma` in head; Not dynamic per page |
| **Robots.txt** | ❌ Missing | No file in `public/` |
| **Sitemap.xml** | ⚠️ Basic | Only static URLs + jobs; No `<image:image>`, `<xhtml:link>`, no lastmod accuracy |
| **URL Structure** | ❌ Poor | `/offres/{id}` — no slug, no category, no hierarchy |
| **Pagination SEO** | ❌ None | No `rel=next/prev`, no `link` headers, no `ItemList` schema |
| **Duplicate Content** | ⚠️ High | Home + About share "Nos références"; Hardcoded content; Pagination parameter variants |
| **Image SEO** | ❌ None | Hotlinked images; No alt on many; No WebP/AVIF; No structured data |
| **Alt Attributes** | ⚠️ Partial | Some have alt; Many empty or generic |
| **Structured Data** | ❌ Zero | Critical for job boards — Google Jobs requires `JobPosting` |
| **Indexability** | ⚠️ Unknown | No `noindex` audit; Admin pages likely indexable |
| **Crawlability** | ⚠️ Unknown | JS-heavy (Isotope, WOW); Content may not render for bots |
| **E-E-A-T** | ❌ Zero | No author bios, no expertise signals, no trust pages, fake stats |
| **Topical Authority** | ❌ None | No content hubs; No pillar pages; Blog dead since 2020 |

---

### 5.2 Critical SEO Fixes (Priority Order)

| # | Fix | Effort | Impact |
|---|-----|--------|--------|
| 1 | **Add `JobPosting` JSON-LD to every job page** | Low | **CRITICAL** — Google Jobs eligibility |
| 2 | **Add `Organization` + `WebSite` + `BreadcrumbList` JSON-LD globally** | Low | Rich snippets, sitelinks |
| 3 | **Implement dynamic canonical URLs** | Low | Fix duplicate content |
| 4 | **Create `robots.txt` + `sitemap.xml` with images** | Low | Crawl control |
| 5 | **Restructure URLs: `/offres/{slug}-{id}`** | Medium | Keyword-rich URLs |
| 6 | **Add H1 to every page (unique, descriptive)** | Low | On-page SEO |
| 7 | **Build Category/Skill landing pages** | High | Topical authority |
| 8 | **Launch Blog/Resources with editorial calendar** | High | Long-tail traffic |
| 9 | **Add `FAQPage` schema to FAQ sections** | Low | Rich results |
| 10 | **Implement `Article` schema for blog** | Low | Rich results |
| 11 | **Fix meta titles/descriptions with templates** | Low | CTR improvement |
| 12 | **Add hreflang (prep for English)** | Low | International |
| 13 | **Optimize images: WebP/AVIF, alt text, dimensions** | Medium | Image search, LCP |
| 14 | **Remove meta keywords tag** | Trivial | Cleanup |
| 15 | **Add `twitter:card` + `twitter:site`** | Trivial | Social CTR |

---

### 5.3 JobPosting JSON-LD (Required for Google Jobs)

```json
{
  "@context": "https://schema.org",
  "@type": "JobPosting",
  "title": "Lead Développeur React Native",
  "description": "<p>Mission complète...</p>",
  "identifier": { "@type": "PropertyValue", "name": "HOMSYS", "value": "OFF-1247" },
  "datePosted": "2026-07-15",
  "validThrough": "2026-10-15",
  "employmentType": "CONTRACTOR",
  "hiringOrganization": {
    "@type": "Organization",
    "name": "HOMSYS Client — Grande Banque Marocaine",
    "sameAs": "https://www.banque.ma",
    "logo": "https://homsys.ma/img/companies/banque-logo.svg"
  },
  "jobLocation": {
    "@type": "Place",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Casablanca",
      "addressRegion": "Grand Casablanca",
      "addressCountry": "MA"
    }
  },
  "baseSalary": {
    "@type": "MonetaryAmount",
    "currency": "MAD",
    "value": { "@type": "QuantitativeValue", "minValue": 40000, "maxValue": 60000, "unitText": "MONTH" }
  },
  "skills": ["React Native", "TypeScript", "Redux", "CI/CD", "Test Driven Development"],
  "experienceRequirements": "5+ ans en développement mobile",
  "educationRequirements": "Bac+5 Informatique ou équivalent",
  "workHours": "Temps plein",
  "remoteWorkAllowed": true,
  "applicationContact": { "@type": "ContactPoint", "contactType": "recruitment", "email": "recrutement@homsys.ma" }
}
```

**EmploymentType mapping:**
- `Freelance` → `CONTRACTOR`
- `CDI` → `FULL_TIME`
- `CDD` → `FULL_TIME` (add `contractDuration`)
- `Stage` → `INTERN`

---

### 5.4 Organization JSON-LD (Global)

```json
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "HOMSYS",
  "alternateName": "HOMSYS Recrutement IT",
  "url": "https://homsys.ma",
  "logo": "https://homsys.ma/img/logo.svg",
  "foundingDate": "2009",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Bd Abdelmoumen, Résidence Les Almohades",
    "addressLocality": "Casablanca",
    "addressRegion": "Grand Casablanca",
    "postalCode": "20000",
    "addressCountry": "MA"
  },
  "contactPoint": [
    { "@type": "ContactPoint", "telephone": "+212-5-22-XX-XX-XX", "contactType": "customer service", "availableLanguage": ["French", "Arabic", "English"] },
    { "@type": "ContactPoint", "telephone": "+212-5-22-XX-XX-XX", "contactType": "recruitment", "availableLanguage": ["French"] }
  ],
  "sameAs": [
    "https://www.linkedin.com/company/homsys-maroc",
    "https://www.facebook.com/HomsysMaroc",
    "https://twitter.com/HomsysMaroc"
  ],
  "knowsAbout": ["Recrutement IT", "Freelance IT", "Portage Salarial", "Chasse de têtes", "Conseil RH"],
  "aggregateRating": { "@type": "AggregateRating", "ratingValue": "4.8", "reviewCount": "127", "bestRating": "5", "worstRating": "1" }
}
```

---

### 5.5 BreadcrumbList JSON-LD (Per Page)

```json
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Accueil", "item": "https://homsys.ma/" },
    { "@type": "ListItem", "position": 2, "name": "Offres d'emploi", "item": "https://homsys.ma/offres" },
    { "@type": "ListItem", "position": 3, "name": "Freelance", "item": "https://homsys.ma/offres/freelance" },
    { "@type": "ListItem", "position": 4, "name": "