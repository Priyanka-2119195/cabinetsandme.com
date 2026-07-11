# KT.md — Cabinets & Me Landing Pages
**Single Source of Truth · Last updated: 2026-07-02**

> **AI instruction:** Read this file before touching any file in this repo. Everything you need to understand the project is here. Never read a file to "check" something already documented here unless you suspect it may be stale.

---

## 1. Project Overview

**Business:** Cabinets & Me — a bespoke luxury interior design studio based in Bengaluru, India. They design and manufacture kitchens, wardrobes, and full villa/apartment interiors entirely in-house using German machinery, Hettich hardware, and FSC-certified materials.

**Goal of this repo:** A collection of paid-traffic landing pages (LPs) that capture consultation leads from Google Ads and Meta Ads. Each LP targets a specific audience segment with tailored messaging. There is no public homepage here — this is exclusively a lead-generation micro-site.

**Conversion funnel:**
1. Visitor lands on a segment-specific LP via a paid ad
2. They fill in the hero form (name, mobile, email, location, scope/type, budget)
3. Form submits lead to Orbyo CRM via JavaScript API
4. User is redirected to the thank-you page (`/[lp-name]/thank-you`)
5. Thank-you page auto-opens WhatsApp (3-second countdown) with a pre-filled message

**Target audience:** High-income villa and apartment owners in Bengaluru, India — segmented by purchase journey stage (under construction, recent possession, renovation, etc.) and product interest (kitchen, wardrobes, full apartment).

**Hosting:** Vercel (static + one serverless function). Domain: Needs developer confirmation (not visible in code — likely cabinetsandme.com subdomain or separate domain).

---

## 2. Folder Structure

```
cabinetsandme.com/
├── index.html                          # Internal LP index (noindex — not public)
├── vercel.json                         # Vercel routing + cache config
├── .gitignore                          # Only ignores .vercel/
├── Cabinets and Me GTAG.txt            # GA4 snippet reference (not deployed)
├── Cabinets and Me MetaPixel.txt       # Meta Pixel snippet reference (not deployed)
├── api/
│   └── getOrbyoToken.js                # Vercel serverless function — fetches Orbyo OAuth token
├── lp-villa-kitchen/
│   ├── index.html                      # LP: Bespoke Villa Kitchens
│   └── thank-you/
│       └── index.html                  # Thank-you page for kitchen LP
├── lp-villa-wardrobes/
│   ├── index.html                      # LP: Bespoke Villa Wardrobes
│   └── thank-you/
│       └── index.html                  # Thank-you page for wardrobes LP
├── lp-villa-renovation/
│   ├── index.html                      # LP: Villa Interior Renovation
│   └── thank-you/
│       └── index.html                  # Thank-you page for renovation LP
├── lp-villa-under-construction/
│   ├── index.html                      # LP: Plan Interiors Before Possession
│   └── thank-you/
│       └── index.html                  # Thank-you page for under-construction LP
├── lp-villa-recent-possession/
│   ├── index.html                      # LP: Recently Possessed Villa
│   └── thank-you/
│       └── index.html                  # Thank-you page for recent-possession LP
├── lp-apartment-owners/
│   ├── index.html                      # LP: Bespoke Apartment Interiors
│   └── thank-you/
│       └── index.html                  # Thank-you page for apartment LP
└── nri-homeowners/
    ├── index.html                      # LP: NRI Meta Campaign — Apartment Interiors
    └── thank-you/
        └── index.html                  # Thank-you page for NRI Meta campaign LP
```

**No local CSS, JS, image, or font files exist.** Everything is either inline in HTML or loaded from external CDNs (Wixstatic, Google Fonts, Orbyo CDN, jQuery CDN).

---

## 3. Page Inventory

| Page Name | URL Path | File | Purpose | Primary CTA | Form? |
|---|---|---|---|---|---|
| LP Index | `/` | `index.html` | Internal nav to all LPs. `noindex`. | — | No |
| Villa Kitchen | `/lp-villa-kitchen` | `lp-villa-kitchen/index.html` | Lead gen for bespoke villa kitchen | "Design My Kitchen →" | Yes |
| Villa Wardrobes | `/lp-villa-wardrobes` | `lp-villa-wardrobes/index.html` | Lead gen for bespoke villa wardrobes | "Design My Wardrobes →" | Yes |
| Villa Renovation | `/lp-villa-renovation` | `lp-villa-renovation/index.html` | Lead gen for villa interior renovation | "Book a Free Consultation →" | Yes |
| Villa Under Construction | `/lp-villa-under-construction` | `lp-villa-under-construction/index.html` | Lead gen for pre-possession planning | "Plan My Villa Interiors →" | Yes |
| Villa Recent Possession | `/lp-villa-recent-possession` | `lp-villa-recent-possession/index.html` | Lead gen for recently-possessed villas | "Elevate Your Villa →" | Yes |
| Apartment Owners | `/lp-apartment-owners` | `lp-apartment-owners/index.html` | Lead gen for luxury apartment interiors | "Commission My Apartment →" | Yes |
| NRI Homeowners (Meta) | `/nri-homeowners` | `nri-homeowners/index.html` | Lead gen for NRI apartment owners abroad — Meta campaign | "Book Your Design Consultation →" | Yes |
| Kitchen Thank You | `/lp-villa-kitchen/thank-you` | `lp-villa-kitchen/thank-you/index.html` | Post-submission confirmation + WA redirect | WhatsApp CTA | No |
| Wardrobes Thank You | `/lp-villa-wardrobes/thank-you` | `lp-villa-wardrobes/thank-you/index.html` | Post-submission confirmation + WA redirect | WhatsApp CTA | No |
| Renovation Thank You | `/lp-villa-renovation/thank-you` | `lp-villa-renovation/thank-you/index.html` | Post-submission confirmation + WA redirect | WhatsApp CTA | No |
| Under Construction Thank You | `/lp-villa-under-construction/thank-you` | `lp-villa-under-construction/thank-you/index.html` | Post-submission confirmation + WA redirect | WhatsApp CTA | No |
| Recent Possession Thank You | `/lp-villa-recent-possession/thank-you` | `lp-villa-recent-possession/thank-you/index.html` | Post-submission confirmation + WA redirect | WhatsApp CTA | No |
| Apartment Thank You | `/lp-apartment-owners/thank-you` | `lp-apartment-owners/thank-you/index.html` | Post-submission confirmation + WA redirect | WhatsApp CTA | No |
| NRI Homeowners Thank You | `/nri-homeowners/thank-you` | `nri-homeowners/thank-you/index.html` | Post-submission confirmation + WA redirect | WhatsApp CTA + Explore Projects / Return to Website | No |

---

## 4. Every Page Explained

### `index.html` — Internal LP Index
- **Purpose:** Developer/team reference page linking to all landing pages
- **Robots:** `noindex, nofollow` — never crawled
- **Content:** Card grid grouped by audience (Apartment / Kitchen / Villa Campaigns). Every new LP folder must get a card added here — the page footer literally says "Add new campaign pages here as they go live," and it's easy to forget since this file isn't touched when duplicating an LP folder.
- **Tracking:** GA4 + Meta Pixel + Orbyo widget (all LPs share this)
- **Note:** Not linked from any public page

---

### `lp-villa-kitchen/index.html` — Villa Kitchen LP
- **Title:** `Bespoke Luxury Kitchens for Bengaluru Villas — Cabinets & Me`
- **Meta desc:** "Your kitchen should be the most considered room in your villa. Cabinets and Me crafts fully bespoke luxury kitchens for Bengaluru finest homes."
- **Hero H1:** "Your Kitchen Should Be the Most Considered Room in Your Home."
- **Hero eyebrow:** "Bespoke Kitchen Specialists · Bengaluru"
- **Badges:** Handleless Profiles · Stone Countertops · Hettich Mechanisms · LGA Certified
- **Form heading:** "Design Your Dream Kitchen"
- **Form CTA:** "Design My Kitchen →"
- **Nav CTA:** "Design My Kitchen"
- **Nav links:** Projects | The Difference | Materials | Studio
- **3rd field label:** "Kitchen Layout Preference" (Open Kitchen / Island Kitchen / L-Shaped / U-Shaped / Not Sure Yet)
- **4th field label:** "Approximate Budget" (₹8L–₹15L / ₹15L–₹30L / ₹30L+ / Quality is the priority)
- **Unique sections:** `#villas` section (villa pain points) + `#mosaic` (78 Beverly Hills, Evantha Aristi, Nambiar Bellezea) + `#standard` (Handleless Profiles, Stone Countertops, Hettich, Integrated Appliances panels) + `#materials` (4 material cards) + `#collections` (3 collection cards) + FAQ (5 kitchen-specific questions)
- **Hero bg image:** `e3b82d_b4d5ab7c97dd4207a98affd10b4ee7e0~mv2.jpg`
- **WA message (thank-you):** "I've been looking at Cabinets & Me for my villa kitchen in Bengaluru. I'm ready to take this forward — when is a good time to connect?"

---

### `lp-villa-wardrobes/index.html` — Villa Wardrobes LP
- **Title:** `Bespoke Walk-In Wardrobes for Bengaluru Villas — Cabinets & Me`
- **Meta desc:** "A wardrobe built around you, not standard sizes. Cabinets and Me designs custom walk-in wardrobes and fitted wardrobes for Bengaluru villa homes."
- **Hero H1:** "A Wardrobe Built Around You — Not Standard Sizes."
- **Hero eyebrow:** "Bespoke Wardrobe Specialists · Bengaluru"
- **Badges:** Hettich Soft-Close · Integrated LED · Custom Drawer Inserts · LGA Certified
- **Form heading:** "Design Your Dream Wardrobe"
- **Form CTA:** "Design My Wardrobes →"
- **Nav CTA:** "Design My Wardrobe"
- **Nav links:** Projects | Walk-In vs Fitted | Features | Studio
- **3rd field label:** "Wardrobe Type" (Walk-In Closet / Fitted Swing Door / Fitted Sliding Door / Both / Not Sure)
- **4th field label:** "Bedrooms Needing Wardrobes" (1 / 2 / 3 / All bedrooms)
- **Hero bg image:** `e3b82d_6e895bda19904463919bc78f0da0023b~mv2.jpg`
- **WA message (thank-you):** "I've been considering bespoke wardrobes for my villa in Bengaluru and Cabinets & Me feels like the right fit. I'm ready to begin — let's connect."
- **Unique sections:** `#villas` section + `#next` (What Happens Next - 3-step process) + `#midform` (mid-page second form)

