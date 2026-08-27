# Deploying Tarteel Academy to Hostinger shared hosting

This app is a plain Laravel 13 project with server-rendered Blade views and
pre-built CSS/JS. Nothing runs Node in production.

---

## 1. PHP version and extensions

Set the domain's PHP version to **8.4** in hPanel → *Advanced* → *PHP
Configuration*. `composer.lock` pins Symfony 8.1, which requires PHP >= 8.4.1,
so 8.3 is not enough. On Hostinger the version can also be set for one
directory only, which is what the shipped root `.htaccess` does:

```apache
AddHandler application/x-httpd-alt-php84___lsphp .php
```

Enable these extensions (all are available on Hostinger):

`bcmath`, `ctype`, `curl`, `dom`, `fileinfo`, `filter`, `hash`, `mbstring`,
`openssl`, `pcre`, `pdo`, `pdo_mysql`, `session`, `tokenizer`, `xml`, `zip`

Under *PHP Options*, make sure `allow_url_fopen` is on and `max_execution_time`
is at least 60 seconds for the first `composer install`.

---

## 2. Create the MySQL database

hPanel → *Databases* → *Management*:

1. Create a database, e.g. `u123456_tarteel`.
2. Create a user, e.g. `u123456_tarteel`, with a strong password.
3. Assign the user to the database with all privileges.

Note the exact database name, user name, and password — Hostinger prefixes both
with your account ID.

---

## 3. Production `.env`

Copy `.env.example` to `.env` on the server and set at least:

```dotenv
APP_NAME="Tarteel Academy"
APP_ENV=production
APP_KEY=                      # generated in step 5
APP_DEBUG=false
APP_URL=https://your-domain.com

APP_LOCALE=en
APP_FALLBACK_LOCALE=en

LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=u123456_tarteel
DB_USERNAME=u123456_tarteel
DB_PASSWORD=your-database-password

SESSION_DRIVER=database
SESSION_SECURE_COOKIE=true

CACHE_STORE=database
QUEUE_CONNECTION=database

# Mail is only used for future notifications; the enrollment form writes
# straight to the database, so these can stay as placeholders for now.
MAIL_MAILER=log
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465
MAIL_USERNAME=hello@your-domain.com
MAIL_PASSWORD=
MAIL_FROM_ADDRESS="hello@your-domain.com"
MAIL_FROM_NAME="Tarteel Academy"

# Admin account created by the seeder (see step 6)
ADMIN_NAME="Tarteel Academy Admin"
ADMIN_EMAIL=admin@your-domain.com
ADMIN_PASSWORD=a-long-random-password

# Shown on the landing page and in the structured data
ACADEMY_EMAIL=tarteelacademy24@gmail.com
ACADEMY_PHONE=+201120600803
ACADEMY_PHONE_DISPLAY="+20 112 060 0803"
ACADEMY_WHATSAPP=https://wa.me/201120600803
ACADEMY_FACEBOOK=https://www.facebook.com/share/1JC9M2ehfm/
ACADEMY_INSTAGRAM=
```

`APP_URL` must be the final HTTPS domain: the canonical link, the Open Graph
image URL, and the JSON-LD block are all derived from it.

Clearing `ACADEMY_PHONE` (or leaving it at the `+000000000000` placeholder)
hides the phone number from the public page. Clearing `ACADEMY_WHATSAPP`
removes the floating chat button and both WhatsApp links.

---

## 4. Upload and install dependencies

Upload everything **except** `node_modules`, `vendor`, `.env`, and
`database/database.sqlite`.

With SSH (Hostinger Business plans and up):

```bash
cd ~/domains/your-domain.com/tarteel
composer install --no-dev --optimize-autoloader
```

Without SSH: run `composer install --no-dev --optimize-autoloader` locally and
upload the resulting `vendor/` directory with the rest of the project.

---

## 5. Application key

```bash
php artisan key:generate --force
```

No SSH? Generate one locally with the same command and copy the resulting
`APP_KEY=base64:...` line into the server's `.env`. Never reuse the local key
from a development machine that others have access to.

---

## 6. Migrations and the admin account

```bash
php artisan migrate --force
php artisan db:seed --class=AdminUserSeeder --force
```

The seeder is safe to re-run: if an account already exists for `ADMIN_EMAIL` it
prints a notice and leaves the existing password untouched. It refuses to
create an account when `ADMIN_PASSWORD` is empty.

Without SSH, run both commands through hPanel's *Cron Jobs* as one-off jobs:

```
/usr/bin/php8.3 /home/u123456/domains/your-domain.com/tarteel/artisan migrate --force
```

Delete the cron entry once it has run.

---

## 7. Front-end assets

Assets are compiled locally and committed to the server as static files — the
server needs no Node.

