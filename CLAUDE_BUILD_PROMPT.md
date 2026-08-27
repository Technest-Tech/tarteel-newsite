# Full build prompt for Claude — Tarteel Academy

You are a senior Laravel engineer and award-winning bilingual product designer. Build a complete, production-ready website for **Tarteel Academy / أكاديمية ترتيل**, an online academy teaching Quran and Arabic to children and adults worldwide.

Do not return a mockup or an explanation only. Inspect the repository, implement the full application, test it, and leave it ready to upload to a Hostinger shared-hosting account.

## 1. Technology and hosting constraints

- Backend: Laravel, using the version already installed in the repository. If starting from an empty repository, use the newest stable Laravel version compatible with PHP 8.2+ and typical Hostinger shared hosting.
- Views: server-rendered Blade templates.
- Database: MySQL/MariaDB in production; SQLite may be used only for local automated tests.
- Frontend: Blade, semantic HTML, modern CSS, and lightweight vanilla JavaScript. Alpine.js is acceptable only if it materially simplifies interaction.
- Build all frontend assets before deployment. The production site must not require a Node server.
- Do not use React, Vue, Inertia, Livewire, a page builder, or a paid dependency.
- Keep the public marketing experience on **one page** at `/`. The admin panel may have its own protected routes.
- Make the code straightforward to deploy in a subdomain or domain whose document root points to Laravel's `public` directory.

## 2. Supplied brand media

Use the provided files; do not replace them with generic stock media:

- `media/tarteel-academy-logo.png` — original academy logo.
- `media/hero-quran-online-modest.webp` — optimized hero image.
- `media/hero-quran-online-modest.png` — high-quality fallback/original.
- `media/quran-arabic-study-flatlay.webp` — optimized supporting image.
- `media/quran-arabic-study-flatlay.png` — high-quality fallback/original.

Copy the needed production assets into `public/images/` with clear file names. Use `<picture>` with WebP first and PNG fallback. Add useful Arabic and English alt text. Preserve image aspect ratios and do not stretch the media.

Important religious/cultural constraint: the girl's hair, hairline, ears, neck, and upper chest are properly covered by her hijab in the corrected hero image. Do not crop or edit it in a way that weakens that modest presentation. Use the hero's large empty area on the left for text in LTR layouts; mirror the overall composition thoughtfully for RTL without covering the student, Quran, or teacher.

## 3. Visual direction

Create a genuinely modern, premium education brand—not a generic template and not an over-decorated “Islamic” theme.

Design qualities:

- Calm, warm, trustworthy, refined, human, and family-friendly.
- Generous whitespace, strong editorial typography, large headings, soft rounded cards, thin borders, subtle shadows, excellent rhythm, and restrained motion.
- Avoid excessive gradients, glassmorphism everywhere, neon colors, random mosque silhouettes, crescent clichés, animated particles, or dense ornament.
- Use subtle geometric Islamic patterns only as low-opacity background texture made with CSS.
- The main palette should be derived from the logo:
  - Deep forest: `#123D2C`
  - Dark forest: `#0B2A1E`
  - Fresh leaf green: `#69BD45`
  - Warm ivory: `#FFFDF8`
  - Soft cream: `#F7F4EB`
  - Muted gold accent: `#BD955A`
  - Main ink: `#17312A`
  - Muted copy: `#63716B`
- Arabic font: `Noto Kufi Arabic` or a similarly clean, highly readable Arabic web font.
- English font: `DM Sans` or a similarly modern humanist sans serif.
- Use CSS logical properties (`margin-inline`, `padding-inline`, `inset-inline`) so RTL is first-class.
- Meet WCAG AA contrast. Make keyboard focus states clear.
- Respect `prefers-reduced-motion`.

## 4. Bilingual behavior

The entire public page must work in Arabic and English.