---

### `lp-villa-renovation/index.html` — Villa Renovation LP
- **Title:** `Villa Interior Renovation, Bengaluru — Cabinets & Me`
- **Meta desc:** "Your villa has changed. Your interiors should too. Bespoke kitchen and wardrobe renovation for Bengaluru finest villa homes."
- **Hero H1:** "Your Villa Has Changed. Your Interiors Should Too."
- **Hero eyebrow:** "Villa Interior Renovation · Bengaluru"
- **Badges:** No Outsourcing · LGA Certified · Snag-Free Handover · German Machinery
- **Form heading:** "Tell Us What Needs to Change"
- **Form CTA:** "Book a Free Consultation →"
- **Nav CTA:** "Book Consultation"
- **Nav links:** Projects | What We Redesign | FAQs | Studio
- **3rd field label:** "What Are You Looking to Renovate?" (Full Villa / Kitchen Only / Wardrobes Only / Kitchen + Wardrobes / Specific Rooms)
- **4th field label:** "When Are You Looking to Start?" (Within 1 month / 1–3 months / 3–6 months) — **note: no budget field, replaced by timeline**
- **Hero bg image:** `e3b82d_3478177ba99d4e3b9b5f39ddc31b1c73~mv2.jpg`
- **WA message (thank-you):** "I'm looking to reimagine my villa's interiors in Bengaluru and I believe Cabinets & Me is the right studio for this. I'm ready to take the conversation forward."
- **Unique sections:** `#villas` section + `#next` (What Happens Next) + `#midform`

---

### `lp-villa-under-construction/index.html` — Under Construction LP
- **Title:** `Plan Your Villa Interiors Before Possession — Cabinets & Me`
- **Meta desc:** "Possession is coming. Your interiors should already be planned. Cabinets and Me works with you 3 to 9 months before possession."
- **Hero H1:** "Possession is Coming. Your Interiors Should Already Be Planned."
- **Hero eyebrow:** "Under Construction Villa · Bengaluru"
- **Badges:** Plan 3–9 Months Early · LGA Certified · German Machinery · Move In Ready
- **Form heading:** "Tell Us About Your Villa"
- **Form CTA:** "Plan My Villa Interiors →"
- **Nav CTA:** "Plan My Interiors"
- **Nav links:** Projects | Why Plan Ahead | FAQs | Studio
- **3rd field label:** "Expected Possession Timeline" (Within 3 months / 3–6 months / 6–9 months / 9–12 months)
- **4th field label:** "Approximate Budget" (₹10L–₹20L / ₹20L–₹40L / ₹40L–₹75L / ₹75L+ / Quality is the priority)
- **Hero bg image:** `e3b82d_15351457410449c99ff32b4326f2c0f8~mv2.jpeg`
- **WA message (thank-you):** "My villa in Bengaluru is getting ready and I want to approach the interiors with the same care. I'm ready to begin planning — let's connect."
- **Unique sections:** `#villas` section + `#next` + `#midform`

---

### `lp-villa-recent-possession/index.html` — Recent Possession LP
- **Title:** `Bespoke Villa Interiors, Bengaluru — Cabinets & Me`
- **Meta desc:** "You have the keys. Now design the home it deserves. Cabinets and Me crafts bespoke villa interiors for Bengaluru finest homes."
- **Hero H1:** "You Have the Keys. Now Design the Home It Deserves."
- **Hero eyebrow:** "Recently Possessed Villa · Bengaluru"
- **Badges:** LGA Certified · CATAS Approved · German Machinery · 100% In-House
- **Form heading:** "Begin Your Villa's Interior Legacy"
- **Form CTA:** "Elevate Your Villa →"
- **Nav CTA:** "Book Consultation"
- **Nav links:** Projects | Process | FAQs | Studio
- **3rd field label:** "What Are You Looking to Design?" (Full Villa / Kitchen Only / Wardrobes Only / Kitchen + Wardrobes / Specific Rooms)
- **4th field label:** "Approximate Budget" (₹10L–₹20L / ₹20L–₹40L / ₹40L–₹75L / ₹75L+ / Quality is the priority)
- **Hero bg image:** `e3b82d_d941e44ab97e423ca07a205b5e9a4e41~mv2.jpg`
- **WA message (thank-you):** "I recently received possession of my villa in Bengaluru and I want to design it with someone who brings real vision. I'm ready to begin — when can we talk?"
- **Unique sections:** `#villas` section + `#next` + `#midform`

---

### `lp-apartment-owners/index.html` — Apartment Owners LP
- **Title:** `Bespoke Turnkey Interiors for Bengaluru Apartments — Cabinets & Me`
- **Meta desc:** "Your premium apartment deserves a bespoke touch. Cabinets and Me crafts zero-tolerance luxury interiors for Bengaluru's finest flats and penthouses."
- **Hero H1:** "Your Apartment Should Be the Most Considered Space You Own."
- **Hero eyebrow:** "Bespoke Apartment Interiors · Bengaluru"
- **Badges:** Floor-To-Ceiling Customization · Italian Aesthetics · Zero-Tolerance Execution · 5-7 Day Site Install
- **Form heading:** "Commission Your Interior"
- **Form CTA:** "Commission My Apartment →"
- **Nav CTA:** "Book Consultation"
- **Nav links:** Projects | Process | FAQs | Studio
- **3rd field label:** "Apartment Scope" (Full 3BHK Interior / Luxury Duplex / Penthouse Execution / Not Sure Yet)
- **4th field label:** "Approximate Budget" (₹25L–₹40L / ₹40L–₹70L / ₹70L+ / Quality is the priority) — higher brackets than villa LPs
- **Hero bg image:** `e3b82d_d941e44ab97e423ca07a205b5e9a4e41~mv2.jpg` (same as recent-possession)
- **WA message (thank-you):** "I've been looking at Cabinets & Me for my apartment interior in Bengaluru. I'm ready to take this forward — when is a good time to connect?"
- **Unique sections:** No `#villas` section. Has `#standard` (The Difference panels) + `#mosaic` + `#collections` + Testimonials + Portfolio + FAQ

---

