Contributing to Manage Spending App
==================================

Thanks for your interest in contributing — small, clear contributions are very welcome.

Getting started
---------------
1. Fork the repository and create a topic branch from `main` (or `prompt` in this workspace).
2. Install dependencies and run the app locally (PowerShell examples):

```powershell
composer install
copy .env.example .env
php artisan key:generate
npm install
npm run dev
```

Run migrations and seeders (SQLite recommended for quick start):

```powershell
New-Item -Path database\database.sqlite -ItemType File -Force
# set DB_CONNECTION=sqlite and DB_DATABASE=database/database.sqlite in .env
php artisan migrate --seed
```

Testing
-------
- The test suite runs on an in-memory SQLite DB by default. Run all tests with:

```powershell
php artisan test
```

- If you see "could not find driver", enable `pdo_sqlite` for your PHP CLI.

Coding style and guidelines
---------------------------
- Follow PSR-12 for PHP code.
- Keep controllers thin; prefer Form Requests, services, or domain classes for business logic.
- Add or update tests for any new behavior (Feature or Unit tests as appropriate).
- Keep JS/React code small and componentized. Use `resources/js` for frontend source.

Branching & pull requests
-------------------------
- Create a clear PR title and concise description of what changed and why.
- Reference any related issue numbers in the PR description.
- Link to running instructions or migration steps if they are required.
- Keep PRs focused; large architectural changes may be split into multiple PRs.

Issues
------
- Open an issue for bugs or feature requests, include steps to reproduce (or a failing test) and expected behavior.
- Label issues if you can (bug, enhancement, question).

Commit messages
---------------
- Use present tense: "Add feature", "Fix bug".
- Keep the subject line short (~50 chars) and add more detail in the body if needed.

Maintainers
-----------
- The repository owner(s) review and merge PRs. Maintainers may request small changes before merging.

Thank you
---------
Thanks for helping improve the project — your contributions matter. If you want help picking a first issue, ask in an issue and we'll point you to something approachable.
