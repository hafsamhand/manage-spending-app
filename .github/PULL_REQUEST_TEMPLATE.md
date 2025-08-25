## Summary

Please provide a clear description of the changes in this pull request and why they are needed.

## Related issues

Fixes # (issue)

## Changes

- Short list of changes made
- Files touched

## How to test

Steps to reproduce or run the project locally to verify the change:

```powershell
# example (adapt as needed)
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan test
```

## Checklist

- [ ] I have added tests that prove my fix is effective or that my feature works
- [ ] I have run the test suite locally (`php artisan test`)
- [ ] I have added/updated documentation if required (README, CONTRIBUTING)
- [ ] My code follows the project coding style (PSR-12 for PHP)

## Notes for reviewers

Any special notes for reviewers (DB migrations, manual steps, etc.).