### `nri-homeowners/index.html` — NRI Homeowners LP (Meta Campaign)
- **Purpose:** Duplicated from `lp-villa-recent-possession` for a Meta Ads campaign targeting NRIs (UAE, Saudi Arabia, Qatar, Oman, Kuwait, Bahrain, Singapore, UK, US, Canada, Australia) who own or recently purchased a Bengaluru apartment. Goal is consultation enquiries, not sales-heavy discounting.
- **Title:** `Luxury Apartment Interiors In Bengaluru For NRIs | Cabinets & Me`
- **Meta desc:** "Premium apartment interior design in Bengaluru for NRI homeowners. Luxury modular kitchens, wardrobes and complete interiors managed remotely from design to installation."
- **Canonical / OG / Twitter tags:** Present on this LP only (no other LP has these yet — see Known Issues §16).
- **Hero H1:** "Your Home. Ready Before You Return." — **Hero eyebrow:** "For NRI Homeowners · Bengaluru Apartments"
- **Hero CTAs:** Primary "Book Your Design Consultation" (scrolls to `#hform`, new `.hero-btn-primary` class) + secondary "View Our Projects" (anchors to `#portfolio`, new `.hero-btn-outline` class) — the only LP with buttons in `.hero-left`.
- **Badges:** LGA Certified · Remote Project Management · German Machinery · 100% In-House
- **Form fields (unique to this LP):** Name, Phone (international format — see below), Email, **Current Country** (`f-model` repurposed — UAE/Saudi Arabia/Qatar/Oman/Kuwait/Bahrain/Singapore/UK/US/Canada/Australia/Other), Apartment Location in Bengaluru (`f-location` — expanded locality list incl. HSR Layout, Bellandur, Marathahalli, Jayanagar, RR Nagar, North/East/South Bengaluru), Expected Possession (`f-extra` repurposed — Already Possessed / Within 3 Months / 3–6 / 6–12 / More Than 12), and a new optional **Message** `<textarea id="f-message">`.
- **Phone validation:** `validatePhone()` on this page only accepts general international numbers (`/^\+?\d{7,15}$/`) instead of the strict 10-digit Indian mobile regex used on the other 6 LPs, since NRI leads dial with a foreign country code. Do not port this change back to the other LPs — their audience dials from within India.
- **Hidden fields:** Standard `f-gclid`/`f-pagelink`/`f-utm-source`/`f-utm-medium` plus 3 new static hidden fields — `f-campaign` ("NRI Meta"), `f-static-source` ("Meta"), `f-static-medium` ("Paid") — read into `custom_values` as `campaign`/`lead_source_tag`/`lead_medium_tag`.
- **Orbyo `.withMode()`:** `'nri apartment'`. **WA project key:** `'nri'` (added to the shared `vP`/`lP` dictionaries alongside the other 6 project keys).
- **Unique sections built by reusing otherwise-dormant shared CSS:** `#villas` (repurposed as "Designed For Homeowners Living Overseas" — 4 cards: One Dedicated Team / Remote Design Process / Transparent Project Updates / Ready Before You Return; now also has a `.villas-bg` background photo + teal gradient overlay, same technique as `.studio-bg`; `.villa-card` background darkened to `rgba(6,40,46,.34)` with a slight blur for legibility over the photo), `#materials` (repurposed as "Our Expertise" — 6-card `.mat-grid` at `repeat(3,1fr)` on desktop (was 4 cols in the original component; changed here so 6 photo cards form two even rows): Kitchens, Wardrobes, Living Spaces, Bathrooms, Storage, Furniture, each with a `.mat-media` photo thumbnail. TV Units and Utility Areas were dropped — they had no matching photo and looked sparse as icon-only cards), `#collections` (new "Curated By Room" — 3 cards: Kitchens, Wardrobes, Bathrooms, inserted between Expertise and the Project Gallery), `#testimonials` (2 new NRI-client quotes — Dubai, London). These classes exist in every LP's copy-pasted CSS block but were previously unused HTML in this LP's source (`lp-villa-recent-possession`).
- **Hero height fix:** `#hero` changed from `min-height:100vh` to `height:100vh;min-height:640px` (desktop only — mobile media query resets it to `height:auto`). With the extra NRI form fields and hero CTAs, `min-height:100vh` let the section grow taller than the viewport on common laptop heights (~750–800px), pushing the hero CTAs and the form's submit button below the fold with no indication there was more to see. `.hero-form` keeps its `overflow-y:auto` so the form scrolls internally if it's ever taller than the panel. `.hero-left` does **not** use `overflow-y:auto` — an internal scrollbar on just the left column read as broken/disconnected from the rest of the page. Instead its vertical rhythm (padding, eyebrow/sub/CTA margins) uses `min(Npx, Nvh)` so spacing compresses on short viewports, and `h1.hero-title` uses `clamp(2.1rem, 4vw + 1.5vh, 4.4rem)` so type scales with both viewport axes — content fits without ever needing to scroll, verified down to the 640px floor. The form itself was also compacted — paired fields into `.field-row` (Name+Phone, Email+Current Country), tighter padding/margins.
- **Hero form panel — tried and reverted a floating frosted-glass treatment.** Briefly made `.hero-form` a translucent, blurred, rounded, floating card (`align-self:center`, `margin`, `backdrop-filter`, `border-radius:20px`) with the hero image made full-bleed behind both columns. Client feedback: the floating/blurred card looked worse than the original, and reverted it — `.hero-form` is back to its original solid `var(--white)` panel, `border-left:4px solid var(--gold)`, `box-shadow:var(--shadow-lg)`, no radius, no margin, stretched edge-to-edge with the grid (exactly as every other LP's hero form works). **What was kept:** `border-radius:6px` on the `.field input/select/textarea` elements only — the client wanted rounded corners on the *fields*, not the card. Also kept the slow ambient `heroBgZoom` animation on `.hero-bg` (same technique already used on `lp-apartments-meta-01/index.html`) and the `linear-gradient(...)` legibility scrim.
- **Hero background image — resolved, now a real 1672x941 (~16:9) landscape photo, served locally.** Went through several iterations: Wixstatic CDN photo (sharp, but a slow third-party request) → local `kitchen_1-1` at its original 472x590 (fast, same-origin, but visibly soft/cropped after the ~4x upscale needed to cover a widescreen hero) → client supplied a proper landscape version of the same shot (1672x941, "cabinets & me" watermark top-right), which was dropped directly into `nri-homeowners/` as `kitchen_1-1.webp`. That file arrived mislabeled (actual PNG bytes saved with a `.webp` extension, so it wasn't a real WebP and there was no matching JPEG fallback for the new photo). Fixed by re-encoding properly: `cwebp -q 92 -m 6` for a genuine `kitchen_1-1.webp` (162KB), and a Puppeteer canvas re-encode (load the PNG, draw to `<canvas>`, `toDataURL('image/jpeg', 0.9)`) for `kitchen_1-1.jpg` (239KB) since no ImageMagick/sharp is installed here, just `cwebp`. Both now correctly represent the same sharp, near-16:9 photo, so `.hero-bg`'s `image-set()` fallback (webp + jpg, same technique as `.villas-bg`) needed no HTML changes, same filenames, corrected content. `og:image`/`twitter:image`/`thank-you/index.html`'s `.ty-img-bg` all already pointed at `kitchen_1-1`, so they picked up the fix automatically.
  - **If a `.webp` (or any image) file ever looks suspiciously large or has the wrong dimensions for what's referenced, check with `file <name>` before trusting the extension** — extensions are not validated anywhere in this pipeline (no build step), so a mislabeled file will sit there silently until something inspects the actual bytes.
- **Lesson on `justify-content:center` + `overflow-y:auto`:** hit this during the glass-card experiment (now reverted, but worth remembering) — centering flex content inside a height-constrained, scrollable container is a trap: the scrollable area's default scroll position (0) lands mid-content when it overflows, hiding the true top with no visual indication anything is cut off. If `.hero-form` (or anything similar) is ever height-capped again, keep `justify-content:flex-start` or explicitly test at the smallest viewport.
- **"Other" country field:** selecting "Other" in Current Country (`#f-model`) reveals `#f-model-other-wrap` (a free-text input, `onchange="toggleOtherCountry(this)"` on the select). Required only when visible — validated in `sub()` alongside the other fields. The typed value replaces the literal string `"Other"` in `custom_values.model` before the Orbyo submit.
- **Grid-orphan fixes:** three grids in this LP have item counts that don't divide evenly into their column count, which left an empty, misaligned gap after the content was filled in. Fixed: the 7th `.proc-card` (Process) is centered in its own row (`grid-template-columns:1fr;margin:auto;max-width:384px` — note the `grid-template-columns` override is required, otherwise the single item only fills 1 of 3 implicit columns and renders too narrow); the 7th `.std-panel` (Why Cabinets & Me) spans both columns (`grid-column:1/-1`) instead of leaving an empty cell beside it; the portfolio's first item no longer uses the `.port-item.wide` modifier (2+1+1+1+1+1 = 7 grid units in a 3-col grid orphaned the 6th image) — 6 plain items now form two clean rows of 3.
- **Copy pass, image-first:** every paragraph on this page (hero sub, section leads, card bodies, FAQ answers, studio/scarcity copy) was trimmed to a single short line, per client request to lean on the photography instead of prose. Headlines (`h1`, `h2`, `h3`/`.std-panel-h`, card titles) were left untouched, only the descriptive text under them was cut. If new sections are added to this page, match that density, one short sentence per card/paragraph, not two or three.
- **No em dashes anywhere in this page's visible copy or JS message strings**, per explicit client instruction. Use a comma or period instead, or just split into two sentences. This applies to `index.html` and `thank-you/index.html` content, not to the decorative `── SECTION ──` comment dividers in the `<style>`/`<script>` blocks (those are a box-drawing character, not an em dash, and match the rest of the codebase's convention), and not to this KT.md file itself.
- **WebP images, converted locally with `cwebp` (already installed at `C:\Program Files\libwebp\bin\cwebp`, `-q 92 -m 6`).** Every local raster (the 12 files listed above) has a same-named `.webp` sibling. All local `<img>` tags are wrapped in `<picture><source srcset="....webp" type="image/webp"><img src="....original ext">` so unsupported browsers silently fall back to the original jpg/png, exactly the same fallback pattern the other 6 LPs use for AVIF. The one CSS background using a local image (`.villas-bg`) uses the site's proven two-declaration trick: a plain `background` shorthand (gradient + original jpg, the fallback every browser understands) followed by a `background-image` override using `image-set(url(...webp) type('image/webp'), url(...jpg) type('image/jpeg'))` (browsers that don't support `image-set()` just ignore that whole declaration as invalid, leaving the first one in effect). Total local image payload dropped from ~9.4MB to ~1.6MB (about 83% smaller) at this quality setting, with no visible quality loss, verified at 100% zoom including the three images with baked-in "Uncompromising Interiors" text overlays.
  - **Filename collision gotcha:** `Sideboards_2_1-1.png` and `sideboards_2_1-1.jpg` are two *different* photos that differ only by case. Naively converting both to `.webp` produces the same filename on Windows' case-insensitive filesystem, silently overwriting one. They were converted to explicitly disambiguated names instead: `Sideboards_2_1-1_gallery.webp` (from the PNG, used in `#vbreak`) and `sideboards_2_1-1_dining.webp` (from the JPG, used in the mosaic, materials, and portfolio sections). If more images are added to this folder, check for this kind of case-only collision before batch-converting.
  - **`<link rel="preload" as="image" fetchpriority="high">` added in `<head>`**, pointing at whatever `.hero-bg` currently uses (`/nri-homeowners/kitchen_1-1.webp` as of this writing) so the browser starts fetching the largest above-the-fold image immediately instead of waiting for CSS parsing to discover it. Same technique already used on `lp-apartments-meta-01/index.html`. **Keep this in sync with `.hero-bg`'s URL whenever that image changes.**