```bash
npm install
npm run build
```

Build **locally**, not on the server: Vite 8's Rolldown bundler cannot start its
thread pool inside Hostinger's process limits and panics with
`The global thread pool has not been initialized`.

Upload the generated `public/build/` directory (it contains `manifest.json` and
the hashed CSS/JS files). Repeat this whenever anything in `resources/css` or
`resources/js` changes. Without `public/build`, every page throws a
"Vite manifest not found" error.

---

## 8. Document root

**Preferred:** point the domain's document root at the project's `public`
directory (hPanel → *Websites* → *Manage* → *Website settings* → *Document
root*), e.g. `/domains/your-domain.com/tarteel/public`.

**If the document root cannot be changed** (on Hostinger a subdomain's root is
the project folder itself), keep the shipped root `.htaccess`: it forwards every
request into `public/` and returns 403 for `app/`, `config/`, `database/`,
`resources/`, `routes/`, `storage/`, `tests/`, `vendor/`, `media/` and `.git/`,
so nothing above `public/` is reachable. This is how
`tartel.technest-agency.com` is deployed.

**Alternative, if the project must live outside the web root:**

1. Upload the whole project **one level above** `public_html`, e.g.
   `~/domains/your-domain.com/tarteel`, so `.env`, `vendor`, `storage`,
   `app`, `config`, `routes`, and `resources` are never inside a web-served
   directory.
2. Copy the *contents* of the project's `public/` folder into `public_html/`
   (`index.php`, `.htaccess`, `favicon.ico`, `robots.txt`, `images/`,
   `build/`).
3. Edit `public_html/index.php` and repoint the two paths at the project:

   ```php
   // was: __DIR__.'/../vendor/autoload.php'
   require __DIR__.'/../tarteel/vendor/autoload.php';

   // was: __DIR__.'/../bootstrap/app.php'
   $app = require_once __DIR__.'/../tarteel/bootstrap/app.php';
   ```

   Also update the maintenance-mode check near the top of the file if present:

   ```php
   if (file_exists($maintenance = __DIR__.'/../tarteel/storage/framework/maintenance.php')) {
   ```

4. Confirm the app source is not reachable over HTTP: `https://your-domain.com/.env`,
   `/vendor/`, `/storage/`, and `/app/` must all return 404.

Keep `public_html/.htaccess` exactly as shipped in `public/.htaccess` — it is
what rewrites every request to `index.php`.

---

## 9. Permissions

```bash
chmod -R 755 storage bootstrap/cache
```

If the host runs PHP as a different user and writes fail, use `775`. Never use
`777`. The web server must be able to write to `storage/framework`,
`storage/logs`, and `bootstrap/cache`.

---

## 10. Cache the configuration

After every change to `.env`, config, routes, or views:

```bash
php artisan optimize
```

That caches config, routes, events, and views in one step. To clear everything
again:

```bash
php artisan optimize:clear
```

Individual commands if you need them: `config:clear`, `route:clear`,
`view:clear`, `cache:clear`.

The caches store absolute paths, so always run `optimize` **after** the project
sits in its final directory. Caching from a staging directory and then moving
the project produces a blank HTTP 500 with nothing in `storage/logs`.

Because config is cached in production, `env()` must never be called outside
`config/*.php`. This project already follows that rule.

---

## 11. Changing the admin password

The seeder never overwrites an existing password. To change it:

```bash
php artisan tinker
```

```php
$user = App\Models\User::where('email', 'admin@your-domain.com')->firstOrFail();
$user->update(['password' => 'the-new-long-password']);
exit
```

The `password` attribute is hashed automatically by the model cast, so pass the
plain password exactly as above.

To rotate the account entirely, delete the user and re-run the seeder with a new
`ADMIN_PASSWORD` in `.env`:

```bash
php artisan tinker --execute="App\Models\User::where('email','admin@your-domain.com')->delete();"
php artisan db:seed --class=AdminUserSeeder --force
```

Never commit a password to git and never put it in a Blade view. `.env` is
already in `.gitignore`.

---

## 12. Post-deploy checklist

- [ ] `https://your-domain.com/` loads in English (LTR) and the AR/EN toggle switches to Arabic (RTL).
- [ ] The floating WhatsApp button opens a chat with the academy's number.
- [ ] Submitting the enrollment form shows the success panel and creates a row.
- [ ] `https://your-domain.com/admin/login` accepts the seeded admin.
- [ ] The dashboard lists requests; search, status filter, and pagination work.
- [ ] "Export CSV" downloads a file that opens with correct Arabic in Excel.
- [ ] `https://your-domain.com/.env` returns 404.
- [ ] `APP_DEBUG=false` — error pages show no stack traces.
