# CLAUDE.md — Le New Black PHP SDK

## Project

PHP SDK for the Le New Black Wholesale v2 API. Published at [lenewblack/lnb-php](https://github.com/lenewblack/lnb-php).

- PHP >= 8.1, Guzzle ^7.0
- Tests: PHPUnit 10, split into `tests/Unit` and `tests/Integration`
- Namespace: `LeNewBlack\Wholesale`

## Release process

1. Update `CHANGELOG.md` — add a new `## [x.y.z] - YYYY-MM-DD` section following the Keep a Changelog format
2. Bump the version in two places:
   - `composer.json` → `"version"` field
   - `src/Client.php` → `VERSION` constant
3. Commit the changes
4. Create and push the tag:
   ```bash
   git tag vx.y.z
   git push origin master
   git push origin vx.y.z
   ```
5. The `release.yml` GitHub Action triggers automatically, runs tests, and creates a GitHub Release with the changelog notes extracted from `CHANGELOG.md`

## CI

- `ci.yml` runs on every push/PR to master — executes unit tests on PHP 8.1, 8.2, 8.3
- `release.yml` runs on `v*` tags — runs tests then creates a GitHub Release

## Versioning

Follows [Semantic Versioning](https://semver.org): `MAJOR.MINOR.PATCH`

- **PATCH** — bug fixes, no breaking changes
- **MINOR** — new features, backwards-compatible
- **MAJOR** — breaking API changes