- Default to Arabic on the first visit: `<html lang="ar" dir="rtl">`.
- Add a clear AR/EN language toggle in the header and footer.
- Changing language must happen instantly on the same page without a full reload.
- Update `lang`, `dir`, all navigation, headings, body copy, buttons, field labels, placeholders, select options, validation summaries, success messages, FAQ content, and image alt text.
- Save the chosen language in `localStorage` and restore it on the next visit.
- Do not show both translations at the same time.
- Do not use machine translation at runtime. Store reviewed Arabic and English copy in Blade translation files or a clean JavaScript/JSON translation object.
- Ensure numbers, phone fields, email addresses, and Latin brand text remain readable in RTL.

## 5. Public one-page structure

Build these sections in this order:

### A. Slim announcement bar

- Arabic: `التسجيل مفتوح الآن — احجز حصتك التجريبية المجانية`
- English: `Enrollment is now open — book your free trial lesson`
- Small CTA scrolls to the enrollment form.

### B. Sticky header

- Logo and academy name.
- Anchor links: Programs, Why Tarteel, How it works, Stories, FAQ.
- AR/EN toggle.
- Primary CTA: `احجز حصة مجانية` / `Book a free trial`.
- Responsive mobile menu with correct `aria-expanded` state and keyboard behavior.

### C. Hero

- Use the corrected modest hero image.
- Arabic eyebrow: `تعليم متقن · أثر يدوم`
- English eyebrow: `Meaningful learning · Lasting impact`
- Arabic headline: `رتّل بثقة، وتعلّم بحُب.`
- English headline: `Learn with heart. Grow with purpose.`
- Arabic body: `رحلة تعليمية شخصية في القرآن الكريم واللغة العربية، مع معلمين مؤهلين يهتمون بتقدّمك خطوة بخطوة.`
- English body: `A personal journey through Quran and Arabic with qualified teachers who care about your progress, one beautiful step at a time.`
- Primary CTA scrolls to enrollment.
- Secondary CTA scrolls to programs.
- Include restrained trust signals such as a 4.9/5 rating, flexible schedules, and carefully selected teachers. Do not claim accreditation unless it is supplied.

### D. Trust/statistics strip

Use editable values, visually separated:

- `500+` students
- `35+` teachers
- `20+` countries
- `98%` parent satisfaction

Mark these as easy-to-edit content constants. Do not query fake live data.

### E. Programs

Create three premium cards:

1. Quran Reading & Tajweed / تلاوة القرآن وتجويده
2. Quran Memorization & Revision / حفظ القرآن ومراجعته
3. Arabic Language / اللغة العربية

Each card needs concise Arabic and English copy, two practical attributes, and a CTA that scrolls to the enrollment form and preselects the matching program. Mention live one-to-one lessons where relevant. Include both children and adults without making the visual treatment childish.

### F. Why Tarteel

Use a deep forest section with four feature cards:

- Truly personal / تعليم فردي
- Teachers we trust / معلمون نثق بهم
- Real flexibility / مرونة حقيقية
- Progress you can see / تقدّم واضح

Use the supporting flat-lay image as an editorial accent in this part of the page or immediately beside it. Keep the Quran visible and respectfully framed.

### G. How it works

Three connected steps:

1. Tell us your goal / أخبرنا عن هدفك
2. Enjoy a free trial / جرّب حصتك المجانية
3. Begin your own path / ابدأ مسارك الخاص

### H. Testimonials

Create three polished testimonial cards with realistic placeholder content in Arabic and English. Clearly keep testimonial data in an easily editable array/config. Use initials, not AI-generated face photos. Add `4.9` as a visual review summary, but do not add a fake external review-platform logo.

### I. FAQ

Accessible `<details>` accordions for:

- Is the trial really free?
- Do you teach children and complete beginners?
- Which languages do teachers use?
- Can schedules be changed later?

Write clear, reassuring answers in Arabic and English.

### J. Enrollment section

Use a strong dark-green background with a white form card. Explain that the team will respond within 24 hours. The form submits to Laravel, stores the request in the database, shows bilingual validation, and preserves old values after errors.

Required form fields:

- Full name: required, string, max 120.
- Email: required, valid email, max 180.
- Phone/WhatsApp: required, string, max 40.
- Country: optional, string, max 100.
- Student type: required, enum `child|adult`.
- Age: optional, integer, 4–100.
- Program: required, enum `quran|tajweed|memorization|arabic`.
- Preferred support language: required, enum `arabic|english|both`.
- Preferred days/times: optional, max 120.
- Message/current level: optional, max 1500.
- Source locale: `ar|en`.

Requirements:

- CSRF protection.
- Server-side validation is authoritative.
- Rate limit submissions, e.g. 5 per minute per IP.
- Do not expose stack traces or raw database errors.
- Show a friendly inline success panel after save, in the language used for submission.
- After an error or success, return to the form section.
- Add a hidden honeypot or another lightweight anti-spam technique without harming accessibility.
- Do not collect unnecessary sensitive information.

### K. Footer

- Logo, short bilingual mission statement, anchor links, contact email placeholder, language toggle, copyright.
- Include an unobtrusive Admin link only if desired; `/admin/login` may otherwise be accessed directly.

## 6. Enrollment data model

Create an `Enrollment` model and migration with:

- `id`
- `name`
- `email`
- `phone`
- `country` nullable
- `student_type`
- `age` nullable
- `program`
- `preferred_language`
- `availability` nullable
- `message` nullable text
- `status` indexed, default `new`, allowed: `new|contacted|enrolled|closed`
- `source_locale`, default `ar`
- timestamps

Use mass-assignment protection correctly. Keep labels for enum values in a translation/config mapping, not scattered conditionals.

## 7. Small authenticated control panel

Create a clean, responsive admin area under `/admin` using Laravel session authentication.

Authentication:

- Login at `/admin/login` with email and password.
- No public registration route.
- Protect all admin enrollment routes with `auth` middleware.
- Regenerate the session on login and invalidate it on logout.
- Rate limit login attempts.
- Admin user is created by a seeder using `ADMIN_NAME`, `ADMIN_EMAIL`, and `ADMIN_PASSWORD` from `.env`.
- Never hard-code a production password or display it in a view.

Dashboard at `/admin/enrollments`:

- Summary cards: total, new, contacted, enrolled.
- Latest-first paginated enrollment table.
- Columns: name/contact, program, student type/age, country, submission date, status, view action.
- Search by name, email, phone, and country.
- Filter by status.
- Empty states and preserved filter query parameters during pagination.
- CSV export with UTF-8 BOM so Arabic opens correctly in Excel.

Enrollment detail page:

- Show every submitted field clearly.
- Clickable `mailto:` and `tel:` contact actions.
- Status update form with the four allowed statuses.
- Display created and updated timestamps.
- Do not implement deletion unless explicitly requested.

Admin design should share the public brand palette but prioritize density and clarity. It must work on mobile and desktop.

## 8. SEO, performance, and accessibility

- Unique bilingual-friendly title and description.
- Correct canonical URL from `APP_URL`.
- Open Graph and X metadata using the corrected hero image.
- Add Organization/EducationalOrganization JSON-LD using only known data; use placeholders for phone/address/social URLs rather than inventing facts.
- Use semantic section headings in correct order.
- All controls have labels, focus styles, and sufficient touch targets.
- Lazy-load below-the-fold images; do not lazy-load the hero. Add explicit width/height to prevent layout shift.
- Use the supplied WebP files and PNG fallback.
- Keep JavaScript small and defer it.
- Target good Core Web Vitals and no horizontal overflow at 320px.

## 9. Tests

Add feature tests for at least:

- Home page loads.
- Valid enrollment submission creates one database row.
- Invalid enrollment is rejected.
- Guest cannot access admin enrollment routes.
- Admin can log in and see enrollment list.
- Admin can change enrollment status.
- CSV export requires authentication and returns a CSV response.

Run the test suite and production asset build. Fix all failures before stopping.

## 10. Hostinger handoff

Create a concise `DEPLOYMENT.md` covering:

1. Required PHP version and extensions.
2. Creating the Hostinger MySQL database/user.
3. Production `.env` values (`APP_ENV=production`, `APP_DEBUG=false`, `APP_URL`, DB credentials, mail placeholders, admin seeder variables).
4. Running `composer install --no-dev --optimize-autoloader`.
5. Running migrations and the admin seeder safely.
6. Building assets locally and uploading `public/build` if Node is unavailable on the server.
7. Pointing the domain document root to `/public`; if Hostinger cannot change it, document a safe public-folder relocation strategy without exposing `.env`, `vendor`, `storage`, or source files.
8. Storage/cache permissions.
9. `php artisan optimize` and how to clear caches after future changes.
10. How to change the admin password safely.

Also include `.env.example` entries for the admin account and any application contact details used in the page.

## 11. Definition of done

The task is complete only when:

- The Arabic and English landing page is polished and responsive.
- Every public section is on the single home page.
- Language switching is complete and persists.
- The enrollment form saves real database records.
- The admin login, dashboard, search, filter, detail, status update, pagination, logout, and CSV export work.
- Validation, CSRF, rate limits, and authentication are in place.
- The supplied corrected media is used efficiently and respectfully.
- Automated tests pass.
- Production assets compile.
- `DEPLOYMENT.md` makes the app deployable to Hostinger shared hosting.

When finished, report the implemented routes, the exact commands used to test/build, any placeholders I still need to replace, and the default local-only seeded admin email—but never print the admin password.

---

## Image generation prompts used for the media kit

### Corrected hero image

```text
Use case: precise-object-edit
Asset type: Tarteel Academy website hero image
Input image: edit target, preserve the full scene and composition
Primary request: adjust only the young Muslim girl's head covering so it becomes a proper modest hijab that fully and naturally covers every visible strand of hair, the complete hairline, neck, ears, and upper chest. Keep the hijab in the same refined deep sage-green fabric and make the headphones sit naturally over it.
Invariants: keep the girl's face, identity, age, expression, pose, hands, clothing, skin tone, laptop teacher, Quran, wooden rehal, desk, room, plants, lighting, shadows, colors, camera angle, and all object positions unchanged. Preserve the wide 3:2 framing and generous negative space on the left.
Constraints: culturally respectful Muslim modesty; absolutely no hair visible; realistic fabric folds and headphone fit; Quran remains handled respectfully; no logos, no text, no watermark.
Avoid: changing facial features, changing the scene, adding objects, exposed hair or neck, niqab, abaya redesign, artificial retouching.
```

### Supporting Quran and Arabic study image

```text
Use case: photorealistic-natural
Asset type: supporting editorial image for the Tarteel Academy website, used in the learning approach / programs section
Primary request: an elegant overhead editorial photograph of a peaceful Quran and Arabic study setup on a light warm-oak desk: a closed deep-forest-green Quran with subtle non-readable gold embossing resting respectfully on a carved wooden rehal, an open Arabic practice notebook with beautiful handwritten letter exercises but no clearly readable full sentences, a tasteful fountain pen, cream prayer beads, a small olive branch, and the corner of a modern tablet showing a simple video lesson interface with no readable text or faces.
Scene/backdrop: refined contemporary home study desk, minimal and authentic.
Style/medium: high-end natural lifestyle photography, tactile materials, sophisticated education brand campaign.
Composition/framing: landscape 4:3, balanced top-down flat lay, generous breathing room, suitable for cropping into a rounded website card.
Lighting/mood: soft morning window light with subtle geometric Islamic lattice shadows, calm, focused, premium.
Color palette: warm ivory, light oak, deep forest green #123d2c, fresh leaf green #69bd45, restrained antique brass.
Constraints: Quran is elevated and handled respectfully; culturally accurate; no people; no logos; no readable text; no watermark.
Avoid: excessive ornament, mosque scene, neon colors, food, coffee, messy stationery, fake Arabic lettering as a focal point.
```
