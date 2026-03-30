# Le New Black Wholesale PHP SDK

PHP 8.1+ SDK for the [Le New Black Wholesale v2 API](https://www.lenewblack.com/apis/wholesale/v2).

## Installation

```bash
composer require lenewblack/lnb-php
```

## Quick Start

```php
use LeNewBlack\Wholesale\Client;

$client = new Client(
    clientId: 'your_client_id',
    clientSecret: 'your_client_secret',
);

// List products (returns ResultSet)
$result = $client->products()->list(collection_code: 'SS25');
foreach ($result->data as $product) {
    echo $product->model . ': ' . $product->name . "\n";
}

// Auto-paginate through all products
foreach ($client->products()->paginate(collection_code: 'SS25') as $product) {
    echo $product->model . "\n";
}

// Get a single product
$product = $client->products()->get('MODEL-001');

// Create/update a product
use LeNewBlack\Wholesale\Model\Product\SetProductRequest;
use LeNewBlack\Wholesale\Model\Product\SetVariantRequest;

$request = (new SetProductRequest())
    ->setModel('SS25-001')
    ->setName('Silk Jacket')
    ->setCategoryName('Jackets')
    ->setCollectionCode('SS25')
    ->setCollectionName('Spring Summer 2025')
    ->setSizingName('EU Standard')
    ->setSizingSizes(['S', 'M', 'L', 'XL'])
    ->setVariants([
        (new SetVariantRequest())
            ->setFabricCode('BLK-001')
            ->setFabricName('Black Silk')
            ->setReference('SS25-001-BLK')
            ->setIsAvailable(true),
    ]);

$product = $client->products()->upsert($request);
```

## Authentication

Authentication is fully managed. The SDK automatically:
- Fetches a token on the first API call
- Caches the token for its validity period
- Refreshes the token before it expires (60s buffer)

## Resources

All API endpoints are organized into resources accessible from the client:

| Resource | Access | Endpoints |
|----------|--------|-----------|
| Collections | `$client->collections()` | list, get, upsert, batchUpsert, paginate |
| Fabrics | `$client->fabrics()` | list, get, upsert, batchUpsert, paginate |
| Files | `$client->files()` | uploadProductImage, deleteProductImage, uploadFabricImage, deleteFabricImage, uploadSalesDocumentFile, deleteSalesDocumentFile |
| Inventory | `$client->inventory()` | list, getByData, setByData, getByEan, setByEan, getBySku, setBySku, batchSet* |
| Invoices | `$client->invoices()` | list, get, paginate |
| Orders | `$client->orders()` | list, get, upsert, updateStatus, archive, paginate |
| Prices | `$client->prices()` | list, set, listBySize, setBySize, batchSet, batchSetBySize |
| Products | `$client->products()` | list, get, getVariant, upsert, updateVariant, batchUpsert, paginate |
| Retailers | `$client->retailers()` | list, get, upsert, batchUpsert, paginate |
| Sales Catalogs | `$client->salesCatalogs()` | list, get, upsert, listItems, setItem, batchUpsert, batchSetItems, paginate |
| Sales Documents | `$client->salesDocuments()` | list, get, upsert, listOrders, linkOrder, batchUpsert, paginate |
| Selections | `$client->selections()` | list, get, upsert, delete, paginate |
| Sizings | `$client->sizings()` | list, get, upsert, batchUpsert, paginate |

## Result Sets

All `list()` methods return a `ResultSet<T>` object:

```php
$result = $client->products()->list(collection_code: 'SS25');

$result->data;              // T[]  — the items on this page
$result->metadata->page;       // int  — current page number (1-based)
$result->metadata->pageSize;   // int  — items per page (500)
$result->metadata->hasMore;    // bool — whether more pages exist
$result->metadata->totalPages; // int  — total number of pages
$result->metadata->totalItems; // int  — total number of items
$result->metadata->filters;    // array — applied filters (nulls excluded)
```

`ResultSet` is iterable and countable:

```php
foreach ($result as $product) { ... }  // iterate items directly
count($result);                         // number of items on this page
```

**Non-paginated endpoints** (Inventory, Prices, etc.) also return `ResultSet`, but with all pagination metadata set to `null`:

```php
$result = $client->inventory()->list();
$result->metadata->page;    // null — not a paginated endpoint
$result->metadata->hasMore; // null
```

### Pagination metadata via response headers

Pagination metadata is populated from response headers sent by the API. The SDK reads the following headers on paginated endpoints:

| Header | Property |
|--------|----------|
| `X-Pagination-Current-Page` | `metadata->page` |
| `X-Pagination-Page-Size` | `metadata->pageSize` |
| `X-Pagination-Has-More` | `metadata->hasMore` |
| `X-Pagination-Total-Pages` | `metadata->totalPages` |
| `X-Pagination-Total-Items` | `metadata->totalItems` |

### Manual pagination

```php
$result = $client->products()->list(page: 2, collection_code: 'SS25');

echo "Page {$result->metadata->page}\n";
echo "Has more: " . ($result->metadata->hasMore ? 'yes' : 'no') . "\n";
echo "Total: {$result->metadata->totalItems} products across {$result->metadata->totalPages} pages\n";
echo "Filters: " . json_encode($result->metadata->filters) . "\n";
```

### Auto-pagination (lazy generator)

```php
foreach ($client->products()->paginate(collection_code: 'SS25') as $product) {
    // Automatically fetches next pages — memory efficient
}
```

## Batch Operations

Most resources support batch create/update:

```php
$response = $client->products()->batchUpsert([$request1, $request2, $request3]);

echo "Total: {$response->metadata->total_requests}\n";
echo "Success: {$response->metadata->total_successes}\n";
echo "Errors: {$response->metadata->total_errors}\n";

foreach ($response->results as $result) {
    if ($result->isSuccess()) {
        // $result->result contains the created/updated entity
    } else {
        echo "Error: {$result->errors}\n";
    }
}
```

## Error Handling

```php
use LeNewBlack\Wholesale\Exception\AuthenticationException;
use LeNewBlack\Wholesale\Exception\NotFoundException;
use LeNewBlack\Wholesale\Exception\ValidationException;

try {
    $product = $client->products()->get('NONEXISTENT');
} catch (NotFoundException $e) {
    echo "Product not found: {$e->getMessage()}\n";
} catch (ValidationException $e) {
    echo "Validation error: {$e->getMessage()}\n";
    // $e->body contains the full error response
} catch (AuthenticationException $e) {
    echo "Auth failed: {$e->getMessage()}\n";
}
```

## Testing

```bash
composer install
./vendor/bin/phpunit
```

## Requirements

- PHP >= 8.1
- Guzzle HTTP >= 7.0
