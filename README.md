# SadevaLMS

A multi-role Learning Management System (LMS) built with Laravel, Livewire, and Tailwind CSS v4. Designed as a SaaS-ready platform supporting SuperAdmin, Admin, Teacher, and Student roles.

## Tech Stack

| Layer | Package | Version |
|-------|---------|---------|
| PHP | — | 8.3 |
| Framework | Laravel | v13 |
| UI | Livewire | v4 |
| Styling | Tailwind CSS | v4 |
| Auth/Roles | Spatie Permissions | v7 |
| Media | Spatie Medialibrary | v11 |
| Testing | Pest | v4 |

## Getting Started

```bash
# Clone and install
git clone https://github.com/your-org/sadevalms.git
cd sadevalms
composer run setup
```

The `setup` script handles: `composer install`, `.env` copy, `key:generate`, `migrate`, `npm install`, and `npm run build`.

### Development Server

```bash
composer run dev
```

This runs the Laravel server, queue listener, log watcher (Pail), and Vite dev server concurrently.

## Seeding

```bash
# Full seed (roles + users + app settings)
php artisan db:seed

# Individual seeders
php artisan db:seed --class=AppSettingSeeder
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=UserDummySeeder
```

Default dummy users (password: `password`):

| Role | Email |
|------|-------|
| Super Admin | superadmin@example.com |
| Admin | admin@example.com |
| Teacher | teacher@example.com |
| Student | student@example.com |

## Testing

```bash
php artisan test --compact
```

## Documentation

Internal docs are in the [`docs/`](./docs) directory:

- [`docs/release-process.md`](./docs/release-process.md) — versioning rules and release workflow
- [`docs/architecture.md`](./docs/architecture.md) — system design and conventions

## Changelog

See [CHANGELOG.md](./CHANGELOG.md) for a full history of releases.

## License

Proprietary — All rights reserved.
