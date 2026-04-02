# Changelog

All notable changes to SadevaLMS will be documented in this file.

The format follows [Keep a Changelog](https://keepachangelog.com/en/1.0.0/) and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [Unreleased]

### Added
- Color theme switcher with 5 presets (Indigo, Blue, Violet, Rose, Emerald) and custom hex color input
- Light/dark mode toggle persisted via `localStorage` for all roles
- Toast notification extracted into reusable `<x-ui.toast />` Blade component

### Changed
- Admin dashboard migrated to full sidebar layout (`layouts/admin.blade.php`)
- Teacher and Student dashboards migrated to shared topbar layout (`layouts/dashboard.blade.php`)

### Fixed
- Language switcher loading spinner incorrectly triggered on locale `$set` — now uses `wire:target="save"`

---

## [0.3.0] - 2026-04-02

### Added
- Platform design system: Tailwind v4 `@theme` tokens (Indigo primary, semantic surface/border colors)
- `AppSetting` model with key/value store + Spatie Medialibrary logo support
- `AppSettingService` singleton and `ThemeService` for runtime CSS variable injection
- Multi-language support: English and Indonesian (`lang/en/`, `lang/id/`)
- `SetLocale` middleware reads locale from session → DB → app config fallback
- Reusable Blade UI component library: `<x-ui.input>`, `<x-ui.button>`, `<x-ui.card>`, `<x-ui.badge>`, `<x-ui.avatar>`, `<x-ui.label>`, `<x-ui.form-error>`
- Admin Settings pages: App Profile (name, tagline, logo upload), Language switcher, Color Theme
- `AppSettingSeeder` seeds default name, tagline, and locale
- `ViewServiceProvider` shares `$appName`, `$appTagline`, `$logoUrl`, `$themeCss` to all views
- Toast notification system (Alpine.js + session flash, slide-in animation)

### Changed
- Login page converted from dark-only to light mode with `layouts/app.blade.php`
- Logout refactored from inline dashboard code into shared `Auth/Logout` Livewire component
- All dashboard PHP classes cleaned of duplicated logout logic

---

## [0.2.0] - 2026-04-01

### Added
- Role-based authentication flow: login → role-redirect → dashboard
- `RoleSeeder` using `RoleEnum` constants and Spatie `Role` model
- `UserDummySeeder`: one dummy user per role (SuperAdmin, Admin, Teacher, Student)
- Livewire class-based components for `Auth/Login` and all four role dashboards
- Role-protected routes: `/superadmin`, `/admin`, `/teacher`, `/student`
- Spatie `RoleMiddleware` registered under `role` alias in `bootstrap/app.php`
- Dark-themed glassmorphism login UI with loading states

### Changed
- `DatabaseSeeder` wired to call `RoleSeeder` and `UserDummySeeder`

---

## [0.1.0] - 2026-03-30

### Added
- Initial Laravel 13 project scaffold
- Livewire v4 and Tailwind CSS v4 installed
- Spatie `laravel-permission` and `laravel-medialibrary` installed
- `RoleEnum` enum defining platform roles
- Base `User` model with `HasRoles` trait
- `layouts/app.blade.php` base layout

---

[Unreleased]: https://github.com/your-org/sadevalms/compare/v0.3.0...HEAD
[0.3.0]: https://github.com/your-org/sadevalms/compare/v0.2.0...v0.3.0
[0.2.0]: https://github.com/your-org/sadevalms/compare/v0.1.0...v0.2.0
[0.1.0]: https://github.com/your-org/sadevalms/releases/tag/v0.1.0
