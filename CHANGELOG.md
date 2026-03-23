# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2026-03-23

### Added
- Initial release of the Le New Black PHP SDK
- `Client` with configurable base URL, API key, and HTTP options
- `HttpClient` wrapper around Guzzle with request/response handling
- `ResultSet` with pagination metadata (`page`, `perPage`, `total`, `lastPage`)
- Batch request support via `BatchRequest` and `BatchResult`
- Resource classes: `Brands`, `Products`, `Orders`, `Linesheets`, `Pricelists`, `Catalogs`, `Appointments`, `Connections`, `Users`
- Model classes: `ApiVersion`, `Brand`, `Product`, `Order`, `Linesheet`, `Pricelist`, `Catalog`, `Appointment`, `Connection`, `User`
- Fix: correct body parsing in HTTP client
- Fix: batch result flattening

[1.0.0]: https://github.com/lenewblack/lnb-php/releases/tag/v1.0.0