- **`#standard` repurposed as "Why Cabinets & Me"** — expanded from 4 to 7 `.std-panel` cards (Premium Materials, Hardware, Design Philosophy, Our Team, Manufacture, Installation, After-Sales).
- **`#process` expanded from 6 to 7 `.proc-card` steps** — Book Consultation → Understand Your Apartment → Design & Material Selection → Remote Reviews & Approvals → Manufacturing → Professional Installation → Project Handover.
- **`#portfolio` gallery** — all 6 items use local photos (see Local Images below); the first item now uses the previously-unused `.port-item.wide` modifier (CSS existed but no LP used it before this page).
- **New `#areas` section** ("Serving Apartment Owners Across Bengaluru") — reuses the existing `.badge` pill component (previously only used in hero) as a 17-item locality tag list. No new CSS beyond a couple of inline layout styles.
- **Local Images (unique to this LP):** This is the only LP with local image assets, dropped directly into `nri-homeowners/` (12 files: `kitchen_1-1.jpg`, `kitchen_3_1-1.jpg`, `kitchen_4_1-1.jpg`, `living_area_1-1.jpg`, `sideboards_2_1-1.jpg`, `wardrobes_1-1.jpg`, `Kitchen_Cabinets_2_1-1.png`, `Kitchen_Cabinets_2_9-16.png`, `Kitchen_Cabinets_3_1-1.png`, `Sideboards_2_1-1.png`, `Walkin_Closet_2_9-16.png`, `Bathroom_Cabinets_9-16.png`). No `<picture>`/AVIF (those variants don't exist for these files, unlike the CDN-hosted Wixstatic assets on the other 6 LPs). `loading="lazy"` used on everything below the fold, per KT §18. Images are reused across sections (hero/mosaic/expertise/collections/portfolio) the same way the original 6 LPs reuse their Wixstatic photos.
  - **⚠️ Must use root-relative paths (`/nri-homeowners/filename.jpg`), never bare relative paths (`filename.jpg`).** `vercel.json` sets `"cleanUrls": true` and `"trailingSlash": false`, so the live URL for this page is `https://www.cabinetsandme.com/nri-homeowners` with no trailing slash. A bare relative path resolves against that URL by dropping the last segment (`nri-homeowners`), pointing at the site root instead of the LP folder — the image 404s. This bit us once already (broken images on the live deploy) precisely because every other LP only ever used absolute `https://static.wixstatic.com/...` URLs and never hit this. Same rule applies in `thank-you/index.html` — use `/nri-homeowners/filename.jpg`, not `../filename.jpg`.
- **Hero bg / OG / Twitter image:** `kitchen_1-1.jpg` (local). The hero background is a `linear-gradient(...)` + `url('kitchen_1-1.jpg')` composite (in `.hero-bg`) instead of the flat low-opacity watermark technique used on the other 6 LPs — the gradient keeps text legible over a full-strength real photo. OG/Twitter image tags point to the absolute production URL `https://www.cabinetsandme.com/nri-homeowners/kitchen_1-1.jpg`.
- **WA message (thank-you):** "I'm an NRI homeowner with an apartment in Bengaluru and I want to design it with someone who brings real vision. I'm ready to begin — when can we talk?"

---

### Thank-You Pages (7 pages total — identical structure, different quote/WA message)

All thank-you pages share the same layout and logic:
- **Layout:** Two-column grid (55fr / 45fr). Left = full-bleed image panel. Right = confirmation content.
- **Left panel:** Background image (unique per LP), dark teal overlay with gradient, italic brand quote at bottom
- **Right panel:** Logo + "LGA Certified" badge at top, `<h1>` "Thank You for Submitting Your Details.", gold rule, eyebrow text, body text, WhatsApp CTA, 3-second countdown auto-redirect, footer note
- **Robots:** `noindex, nofollow` on all thank-you pages
- **Countdown:** If URL has `?wa=<encoded-url>` param, shows 3-second countdown then redirects to WhatsApp
- **What differs per TY page:** Background image URL, italic quote on image panel, WA pre-filled message
- **`nri-homeowners/thank-you` only:** `<h1>` is "Thank You!" (not "Thank You for Submitting Your Details.") with a separate subheading/body copy block above the WhatsApp CTA, and two extra CTA buttons below the WhatsApp card — "Explore Our Projects" (→ `cabinetsandme.com/projects`) and "Return To Website" (→ `cabinetsandme.com`) — using new `.ty-btn`/`.ty-btn-primary`/`.ty-btn-outline` classes added to this page's `<style>` block only (mirrors the `.btn`/`.btn-white`/`.btn-outline` pattern from the main LP studio section, recoloured for a light background). No other TY page has these buttons.

| LP | TY Background Image | Quote on Image |
|---|---|---|
| Kitchen | `e3b82d_b4d5ab7c97dd4207a98affd10b4ee7e0~mv2.jpg` | "Your kitchen should be the most considered room in your villa." |
| Wardrobes | `e3b82d_6e895bda19904463919bc78f0da0023b~mv2.jpg` | "A wardrobe built around you — not standard sizes." |
| Renovation | `e3b82d_3478177ba99d4e3b9b5f39ddc31b1c73~mv2.jpg` | "Your villa has changed. Your interiors should too." |
| Under Construction | `e3b82d_8ca0abdf00f746afafdf8840cd5a92ee~mv2.jpg` | "The most discerning clients plan their interiors before possession." |
| Recent Possession | `e3b82d_d941e44ab97e423ca07a205b5e9a4e41~mv2.jpg` | "You have the keys. Now design the home it deserves." |
| Apartment | `e3b82d_d941e44ab97e423ca07a205b5e9a4e41~mv2.jpg` | "Your apartment should be the most considered space you own." |
| NRI Homeowners | `../kitchen_1-1.jpg` (local, only TY page using a local image) | "Your home. Ready before you return." |

---

## 5. Section Breakdown

All sections below apply to all 6 LPs unless noted otherwise.

### `nav` — Fixed Navigation
- **HTML:** `<nav id="nav">` at top of `<body>`
- **Height:** 72px fixed, `z-index: 500`
- **Contents:** Logo (left), nav links (centre, hidden on mobile), CTA button (right), hamburger (mobile only)
- **Logo:** External image from Wixstatic (PNG, transparent background, height 40px in nav)
- **Nav links:** Anchor links to page sections (`#portfolio`, `#standard`, etc.) — vary per LP
- **CTA button:** `.nav-cta` — scrolls to `#hform` on click. Text varies per LP
- **Scroll behaviour:** Adds `.scrolled` class (box-shadow) when `scrollY > 60`
- **Mobile:** Nav links hidden at `≤1080px`. Hamburger shown but has no open/close JS (opens nothing). **Known issue — hamburger non-functional.**
- **Edit:** Nav link labels and CTA text are inline in HTML

### `#hero` — Hero Section
- **Layout:** CSS Grid, `grid-template-columns: 1fr 440px` on desktop. Stacks vertically on mobile.
- **Left side (`.hero-left`):** Eyebrow label, H1, subheadline, badge pills
- **Background image (`.hero-bg`):** Absolutely positioned, opacity 0.20 watermark effect. Uses `image-set()` for AVIF/JPEG. URL varies per LP.
- **Right side (`.hero-form`):** White card with `border-left: 4px solid gold`. Contains the lead capture form.
- **Form eyebrow:** Small gold uppercase text above form heading
- **Form heading:** Serif font, 1.85rem
- **Edit:** All hero text is inline. Background image URL is in inline style on `.hero-bg` div.

### `#press` — Press/Featured Bar
- **Content:** "Featured on" label + 5 press logos (Buildofy, ArchDaily, Building & Interior, Love That Design, Architects Diary)
- **All logos:** Wixstatic-hosted PNGs, height 26px, grayscale with colour on hover
- **Identical across all 6 LPs**

### `#standard` / `#villas` — Differentiators Section
- **`#standard`** present in all LPs: Intro text + stats bar + 4 feature panels (`.std-panel`) + closing teal bar with brand quote
- **`#villas`** present in: kitchen, wardrobes, renovation, under-construction, recent-possession (not apartment). Dark teal background. Left text column + right grid of 4 "villa problem" cards.
- **Stats bar (`.std-stats`):** 5 stats in teal bar — numbers vary slightly per LP
- **Feature panels:** 4 panels in 2×2 grid. Each has ghost letter, eyebrow, heading, body text. Gold left-border reveal on hover.

### `#mosaic` — Project Mosaic Gallery
- **Layout:** CSS Grid, `60fr 40fr` with `1fr 1fr` rows. Large image spans 2 rows.
- **3 images** per LP (named project photos from Wixstatic)
- **Mosaic strip below:** Italic brand quote + anchor link to `#portfolio`
- **Hover:** Scale + darkened image

### `#vbreak` — Visual Break / Full-Width Image Quote
- **Full-width image** with dark overlay, centred italic serif quote in white/gold
- **Image varies per LP** (same pool of Wixstatic images reused)

### `#process` — Design Process (3 steps)
- **Present in:** apartment, renovation, recent-possession, under-construction, wardrobes
- **Not present in:** kitchen (uses `#villas` + materials instead)
- **Layout:** 3-column card grid
- **Each card:** Large serif number (ghost style), title, subtitle, body text. Gold top-border on hover.

### `#materials` — Materials & Hardware
- **Present in:** kitchen, wardrobes (other LPs may vary)
- **4 material cards in a 4-column grid** — FSC Boards, German Cabinet Fronts, Hettich Hardware, Stone Countertops
- **Each card has inline SVG icon** (no external icon library)

### `#collections` — Design Collections
- **3 collection cards** with portrait-ratio images, overlay text revealed on hover
- **Present in:** kitchen, wardrobes, renovation, recent-possession, under-construction, apartment (all LPs)

### `#testimonials` — Client Testimonials
- **Teal background**, 2-column grid of testimonial cards
- **Each card:** Opening quote mark, italic serif quote, client name, role/location
- **Present in all 6 LPs** (content identical across LPs)

### `#portfolio` — Project Portfolio Grid
- **3-column masonry-style grid** with image overlays
- **One "wide" item** that spans 2 columns (`.port-item.wide`)
- **6 portfolio items** per LP (same projects, different emphasis per LP)
- **Present in all 6 LPs**

### `#next` — What Happens Next (3-step process)
- **Present in:** renovation, under-construction, recent-possession, wardrobes, apartment (NOT kitchen)
- **3 circular numbered steps** with connecting gold line
- **Explains:** consultation → design → manufacture/install flow

### `#midform` — Mid-Page Second Form
- **Present in:** renovation, under-construction, recent-possession, wardrobes, apartment (NOT kitchen)
- **Identical form fields** to hero form (same field IDs)
- **2-column layout:** Left = text/headline, Right = form box with gold top border
- **Uses same `sub()` function** — `onsubmit="sub(event,'hform')"` (reuses hero form ID)
- **Known issue:** Both hero and mid-form have `id="hform"`. The `sub()` function targets `id` so whichever `hform` is referenced first in DOM will be used. Mid-form may not submit its own values correctly if it also references `f-*` IDs shared with the hero form — **this works because all field IDs are page-unique and not duplicated in the mid-form (the mid-form calls `sub(event,'hform')` which reads from the hero form's IDs).**

### `#faq` — FAQ Accordion
- **2-column layout:** Left = heading/eyebrow, Right = accordion items
- **Accordion:** Click `.faq-q` to toggle. Only one item open at a time.
- **5 FAQ items per LP**, content is kitchen/wardrobe/apartment-specific
- **Present in all 6 LPs**

### `#scarcity` — Scarcity Strip
- **Deep teal bar**, centred italic serif text
- **Content:** "Cabinets & Me crafts a **limited number of bespoke kitchens** each quarter..." (varies slightly per LP)
- **Present in all 6 LPs**

### `#studio` — Studio CTA Section
- **Full-width dark section** with teal gradient over studio image
- **Content:** Headline, body text, address, hours, 2 buttons (Book Consultation + Chat on WhatsApp)
- **Address:** No. 131, 7th Main Road, 4th Block, Jayanagar, Bengaluru 560011
- **Hours:** Mon–Sat · 10:30 am – 7:30 pm · Sunday Closed
- **WhatsApp link:** `wa.me/919164711696` with pre-filled message
- **Present in all 6 LPs**

### `footer` — Footer
- **3-column grid:** Brand column (logo + tagline) | Studio links | Contact info
- **Studio links:** External links to `cabinetsandme.com` (Kitchens, Wardrobes, Sideboards, Projects, Experience Centre)
- **Contact:** Phone `+91 91647 11696`, Email `info@cabinetsandme.com`, Address
- **Certifications:** LGA Certified | CATAS | FSC (bottom right)
- **Identical across all 6 LPs**

### `#stick` — Sticky Bottom Bar
- **Fixed bottom bar**, slides up when `scrollY > 65% of viewport height`
- **Content:** Italic serif "Ready to begin" text + phone number + WhatsApp circle button
- **WhatsApp button:** Circular, teal, animated hover lift effect
- **On mobile (≤768px):** Italic text hidden, phone + WA button displayed full-width

### `#toast` — Toast Notification
- **Fixed bottom-right notification**, slides in on form submit (never actually shown — JS fires `_showSuccess()` which redirects to thank-you before toast can appear). Appears to be legacy/unused.

---

## 6. CSS Documentation

**There are no external CSS files in this project.** All CSS is inline in `<style>` blocks within each HTML file.

### CSS Architecture

Every LP page has an identical CSS structure copy-pasted into its `<style>` block. The thank-you pages have a separate shared CSS pattern (also copy-pasted).

**CSS is 100% duplicated across all 6 LPs.** The same ~350 lines of CSS exist in every LP file.

### Design Tokens (`:root` variables)

Present identically in all 6 LP files and all 6 thank-you files:

```css
--teal:       #0D5F6B   /* Primary brand colour — teal green */
--teal-dark:  #094D57   /* Darker teal — hovers, footer bg */
--teal-deep:  #063540   /* Deepest teal — scarcity bar, TY countdown */
--teal-mid:   #1a7a88   /* Mid teal — italic em in headings */
--teal-light: #EAF4F6   /* Light teal tint */
--teal-xl:    #F4FAFB   /* Very light teal — input backgrounds, badges */
--gold:       #FFAF31   /* Primary accent — gold */
--gold-dark:  #D9911A   /* Darker gold — eyebrows, hover */
--white:      #FFFFFF
--off-white:  #FAFAFA   /* Section backgrounds */
--warm:       #F7F5F1   /* Warm off-white — portfolio, collections bg */
--border:     #E8E8E8   /* Light grey border */
--border-t:   rgba(13,95,107,.12)  /* Translucent teal border */
--text:       #1C1C1C   /* Primary body text */
--text-mid:   #555      /* Secondary text */
--text-light: #888      /* Muted text */
--serif:      'Cormorant Garamond', Georgia, serif
--sans:       'DM Sans', -apple-system, sans-serif
--shadow-sm:  0 2px 12px rgba(13,95,107,.06)
--shadow-md:  0 8px 40px rgba(13,95,107,.10)
--shadow-lg:  0 20px 60px rgba(13,95,107,.14)
```

### Key Utility Classes

| Class | Purpose |
|---|---|
| `.r` | Scroll-reveal element — starts hidden (opacity 0, translateY 24px), becomes `.in` on intersection |
| `.d1`–`.d5` | Transition delay helpers (0.08s increments) for staggered reveals |
| `.sec` | Section wrapper — `padding: 100px 52px` |
| `.sec-inner` | Content wrapper — `max-width: 1200px; margin: 0 auto` |
| `.sec-eyebrow` | Gold uppercase small text with gold line before it |
| `.sec-h2` | Section heading — serif, clamp font size |
| `.badge` | Small teal pill tag in hero |
| `.field` | Form field wrapper |
| `.submit-btn` | Full-width teal form submit button |
| `.btn-white` / `.btn-outline` | Studio section buttons |
| `.r.in` | Activated scroll-reveal state |

### Responsive Breakpoints

| Breakpoint | Changes |
|---|---|
| `≤1080px` | Hero stacks vertically. Nav links hidden (hamburger shown). Sections go to single column. Stats wrap to 3-column. |
| `≤768px` | Sticky bar text hidden. Phone + WA fill full width. |
| `≤680px` | Next-steps stack to single column. Portfolio goes full-width. |

**No tablet-specific breakpoint** — the `≤1080px` breakpoint serves both tablet and mobile.

### Thank-You Page CSS

Separate, self-contained CSS in each TY page. Uses same tokens. Key unique classes: `.ty-wrap`, `.ty-img`, `.ty-content`, `.ty-wa` (WhatsApp CTA card), `.ty-cd-icon`/`.ty-cd-num` (countdown animation).

TY pages have 2 `@keyframe` animations:
- `ty-cd-pulse` — pulses countdown number
- `ty-icon-glow` — glowing ring around WhatsApp icon

---

## 7. JavaScript Documentation

**No external JS files.** All JS is inline `<script>` blocks in each HTML file. Two external libraries loaded at bottom of LP pages only.

### External Libraries (loaded at bottom of LP pages)

```html
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://www.orbyo.com/orbyolean/resources/plugins/olApiV2.min.js"></script>
```

jQuery is loaded but **not used** in any custom code. It appears to be a dependency of the Orbyo `olApiV2` plugin.

### External Library (loaded in `<head>` of all pages)

```html
<script src="https://www.orbyo.com/resources/widgets/orbyoIntel.min.js"></script>
```

This pre-loads Orbyo intelligence tracking before the DOM. Required for lead attribution.

### Inline Script Blocks — LP Pages

**Block 1: Orbyo widget initialiser (immediately after `<body>` tag)**
```javascript
var widgetParams = {orbyo: 'CABINET'};
// Creates hidden iframe pointing to Orbyo widget
// Orbyo key is always 'CABINET'
```
This fires before anything else on every page. Creates a hidden 0×0 iframe that initialises Orbyo's tracking/attribution system.

**Block 2: Main inline script (before closing `</script>` at bottom)**

Contains the following functions:

#### URL Param + GCLID Initialiser (IIFE)
```javascript
(function(){
  var p = new URLSearchParams(window.location.search);
  var g = document.getElementById('f-gclid');   if(g) g.value = p.get('gclid') || '';
  var l = document.getElementById('f-pagelink'); if(l) l.value = window.location.href;
  var s = document.getElementById('f-utm-source'); if(s) s.value = p.get('utm_source') || '';
  var m = document.getElementById('f-utm-medium'); if(m) m.value = p.get('utm_medium') || '';
})();
```
Runs on page load. Reads URL params and populates hidden form fields.

#### Orbyo Token Pre-fetch
```javascript
var _cachedToken = null;
fetch('/api/getOrbyoToken').then(r=>r.json()).then(d=>{_cachedToken=d.token;}).catch(()=>{});
```
Pre-fetches the Orbyo OAuth token so it's ready when the form submits.

#### Scroll Reveal (IntersectionObserver)
```javascript
const io = new IntersectionObserver(...)
document.querySelectorAll('.r').forEach(el => io.observe(el));
// Hero elements revealed immediately via setTimeout(100ms)
```
Adds `.in` class to `.r` elements when they enter viewport (threshold: 10%).

#### Nav Scroll + Sticky Bar
```javascript
window.addEventListener('scroll', () => {
  navEl.classList.toggle('scrolled', scrollY > 60);
  stickEl.classList.toggle('on', scrollY > innerHeight * .65);
});
```

#### FAQ Accordion: `faq(btn)`
```javascript
function faq(btn) {
  // Closes all open items, opens clicked item (toggle)
}
```
Called inline: `onclick="faq(this)"`.

#### Phone Validation: `validatePhone(raw)`
```javascript
function validatePhone(raw) {
  // Strips spaces, hyphens, parentheses
  // Strips country code prefix (+91, 0091, 91+12digits, leading 0)
  // Validates: must be 10 digits starting with 6–9
}
```

#### Other Validators
- `validateName(v)` — min 2 chars after trim
- `validateSelect(v)` — non-empty value
- `validateEmail(v)` — optional; regex if filled

#### Error Display: `setErr(field, msg)` / `clrErr(field)`
Sets/clears `.has-err` class and shows/hides `.field-error` span.

#### Form Submit: `async function sub(e, id)`

The main form handler. Called by `onsubmit="sub(event,'hform')"`.

1. Prevents default
2. Validates: name, phone, email (optional), all required selects
3. On validation failure: focuses first errored field, returns
4. On success:
   - Disables button, shows "Sending…"
   - Fires `fbq('track', 'Lead')` (Meta Pixel)
   - Fires `gtag('event', 'generate_lead', ...)` (GA4)
   - Builds `custom_values` object (see Forms section)
   - Determines `_src` source phrase via IIFE on `_qp` (see WhatsApp Message Generation below)
   - Builds `_waMsg` — personalised message using first name + project wording + source phrase
   - If `orbyo` is defined: fetches token (uses cached or new), calls Orbyo API chain
   - Calls `_showSuccess()` which redirects to `thank-you?wa=<encoded-WA-url>`
   - If token fetch or Orbyo fails: still calls `_showSuccess()` (fail-safe)

#### Shared WhatsApp Message Generator

Three module-level functions are declared immediately after `_urlParams` in every LP script. They are identical across all 6 LP files.

**`detectSource(p)`** — takes a `URLSearchParams` object, returns one of four string tokens:

| Return value | Trigger |
|---|---|
| `'remarketing'` | `utm_medium` matches `display` or `remarketing` |
| `'meta'` | `fbclid` present OR `utm_source` contains `facebook`/`instagram`/`meta` |
| `'google'` | `gclid` present OR `utm_source` contains `google` |
| `'website'` | default / direct |

**`generateWhatsAppMessage(opts)`** — takes `{mode, project, firstName, source}`, returns a plain-text message string.

- `mode: 'visitor'` → source-specific opening sentence + project-specific prompt sentence. No name used.
- `mode: 'lead'` → greeting (with first name if available) + project-specific sentence + source-specific continuation + standard closing.

**Source sentences per mode:**

| Source | Visitor opening | Lead continuation |
|---|---|---|
| `google` | "Hello. I'm reaching out after discovering Cabinets & Me while exploring bespoke interior solutions online." | "I reached out after discovering Cabinets & Me while exploring bespoke interior solutions online." |
| `meta` | "Hello. I'm reaching out after coming across Cabinets & Me recently." | "I reached out after coming across Cabinets & Me recently." |
| `remarketing` | "Hello. I'm reaching out after seeing your work again — it felt like the right time to connect." | "I reached out after seeing your work again." |
| `website` | "Hello. I'm reaching out through your website and wanted to learn more about your work." | "I reached out through your website." |

**Team interpretation of source values:**

| Source Detected | Customer-facing phrase style | Team reads as |
|---|---|---|
| Display / Remarketing | "…seeing your work again…" | Retargeting |
| Meta | "…recently came across your work…" | Facebook / Instagram |
| Google Search | "…researching bespoke interior designers online…" | Google Search |
| Website | "…browsing your website…" | Direct / Organic |

**Project keys and their sentences:**

| LP | `project` key | Visitor sentence | Lead sentence |
|---|---|---|---|
| Kitchen | `kitchen` | "I'd love to know more about your bespoke villa kitchens." | "I've just submitted my enquiry for my bespoke villa kitchen." |
| Wardrobes | `wardrobes` | "I'd love to know more about your bespoke wardrobes." | "I've just submitted my enquiry for my bespoke wardrobes." |
| Renovation | `renovation` | "I'd love to know more about your villa renovation services." | "I've just submitted my enquiry regarding my villa renovation." |
| Under Construction | `underconstruction` | "I'd love to understand how we can begin planning the interiors before possession." | "I've just submitted my enquiry for my upcoming villa interiors." |
| Recent Possession | `recentpossession` | "I'd love to discuss designing the interiors for my newly handed-over villa." | "I've just submitted my enquiry for my newly handed-over villa." |
| Apartment | `apartment` | "I'd love to know more about your apartment interiors." | "I've just submitted my enquiry for my apartment interiors." |

**`buildWaUrl(msg)`** — wraps a plain-text message into a `https://wa.me/919164711696?text=...` URL.

**`_urlParams`** — module-level `URLSearchParams` parsed once on page load. Used by `detectSource()` and the page-load visitor IIFE. Inside `sub()`, `_qp` is aliased to `_urlParams` (no second parse).

**How each WA touchpoint calls the generator:**

| Touchpoint | Where | Call |
|---|---|---|
| Sticky bar button | Page-load IIFE at end of `<script>` | `generateWhatsAppMessage({mode:'visitor', project:'[key]', source:_s})` |
| Studio "Chat on WhatsApp" button | Same page-load IIFE | same |
| Form submission redirect | Inside `sub()` | `generateWhatsAppMessage({mode:'lead', project:'[key]', firstName:_fn, source:detectSource(_qp)})` |
| Thank-you page WA button | TY page JS reads `?wa=` param, sets `.ty-wa` href | Inherits LP-generated URL via `?wa=` |

Marketing terminology (Google Ads, Meta, UTM, GCLID, FBCLID, campaign names) is never exposed in any message.

#### Orbyo API Call Chain (inside `sub()`)
```javascript
orbyo.bl
  .withName(name)
  .withOrbyo('CABINET')
  .withMode('villa kitchen')   // varies per LP
  .withMobile(mobile)
  .withEmail(email)
  .withUserComment(f-extra value)
  .withCustomValues(custom_values)
  .submit(access_token, callback)
```

The `.withMode()` value varies:
- kitchen: `'villa kitchen'`
- wardrobes: `'villa wardrobes'` (Needs developer confirmation — check actual value)
- Others: Needs developer confirmation

### Inline Script Block — Thank-You Pages

Single IIFE that:
1. Reads `?wa=` URL param
2. If present: shows countdown div, starts `setInterval` (1 second)
3. After 3 seconds: redirects to WhatsApp URL

### Inline Script Block — `api/getOrbyoToken.js` (Vercel Serverless)

Serverless function exposed at `/api/getOrbyoToken`:
- POST to `https://www.orbyo.com/dev/internal/2.3/orbyo/oAuth/token`
- Credentials: `client_id: "15428"`, `client_secret: "ktiopma89nmzx8"`, `grant_type: "client_credentials"`
- Returns `{ token: access_token }` to client
- **Security note:** Client secret is hardcoded in the serverless function. It is server-side only (not in browser), which is acceptable.

---

## 8. Assets

### No local assets.** Everything is hosted externally on Wixstatic CDN.

### Base CDN URL
`https://static.wixstatic.com/media/e3b82d_[hash]~mv2.[ext]`

All images use `<picture>` with AVIF source + JPEG fallback, or inline `image-set()` in CSS.

### Key Images & Where Used

| Image Hash (short) | Description | Used In |
|---|---|---|
| `b4d5ab7c...` | Kitchen interior (grey island kitchen, 78 Beverly Hills) | Kitchen LP hero bg, Kitchen TY left panel, Under Construction TY |
| `6de519fbe...` | Kitchen detail close-up | Kitchen LP mosaic, Renovation visual break |
| `5deb0ba8...` | Nambiar Bellezea kitchen | Kitchen LP mosaic, various portfolios |
| `d941e44a...` | 78 Beverly Hills interior wider shot | Apartment LP hero bg, Recent Possession hero bg, Recent Possession TY, Apartment TY, various portfolio |
| `3478177b...` | Renovation/villa interior | Renovation LP hero bg, Renovation TY |
| `6e895bda...` | Wardrobe/closet image | Wardrobes LP hero bg, Wardrobes TY |
| `15351457...` | Under construction villa | Under Construction LP hero bg |
| `8ca0abdf...` | Interior room photo | Under Construction TY |
| `eec30b61...` | Studio/experience centre exterior | Studio section bg (all LPs) |
| `cac79375...` | Janapriya Residence kitchen | Portfolio |
| `0d6efa73...` | Mrigashira Residence | Portfolio |
| `ce879da8...` | Evantha Aristi | Portfolio, mosaic |
| `d2f6a199...` | Evantha Aristi detail | Kitchen mosaic |
| `5921d7d9...` | Cabinets & Me logo (PNG, transparent) | Nav + footer (all pages) + TY pages |
| `09bcd494...` | Buildofy logo | Press bar |
| `df21aae2...` | ArchDaily logo | Press bar |
| `158f2bf4...` | Building & Interior logo | Press bar |
| `cf7b491b...` | Love That Design logo | Press bar |
| `2c40d9ea...` | Architects Diary logo | Press bar |

### Fonts

Loaded from Google Fonts on all pages:
```
Cormorant Garamond: ital,wght @ 0,300; 0,400; 0,500; 0,600; 1,300; 1,400; 1,500
DM Sans: ital,opsz,wght @ 0,9..40,200; 0,9..40,300; 0,9..40,400; 0,9..40,500; 1,9..40,300
```

- **Cormorant Garamond** (`--serif`): Used for all headings (H1, H2, H3), form headings, stats numbers, quotes
- **DM Sans** (`--sans`): Used for body text, labels, nav, buttons, form inputs

### Icons

All icons are **inline SVG** directly in the HTML. No icon library. Icons used:
- WhatsApp SVG path (reused many times across all pages)
- Phone icon (sticky bar)
- Hamburger menu (3 horizontal lines)
- Custom SVG icons in materials section (grid, table, clock, house shapes)
- Custom dropdown arrow (data URI in CSS for `<select>` elements)

---

## 9. Forms

### Form Architecture

All 6 LPs have one primary hero form (`id="hform"`). Four LPs also have a secondary mid-page form that shares the same `id="hform"` and relies on the same field IDs — effectively it is a scroll-to-top visual variant, not a separate form.

### Common Fields (all 6 LPs)

| Field ID | Type | Label | Required | Validation |
|---|---|---|---|---|
| `f-name` | `text` | "Full Name" | Yes | min 2 chars |
| `f-mobile` | `tel` | "Mobile Number" | Yes | 10-digit Indian mobile (starts 6–9) |
| `f-email` | `email` | "Email Address" | No | regex if filled |
| `f-location` | `select` | Varies ("Villa Location" / "Apartment Location") | Yes | non-empty |
| `f-model` | `select` | Varies per LP (scope/type) | Yes | non-empty |
| `f-extra` | `select` | Varies per LP (budget/timeline/bedrooms) | Yes | non-empty |
| `f-gclid` | `hidden` | — | — | Set from `?gclid=` URL param |
| `f-pagelink` | `hidden` | — | — | Set to `window.location.href` |
| `f-utm-source` | `hidden` | — | — | Set from `?utm_source=` URL param |
| `f-utm-medium` | `hidden` | — | — | Set from `?utm_medium=` URL param |

### Location Options (identical across all LPs)
Whitefield / Sarjapur Road / Kanakapura Road / Hebbal / Yelahanka / JP Nagar / Bannerghatta / Electronic City / Koramangala / Indiranagar / Other Bengaluru / Outside Bengaluru

### Form Differences Per LP (3rd and 4th selects)

| LP | `f-model` Label | `f-model` Options | `f-extra` Label | `f-extra` Options |
|---|---|---|---|---|
| Kitchen | Kitchen Layout Preference | Open / Island / L-Shaped / U-Shaped / Not Sure | Approximate Budget | ₹8L–15L / ₹15L–30L / ₹30L+ / Quality |
| Wardrobes | Wardrobe Type | Walk-In / Fitted Swing / Fitted Sliding / Both / Not Sure | Bedrooms Needing Wardrobes | 1 / 2 / 3 / All |
| Renovation | What to Renovate | Full Villa / Kitchen Only / Wardrobes / Kitchen+Wardrobes / Specific Rooms | When to Start | Within 1mo / 1–3mo / 3–6mo |
| Under Construction | Expected Possession Timeline | Within 3mo / 3–6mo / 6–9mo / 9–12mo | Approximate Budget | ₹10L–20L / ₹20L–40L / ₹40L–75L / ₹75L+ / Quality |
| Recent Possession | What to Design | Full Villa / Kitchen / Wardrobes / Kitchen+Wardrobes / Specific Rooms | Approximate Budget | ₹10L–20L / ₹20L–40L / ₹40L–75L / ₹75L+ / Quality |
| Apartment | Apartment Scope | Full 3BHK / Luxury Duplex / Penthouse / Not Sure | Approximate Budget | ₹25L–40L / ₹40L–70L / ₹70L+ / Quality |

### Submission Flow

1. Client-side validation runs
2. `fbq('track', 'Lead')` fired
3. `gtag('event', 'generate_lead')` fired with `beacon` transport
4. `custom_values` object built:
   ```javascript
   {
     "model": f-model value,
     "location": f-location value,
     "service": f-extra value,
     "buying_time_frame": f-extra value,
     "gclid": f-gclid value,
     "page_link": f-pagelink value,
     "Source": f-utm-source value,          // note capital S
     "utm_medium": f-utm-medium value,
     "utm_campaign": URL param utm_campaign,
     "utm_content": URL param utm_content,
     "utm_term": URL param utm_term,
     "fbclid": URL param fbclid,
     "adset": URL param adset,
     "ad": URL param ad
   }
   ```
5. Orbyo token fetched from `/api/getOrbyoToken` (or uses cached `_cachedToken`)
6. `orbyo.bl` chain called with name, mobile, email, comment, custom_values
7. `_showSuccess()` called — redirects to `/[lp-path]/thank-you?wa=<encoded-WA-url>`

### API Endpoint
- Token endpoint: `POST /api/getOrbyoToken` (Vercel serverless)
- Orbyo lead endpoint: Called by `orbyo.bl.submit()` from the Orbyo JS library (internal to `olApiV2.min.js`)

### Error Handling
- If token fetch fails: form still redirects to thank-you (lead may not reach Orbyo)
- If `orbyo` object not defined: form still redirects to thank-you
- No error message is shown to user in either case

---

## 10. Navigation

### Header Navigation

| LP | Nav Links |
|---|---|
| Kitchen | Projects \| The Difference \| Materials \| Studio |
| Wardrobes | Projects \| Walk-In vs Fitted \| Features \| Studio |
| Renovation | Projects \| What We Redesign \| FAQs \| Studio |
| Under Construction | Projects \| Why Plan Ahead \| FAQs \| Studio |
| Recent Possession | Projects \| Process \| FAQs \| Studio |
| Apartment | Projects \| Process \| FAQs \| Studio |

All nav links are in-page anchors (`#portfolio`, `#standard`, `#materials`, `#process`, `#faq`, `#studio`, `#villas`).

### Footer Navigation

Footer links point to the **main Cabinets & Me website** at `cabinetsandme.com`:
- `/kitchens`, `/wardrobes`, `/sideboards`, `/projects`, `/display-kitchen-experience-centre-in-jayanagar-bengaluru`

These are external links (`target="_blank"`).

### Internal Linking
- No LP links to any other LP
- Nav CTA buttons scroll to `#hform` (hero form)
- Footer links go to main site
- Thank-you pages have no navigation back to LP

### Missing / Broken Links
- **Hamburger menu has no JS** — clicking it does nothing on mobile
- **No "back" link** from thank-you pages to the LP they came from
- **"Explore All Projects" link** in mosaic strip (`href="#portfolio"`) works as in-page anchor

---

## 11. Responsive Behaviour

### Desktop (>1080px)
- Hero: 2-column (content left, form right — `1fr 440px`)
- Stats: 5 columns
- Panels: 2×2 grid
- Mosaic: 60/40 split with 2-row right column
- Sections: `padding: 100px 52px`

### Tablet / Mobile (≤1080px)
- Hero: Single column, stacks vertically (form below content)
- Form: Gets `border-top: 4px solid gold` instead of left border, adds `border-radius: 16px`, floats with margin
- Nav links: Hidden; hamburger shown (but non-functional)
- Stats: 3-column (4th stat indented to column 2)
- Panels: Single column stack
- Mosaic: Stacked vertically
- Section padding: `72px 24px`
- Collections: Single column
- Testimonials: Single column
- Portfolio: 2-column

### Mobile (≤768px)
- Sticky bar: Hides italic text, phone + WhatsApp fill full width

### Mobile (≤680px)
- Portfolio: Single column (wide item returns to 1 column)
- Next-steps: Single column

### Thank-You Page Responsive
- `≤860px`: Stacks vertically — image panel (46vh) on top, content below
- `≤480px`: Heading and quote font sizes reduce

---

## 12. SEO

### Meta Tags

| Page | `<title>` | `<meta description>` | robots |
|---|---|---|---|
| index | "Cabinets & Me — Villa Landing Pages" | None | noindex, nofollow |
| Kitchen LP | "Bespoke Luxury Kitchens for Bengaluru Villas — Cabinets & Me" | Yes | Not set (indexable) |
| Wardrobes LP | "Bespoke Walk-In Wardrobes for Bengaluru Villas — Cabinets & Me" | Yes | Not set |
| Renovation LP | "Villa Interior Renovation, Bengaluru — Cabinets & Me" | Yes | Not set |
| Under Construction LP | "Plan Your Villa Interiors Before Possession — Cabinets & Me" | Yes | Not set |
| Recent Possession LP | "Bespoke Villa Interiors, Bengaluru — Cabinets & Me" | Yes | Not set |
| Apartment LP | "Bespoke Turnkey Interiors for Bengaluru Apartments — Cabinets & Me" | Yes | Not set |
| All TY pages | "Thank You — Cabinets & Me" | None | noindex, nofollow |

### Missing SEO Elements
- No canonical tags on any page
- No Open Graph tags on any page
- No Twitter Card tags
- No Schema/structured data markup
- No sitemap.xml
- No robots.txt
- No favicon
- All LPs are indexable (no robots meta) but these are paid-traffic pages — intentional or oversight: **Needs developer confirmation**

### Heading Hierarchy
- All LP pages: `<h1>` in hero (one per page) ✓
- H2s used for section headings (`.sec-h2`) ✓
- H3s used for panel headings ✓
- Thank-you pages: `<h1>` "Thank You for Submitting Your Details" ✓

### Image Alt Tags
- Logo: `alt="Cabinets & Me"` ✓
- Press logos: Named (e.g., `alt="Buildofy"`) ✓
- Portfolio images: Named (e.g., `alt="78 Beverly Hills — Kitchen"`) ✓
- Hero background: No alt (CSS background, not `<img>`) — acceptable
- Mosaic images: Have alt text ✓

---

## 13. Reusable Components

These are copy-pasted blocks (not templated) that appear identically across multiple files:

| Component | Appears In | Notes |
|---|---|---|
| Orbyo widget initialiser | All 13 pages | Identical block |
| GA4 script | All 13 pages | Identical |
| Meta Pixel script | All 13 pages | Identical |
| Google Fonts `<link>` | All 13 pages | Identical |
| CSS `:root` tokens | All 13 pages | Identical |
| CSS reset + body | All 13 pages | Identical |
| `nav` HTML | All 6 LPs | Nav links differ per LP |
| Press bar (`#press`) | All 6 LPs | Identical |
| Footer | All 6 LPs | Identical |
| Sticky bar (`#stick`) | All 6 LPs | Identical |
| `#testimonials` section | All 6 LPs | Identical content |
| `#scarcity` strip | All 6 LPs | Near-identical |
| `#studio` section | All 6 LPs | Near-identical |
| `sub()` function | All 6 LPs | Identical logic, `.withMode()` may differ |
| `validatePhone()` etc | All 6 LPs | Identical |
| TY page layout + JS | All 6 TY pages | WA message and bg image differ |

---

## 14. Editable Content

### Change Phone Number
- File: All 6 LP `index.html` files + all 6 `thank-you/index.html` files
- Search for: `919164711696` (used in `wa.me` links and `href="tel:..."`)
- Also appears in footer `<a href="tel:...">` and sticky bar phone link
- **Count:** Appears ~4 times per LP page, ~1 time per TY page

### Change Email
- File: All 6 LP `index.html` files
- Search for: `info@cabinetsandme.com`
- Location: Footer contact column

### Change Studio Address / Hours
- File: All 6 LP `index.html` files
- Location: `#studio` section (`.studio-addr` and `.studio-hrs` elements) + footer contact column
- Current address: No. 131, 7th Main Road, 4th Block, Jayanagar, Bengaluru 560011
- Current hours: Mon–Sat · 10:30 am – 7:30 pm · Sunday Closed

### Change Hero Headline
- File: Specific LP `index.html`
- Location: `<h1 class="hero-title">` inside `#hero > .hero-left`

### Change Hero Subheadline
- File: Specific LP `index.html`
- Location: `<p class="hero-sub">` inside `#hero > .hero-left`

### Change Form Heading
- File: Specific LP `index.html`
- Location: `<div class="form-heading">` inside `.hero-form`

### Change Submit Button Text
- File: Specific LP `index.html`
- Location: `<button type="submit" class="submit-btn">`

### Change Nav CTA Button Text
- File: Specific LP `index.html`
- Location: `<button class="nav-cta">`

### Change Hero Badges
- File: Specific LP `index.html`
- Location: `<div class="hero-badges">` — add/remove/edit `<span class="badge">` elements

### Change Hero Background Image
- File: Specific LP `index.html`
- Location: Inline style on `<div class="hero-bg">` — replace Wixstatic URL in `image-set(...)`

### Change Form Dropdown Options
- File: Specific LP `index.html`
- Location: `<select id="f-model">` and `<select id="f-extra">` inside `#hform`

### Change Testimonials
- File: All LP `index.html` files (duplicated)
- Location: `#testimonials` section, `.testi-card` elements
- **Note:** Must update in all 6 files since it's copy-pasted

### Change Portfolio Images / Captions
- File: Specific LP `index.html`
- Location: `#portfolio > .sec-inner > .port-grid` — each `.port-item`

### Change Stats Numbers
- File: Specific LP `index.html`
- Location: `<div class="std-stats"> > .stats-row` — `.sstat-n` elements

### Change Logo
- File: All pages — search for the Wixstatic URL containing `Cabinets-and-Me-logo-NO-Background.png`
- Appears in: nav + footer of each LP, and logo wrap of each TY page

### Change WhatsApp Pre-filled Message
- LP pages: Inside `sub()` function — edit `_waMsg` template string (project wording is the LP-specific phrase in the `+' I\'ve just submitted my enquiry for ... '` line). Source phrases are in the `_src` IIFE above it.
- TY pages: Inside `href="https://wa.me/..."` on `.ty-wa` anchor (these are static fallback messages shown if user clicks the WA button manually rather than via the auto-redirect)

### Change Orbyo CRM Credentials
- File: `api/getOrbyoToken.js`
- Variables: `client_id`, `client_secret`
- Also: `orbyo: 'CABINET'` key used in widget init and `withOrbyo('CABINET')` in form submit

### Change GA4 Measurement ID
- Search for: `G-ETE07PL3RP`
- Appears in: All 13 HTML files (in `<head>`)

### Change Meta Pixel ID
- Search for: `1422274186613862`
- Appears in: All 13 HTML files

---

## 15. Dependencies Between Files

### HTML → External Scripts
Every LP page depends on (in order of loading):
1. `https://www.googletagmanager.com/gtag/js?id=G-ETE07PL3RP` (GA4)
2. `https://www.orbyo.com/resources/widgets/orbyoIntel.min.js` (Orbyo Intel)
3. `https://fonts.googleapis.com/css2?...` (Cormorant Garamond + DM Sans)
4. Meta Pixel script (inline, loads from `connect.facebook.net`)
5. `https://code.jquery.com/jquery-3.7.1.min.js` (jQuery — at bottom)
6. `https://www.orbyo.com/orbyolean/resources/plugins/olApiV2.min.js` (Orbyo API — at bottom)

### HTML → Serverless API
- All LP form submissions → `POST /api/getOrbyoToken` → Orbyo OAuth endpoint
- The serverless function at `api/getOrbyoToken.js` must be deployed alongside the static files

### HTML → Images (CDN)
- All images are hosted at `static.wixstatic.com`
- If Wixstatic CDN goes down, all images across all pages break
- No local fallback images

### HTML → Fonts (CDN)
- Both fonts loaded from Google Fonts CDN
- If Google Fonts is unavailable, falls back to Georgia (serif) and system sans-serif

### Thank-You Pages
- Receive `?wa=<encoded-url>` param from LP redirect
- If param missing, countdown is hidden and WA redirect doesn't fire (page still shows static TY content)

### No file imports any other local file.** Every LP is completely self-contained.

---

## 16. Known Issues

### Critical
1. **Hamburger menu non-functional** — The `.mob-btn` button has no JS event listener. Clicking it on mobile does nothing. Nav links remain inaccessible on mobile.

### Form/CRM
2. **Mid-form submits hero form data** — The mid-page form calls `sub(event, 'hform')` which reads field IDs from the hero form. If a user fills the mid-form without filling the hero form, they'll get validation errors on blank hero fields. This is by design (single form per page) but could confuse users who scroll past the hero.
3. **No user-facing error on Orbyo failure** — If the lead fails to post to Orbyo, the user is still redirected to the thank-you page and never knows. Leads can be silently lost.
4. **Toast notification appears unused** — The `#toast` element is styled and ready but `_showSuccess()` immediately redirects before the toast can display.

### SEO / Technical
5. **No canonical tags** — LPs could be indexed or treated as duplicates
6. **No OG/Twitter meta tags** — If links are shared on social media, no preview card appears
7. **No sitemap or robots.txt** — Search engines have no guidance
8. **No favicon** — Browser tab shows blank icon on all pages
9. **LPs are crawlable** — Paid-traffic LPs have no `noindex` directive. May or may not be intentional.

### Code Quality
10. **Massive CSS duplication** — The entire CSS block (~350 lines) is copy-pasted across all 6 LP files. Any design change must be replicated 6 times manually.
11. **JavaScript duplication** — All JS (~180 lines) is copy-pasted across all 6 LP files. Same risk.
12. **jQuery loaded but unused** — Adds ~90KB for no benefit. Likely a legacy dependency of Orbyo's `olApiV2`.
13. **`--teal-light: #EAF4F6` defined in tokens but `--teal-xl: #F4FAFB` is used everywhere** — `--teal-light` appears unused in practice.

### Images
14. **Two LPs share the same hero background image** — `lp-villa-recent-possession` and `lp-apartment-owners` both use `e3b82d_d941e44ab97e423ca07a205b5e9a4e41~mv2.jpg`. If these are ever shown side by side in an ad campaign they'll look identical.
15. **All images on Wixstatic CDN** — External dependency. No control over availability or AVIF support.

### Accessibility
16. **No `lang` attribute issue** — `lang="en"` is correctly set ✓
17. **Form labels use `.field label` not `<label for="...">` association** — Labels are visually above inputs but are `<label>` elements without `for` attributes, so screen reader association depends on DOM proximity
18. **Hamburger button has `aria-label="Menu"` but no open/close state** — Non-functional, so this is moot
19. **Colour contrast** — Teal (#0D5F6B) on white passes WCAG AA. Gold (#FFAF31) on white may not pass for small text.

---

## 17. Future Development Guide

### Adding a New Landing Page

1. **Copy** an existing LP folder that's most similar to your new segment (e.g., `cp -r lp-villa-recent-possession lp-new-segment`)
2. **Update** in the new `index.html`:
   - `<title>` and `<meta name="description">`
   - Hero H1, subheadline, eyebrow, badges
   - Form heading, CTA button text
   - Nav links (update anchor targets if adding/removing sections)
   - Nav CTA text
   - `f-model` and `f-extra` select options and labels
   - Dynamic WhatsApp message generation (`_waMsg`) and the project wording/source phrase mappings inside `sub()`
   - `.withMode('your-mode')` in the Orbyo submit chain
   - Hero background image URL (`.hero-bg` inline style)
   - Mosaic images and captions
   - Studio section quotes/CTAs if needed
3. **Create** `lp-new-segment/thank-you/index.html`:
   - Copy an existing TY page
   - Update: background image URL (`.ty-img-bg`), italic quote on image, WA message in `.ty-wa href`, `.ty-eyebrow` confirmation text
4. **Add link** to `index.html` internal nav list
5. **Test:** Load page with `?utm_source=test&utm_medium=cpc&gclid=test` and submit form. Check Orbyo receives the lead.

### Duplicating an Existing Page

Same as above — just copy the folder.

### Replacing Images

1. Upload new image to Wixstatic (via Wix account) or any CDN
2. Get the direct image URL
3. In the HTML: replace the Wixstatic URL in:
   - `<div class="hero-bg">` inline style (update both AVIF and JPEG sources in `image-set()`)
   - `<picture>` elements — update `srcset` (AVIF source) and `src` (JPEG fallback)
   - For TY pages: update `.ty-img-bg` background in `<style>` block

### Updating Text Content

All text is inline in HTML. Find it by searching for the current text string in the file and replacing it.

### Adding a New Form Field

1. Add the `<div class="field">` HTML with label + input/select to the form
2. If it needs to go to Orbyo: add it to the `custom_values` object in `sub()`
3. If it should be tracked from URL: add a hidden `<input type="hidden" id="f-fieldname">` and read it in the URL param IIFE
4. Add validation logic in `sub()` if needed
5. Replicate the change across all LPs that need it

### Adding Tracking Scripts

1. **GA4 events:** Add `gtag('event', 'event_name', {...})` calls where needed in `sub()` or inline handlers
2. **Meta Pixel events:** Add `fbq('track', 'EventName')` calls
3. **New third-party script:** Add `<script>` tag in `<head>` (before-render analytics) or before `</body>` (after-render)
4. Replicate in all LP files

### Maintaining Consistent Styling

1. All styles are in the `<style>` block of each HTML file
2. Use CSS variables (`:root` tokens) — never hardcode colours
3. When adding a new section: add its CSS in the appropriate position in the `<style>` block
4. Copy the change to all 6 LP files if it's a shared component
5. Follow existing naming conventions: section IDs are lowercase (e.g., `#newsection`), component classes use BEM-adjacent kebab-case (e.g., `.comp-title`, `.comp-body`)

---

## 18. AI Prompting Guide

Instructions for any AI assistant working on this project:

### Before Starting Any Task
1. **Read `KT.md` first.** Do not explore the codebase by reading every file — this document is the source of truth.
2. **Identify which files need changing.** The KT lists what's in each file. Only open a file if you need to edit it.
3. **Check if a change is shared or page-specific.** Shared components (footer, testimonials, CSS tokens, JS functions) need updating in all 6 LP files.

### CSS Rules
- Always use existing CSS variables from `:root` — never hardcode `#0D5F6B` or other colours
- Do not add a new CSS class if an existing one can be extended or reused
- Add new CSS to the correct position in the `<style>` block (grouped with similar components)
- If a CSS change is global, copy it to all 6 LP files

### JavaScript Rules
- The `sub()` function is the critical form handler — test changes carefully
- Never modify `validatePhone()` without understanding the Indian mobile number rules it implements
- The Orbyo submit chain follows a specific fluent API — do not alter the order of `.with*()` calls
- Never remove the `_showSuccess()` fallback — it ensures users always reach the thank-you page

### HTML Rules
- Do not change field IDs (`f-name`, `f-mobile`, etc.) — they are referenced by name in JS
- Do not change `id="hform"` — it is referenced in both `sub(event,'hform')` and all scroll-to-form CTAs
- When adding `<picture>` elements, always include both AVIF source and JPEG fallback
- Always use `loading="lazy"` on below-fold images

### General
- Branding: teal (`--teal`) is primary. Gold (`--gold`) is accent. Cormorant Garamond for display type. DM Sans for body.
- Tone: luxury, considered, understated — not salesy. No exclamation marks in headings.
- Do not introduce new external dependencies (no new CDN scripts, no new fonts)
- Do not add npm, build tools, or a bundler — this is a vanilla HTML project
- The only backend is the single serverless function. Keep it that way.

---

## 19. Quick Reference

| Need to... | File | Location |
|---|---|---|
| Edit hero headline | `lp-[name]/index.html` | `<h1 class="hero-title">` in `#hero .hero-left` |
| Edit hero subheadline | `lp-[name]/index.html` | `<p class="hero-sub">` in `#hero .hero-left` |
| Edit form heading | `lp-[name]/index.html` | `<div class="form-heading">` in `.hero-form` |
| Edit form dropdown options | `lp-[name]/index.html` | `<select id="f-model">` and `<select id="f-extra">` |
| Edit form submit button text | `lp-[name]/index.html` | `<button type="submit" class="submit-btn">` |
| Edit nav CTA text | `lp-[name]/index.html` | `<button class="nav-cta">` |
| Edit nav links | `lp-[name]/index.html` | `<ul class="nav-links">` |
| Edit footer | All 6 LP `index.html` | `<footer>` element |
| Edit testimonials | All 6 LP `index.html` | `#testimonials .testi-card` elements |
| Edit studio address/hours | All 6 LP `index.html` | `#studio .studio-addr` and `.studio-hrs` |
| Edit phone number | All pages | Search `919164711696` |
| Edit email address | All 6 LP `index.html` | Footer contact column |
| Edit brand logo | All pages | Search for `Cabinets-and-Me-logo-NO-Background.png` |
| Edit hero background image | `lp-[name]/index.html` | Inline style on `<div class="hero-bg">` |
| Edit CSS tokens (colours, fonts) | All LP `index.html` | `:root { ... }` in `<style>` |
| Edit responsive breakpoints | All LP `index.html` | `@media` blocks at bottom of `<style>` |
| Edit form submission logic | All LP `index.html` | `async function sub(e, id)` in `<script>` |
| Edit Orbyo credentials | `api/getOrbyoToken.js` | `clientDetails` object |
| Edit GA4 tracking ID | All pages | `G-ETE07PL3RP` in `<head>` |
| Edit Meta Pixel ID | All pages | `1422274186613862` in `<head>` |
| Edit WhatsApp message (LP) | `lp-[name]/index.html` | `sub()` function → edit `_waMsg` template, project wording and `_src` source phrase mapping |
| Edit WhatsApp message (TY) | `lp-[name]/thank-you/index.html` | `href` on `.ty-wa` anchor |
| Edit thank-you page quote | `lp-[name]/thank-you/index.html` | `.ty-img-quote` inside `.ty-img-footer` |
| Edit thank-you background image | `lp-[name]/thank-you/index.html` | `.ty-img-bg` background in `<style>` |
| Change scarcity strip text | All 6 LP `index.html` | `#scarcity .scarcity-text` |
| Add a new URL param to tracking | All 6 LP `index.html` | URL param IIFE + `custom_values` object in `sub()` |
| View all LP URLs | `index.html` | Root index page (internal only) |
| Check Vercel routing config | `vercel.json` | Root directory |

---

*End of KT.md*
