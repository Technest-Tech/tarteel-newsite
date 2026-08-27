# Tarteel Academy · أكاديمية ترتيل

Bilingual (English/Arabic) marketing site and enrollment control panel for an
online Quran and Arabic academy. The page renders in English by default and
switches to Arabic (RTL) client-side; the choice is kept in `localStorage`. Laravel 13, Blade, hand-written CSS, and a
small amount of vanilla JavaScript — no front-end framework, no Node in
production.

## Local setup

```bash
composer install
cp .env.example .env            # then set ADMIN_PASSWORD
php artisan key:generate
touch database/database.sqlite  # or point DB_* at MySQL
php artisan migrate
php artisan db:seed --class=AdminUserSeeder
npm install && npm run build
php artisan serve
```

## Routes

| Method | URI | Name | Notes |
| --- | --- | --- | --- |
| GET | `/` | `home` | The whole public page |
| POST | `/enroll` | `enrollments.store` | Throttled 5/min per IP |
| GET | `/admin/login` | `admin.login` | Guests only |
| POST | `/admin/login` | `admin.login.store` | Throttled 5/min per IP |
| POST | `/admin/logout` | `admin.logout` | |
| GET | `/admin/enrollments` | `admin.enrollments.index` | Search, filter, paginate |
| GET | `/admin/enrollments/export` | `admin.enrollments.export` | CSV, UTF-8 BOM |
| GET | `/admin/enrollments/{enrollment}` | `admin.enrollments.show` | |
| PATCH | `/admin/enrollments/{enrollment}` | `admin.enrollments.update` | Status only |

## Editing content

- Statistics, testimonials, contact details, social links, and the bilingual
  labels for every enum live in [`config/tarteel.php`](config/tarteel.php).
- All other copy is in [`resources/views/landing.blade.php`](resources/views/landing.blade.php)
  as paired `data-ar` / `data-en` attributes — the language toggle swaps them
  client-side without a reload. The element's own text is the English default;
  changing the default language means swapping which of the two is rendered
  server-side (and the `<html lang>`/`dir`, the `<title>`, and the fallback in
  `storedLocale()` in `resources/js/app.js`).

## Tests

```bash
php artisan test
./vendor/bin/pint --test
```

## Deployment

See [DEPLOYMENT.md](DEPLOYMENT.md) for the Hostinger shared-hosting guide.
