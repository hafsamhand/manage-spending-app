# Manage Spending App

A small Laravel app (Blade + Breeze) with a React mount (Vite) for the SPA shell. It includes expenses & loans CRUD, seeders, and a test suite configured to run on an in-memory SQLite database for convenience.

## Quick start (Windows / PowerShell)

Prerequisites:
- PHP (CLI) with `pdo_sqlite` enabled
- Composer
- Node.js + npm
- (Optional) MySQL if you prefer a MySQL dev DB

1) Install PHP dependencies

```powershell
cd C:\laragon\www\manage-spending-app
composer install
```

2) Copy environment file and generate app key

```powershell
copy .env.example .env
php artisan key:generate
```

3) Install JS dependencies and build assets (development)

```powershell
npm install
npm run dev
```

4) Use SQLite (recommended for quick start & tests)

```powershell
New-Item -Path database\database.sqlite -ItemType File -Force
# Edit .env and set:
# DB_CONNECTION=sqlite
# DB_DATABASE=database/database.sqlite
php artisan migrate --seed
```

If you prefer MySQL, update `.env` with your DB credentials and run migrations:

```powershell
php artisan migrate --seed
```

5) Serve the app

```powershell
php artisan serve
# or use Laragon's Apache/Nginx
```

## Frontend

- React entry: `resources/js/app.jsx`
- Blade mount: `resources/views/app.blade.php` (mounts into `<div id="app"></div>`)
- SPA routes are served under `/app` by the Blade view.

## API

- API routes are defined in `routes/api.php` and mounted at `/api`.

## Tests

The test suite uses an in-memory SQLite DB by default. Run:

```powershell
php artisan test
```

If you see `could not find driver`, enable the `pdo_sqlite` extension for your PHP CLI and restart your terminal / Laragon.

## Notes about recent edits

- `phpunit.xml` was configured to use in-memory SQLite for reliable local testing.
- A small test bootstrap helper (`tests/CreatesApplication.php`) and `RefreshDatabase` usage were added so tests run migrations automatically.
- `routes/api.php` is registered in `bootstrap/app.php` to ensure API routes are available.
- Some MySQL-specific SQL (DATE_FORMAT) was replaced with `strftime` for SQLite compatibility in tests.
- Controller authorization calls were simplified; if you want strict policy checks, we should add model policies and register them in `AuthServiceProvider`.

## Next steps (optional)

- Add model policies for `Expense` and `Loan` and re-enable `authorize()` calls.
- Integrate Sanctum for token-based API auth.
- Add a `CONTRIBUTING.md` with local dev tips.

If you'd like any of those, tell me which and I will implement them.
