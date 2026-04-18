# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2026-04-18

Review against the upstream `swagger-api-wholesale-v2.json` (API v2.22.0) uncovered several endpoints the SDK was calling incorrectly and a number of filters the SDK omitted. This release aligns the SDK with the spec.

### Fixed

- `SalesCatalogResource::listItems()` now requires `sales_catalog_code` (the spec marks it as a required query param — calls without it were failing).
- `SalesDocumentResource::listOrders()` now requires `sales_document_number` (same reason).
- `PriceResource::list()` and `PriceResource::listBySize()` no longer send the unsupported `fabric_code` filter. `product_model` is now optional, matching the spec.
- `ProductResource::updateVariant()` now takes `SetVariantRequest` (was incorrectly typed as `SetVariantAltRequest`, which targets a different endpoint).
- `ProductResource::setVariantAlternative()` (renamed from `setVariantAlternatives`) now sends a single `SetVariantAltRequest` and returns a `VariantExtended`, matching the `POST /products-variants` contract. Previously the SDK sent an array body, which the endpoint does not accept.
- `SetSizingRequest` now exposes `setSize21()` through `setSize50()`. Previously only `size_1`–`size_20` were supported even though the spec allows up to 50 sizes.
- Path segments are now `rawurlencode()`-d in resource URLs to handle identifiers containing `/`, `?`, `#`, or spaces.

### Added

- `ProductResource::list()` / `paginate()` gained the `columns_set` parameter (maps to the spec's `columns-set` filter).
- `FabricResource::list()` / `paginate()` gained `name` and `code` filters.
- `RetailerResource::list()` / `paginate()` gained `name`, `reference`, and `price_list_code` filters.
- `SizingResource::list()` / `paginate()` gained `code` and `name` filters.
- `InvoiceResource::list()` / `paginate()` gained `invoice_time_from`, `invoice_time_to`, `confirmation_time_from`, `confirmation_time_to`, `update_time_from`, `update_time_to`, and `status` filters.
- `SalesCatalogResource::list()` / `paginate()` gained `name`, `code`, `status`, and `season` filters.
- `SalesDocumentResource::list()` / `paginate()` gained `name`, `document_number`, `category`, and `type` filters.
- `SelectionResource::list()` / `paginate()` gained `create_time_from`, `create_time_to`, and `status` filters.

### Breaking changes

- `PriceResource::list()` / `listBySize()`: signature changed from `(string $product_model, string $fabric_code)` to `(?string $product_model = null)`.
- `SalesCatalogResource::listItems()`: signature changed from `()` to `(string $sales_catalog_code)`.
- `SalesDocumentResource::listOrders()`: signature changed from `()` to `(string $sales_document_number)`.
- `ProductResource::updateVariant()`: payload type changed from `SetVariantAltRequest` to `SetVariantRequest`.
- `ProductResource::setVariantAlternatives(array)` → `setVariantAlternative(SetVariantAltRequest)`, return type `array` → `VariantExtended`.

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

[2.0.0]: https://github.com/lenewblack/lnb-php/releases/tag/v2.0.0
[1.0.0]: https://github.com/lenewblack/lnb-php/releases/tag/v1.0.0
