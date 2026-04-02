# Release Process — SadevaLMS

This document defines the versioning strategy, branching model, and step-by-step release workflow for the SadevaLMS platform.

---

## Versioning: Semantic Versioning (SemVer)

We follow [SemVer 2.0.0](https://semver.org): `MAJOR.MINOR.PATCH`

| Part | Increment when… | Example |
|------|-----------------|---------|
| `MAJOR` | Breaking change — API incompatibility, major database schema change requiring manual migration, complete feature overhaul | `v1.0.0 → v2.0.0` |
| `MINOR` | New user-visible feature, new settings page, new role, new Livewire component | `v1.3.0 → v1.4.0` |
| `PATCH` | Bug fix, security patch, copy/translation change, styling tweak with no new feature | `v1.4.1 → v1.4.2` |

### Pre-launch versioning (`v0.x.x`)

While the platform has not launched publicly:
- `0.x.0` bumps represent **sprint milestones** (roughly every 1–2 weeks)
- `0.x.y` patches fix bugs within a sprint
- `v1.0.0` marks the **first stable public launch**

```
v0.1.0  ← initial scaffold
v0.2.0  ← auth + role system
v0.3.0  ← design system + i18n + settings
v1.0.0  ← public launch
```

### Pre-release labels

Before promoting a release to stable:

```
v1.0.0-alpha.1   ← early dev, incomplete features
v1.0.0-beta.1    ← feature-complete, testing phase
v1.0.0-rc.1      ← release candidate, staging validation
v1.0.0           ← stable / production
```

---

## Branching Strategy

We follow a **GitHub Flow + release branch** hybrid:

```
main             ← production-ready, always deployable, protected
develop          ← integration branch, deployed to staging
feature/xxx      ← feature work, branched from develop
fix/xxx          ← bug fix branches, branched from develop
hotfix/xxx       ← critical production bug, branched from main
release/x.x.x   ← release prep: version bump, changelog, final QA
```

### Branch protection rules (configure in GitHub Settings)

**`main`:**
- Require pull request before merging
- Require at least 1 approving review
- Require status checks to pass (CI)
- Disable direct pushes

**`develop`:**
- Require status checks to pass (CI)

---

## Release Workflow (Step-by-Step)

### 1. Feature development

```bash
git checkout develop
git pull origin develop
git checkout -b feature/my-new-feature

# ... make changes, commit conventionally (see below) ...

git push origin feature/my-new-feature
# → Open PR into develop on GitHub
# → Request review, pass CI, merge
```

### 2. Create a release branch

When sufficient features have accumulated on `develop`:

```bash
git checkout develop
git pull origin develop
git checkout -b release/0.4.0
```

### 3. Prepare the release

On the release branch:
- [ ] Update `CHANGELOG.md` — move items from `[Unreleased]` to `[0.4.0] - YYYY-MM-DD`
- [ ] Update comparison links at the bottom of `CHANGELOG.md`
- [ ] Bump version in `composer.json` (optional but recommended)
- [ ] Final smoke test on staging

```bash
git add CHANGELOG.md composer.json
git commit -m "chore: prepare release v0.4.0"
```

### 4. Merge and tag

```bash
# Merge release branch into main
git checkout main
git merge release/0.4.0 --no-ff -m "chore: release v0.4.0"

# Tag
git tag -a v0.4.0 -m "Release v0.4.0"

# Push both
git push origin main --follow-tags

# Back-merge into develop
git checkout develop
git merge main --no-ff -m "chore: back-merge v0.4.0 into develop"
git push origin develop
```

### 5. Create GitHub Release

Go to **GitHub → Releases → Draft a new release**:
- Tag: `v0.4.0` (select existing tag)
- Title: `v0.4.0 — <short summary>`
- Body: paste the CHANGELOG section for this version
- Mark as pre-release if applicable

Or use the GitHub CLI:
```bash
gh release create v0.4.0 \
  --title "v0.4.0 — Color theme + dark mode" \
  --notes-file .github/release-notes/0.4.0.md
```

### 6. Hotfix process

For critical bugs discovered in production:

```bash
git checkout main
git pull origin main
git checkout -b hotfix/login-broken

# Fix the bug
git add .
git commit -m "fix: resolve login redirect crash (#123)"

# Merge to main
git checkout main
git merge hotfix/login-broken --no-ff
git tag -a v0.3.1 -m "Hotfix v0.3.1"
git push origin main --follow-tags

# Also merge into develop
git checkout develop
git merge hotfix/login-broken --no-ff
git push origin develop

# Delete hotfix branch
git branch -d hotfix/login-broken
git push origin --delete hotfix/login-broken
```

---

## Commit Message Convention

We follow [Conventional Commits](https://www.conventionalcommits.org/):

```
<type>(<scope>): <short description>
```

| Type | When to use |
|------|-------------|
| `feat` | New feature |
| `fix` | Bug fix |
| `chore` | Build, config, dependency update |
| `docs` | Documentation only |
| `style` | Formatting, whitespace (no logic change) |
| `refactor` | Code restructuring without behavior change |
| `test` | Adding or updating tests |
| `perf` | Performance improvement |
| `security` | Security vulnerability fix |

**Examples:**

```
feat(admin): add color theme switcher with hex input
fix(auth): resolve logout redirect loop for student role
chore: bump Livewire to v4.1.2
docs: update release process workflow
security: sanitize user input on app profile name field
```

**Breaking changes** — add `!` after type or add `BREAKING CHANGE:` in footer:

```
feat(api)!: remove deprecated v1 endpoints

BREAKING CHANGE: /api/v1/users is no longer available. Use /api/v2/users.
```

---

## Changelog Rules

1. Every PR **must** include a `CHANGELOG.md` update under `[Unreleased]`
2. Use the sections: `Added`, `Changed`, `Deprecated`, `Removed`, `Fixed`, `Security`
3. Write entries from the **user's perspective**, not the developer's — "Users can now switch between light and dark mode" not "Added x-data Alpine.js toggle to html tag"
4. Link GitHub issues/PRs where relevant: `Fixed login crash for students (#89)`
5. Security entries must always be present — even if the section says `(none)`

---

## Release Checklist

Copy this into your GitHub PR / release notes each time:

```
- [ ] CHANGELOG.md updated (Unreleased → versioned)
- [ ] Compare links updated at bottom of CHANGELOG.md
- [ ] All tests passing (`php artisan test --compact`)
- [ ] No Pint errors (`vendor/bin/pint --test`)
- [ ] Staging verified (smoke test all roles)
- [ ] Breaking migrations documented in CHANGELOG if any
- [ ] GitHub Release drafted with changelog body
- [ ] Tag pushed (`git tag -a vX.X.X && git push --follow-tags`)
- [ ] Back-merged into develop
- [ ] Production deployed
```

---

## Automated Release (GitHub Actions)

See [`.github/workflows/release.yml`](../../.github/workflows/release.yml) for the automated workflow that:
- Runs tests on every push to `develop` and `main`
- Auto-creates a GitHub Release when a `v*` tag is pushed
- Posts a deployment notification

---

*Last updated: 2026-04-02*
