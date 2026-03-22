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

// List products
$page = $client->products()->list(collection_code: 'SS25');
foreach ($page->items as $product) {
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

## Resources

All API endpoints are organized into resources accessible from the client:

| Resource | Access | Endpoints |
|----------|--------|-----------|
| Products | `$client->products()` | list, get, getVariant, upsert, updateVariant, batchUpsert, paginate |
| Collections | `$client->collections()` | list, get, upsert, batchUpsert, paginate |
| Orders | `$client->orders()` | list, get, upsert, updateStatus, archive, paginate |
| Retailers | `$client->retailers()` | list, get, upsert, batchUpsert, paginate |
| Prices | `$client->prices()` | list, set, listBySize, setBySize, batchSet, batchSetBySize |
| Inventory | `$client->inventory()` | list, getByData, setByData, getByEan, setByEan, getBySku, setBySku, batchSet* |
| Fabrics | `$client->fabrics()` | list, get, upsert, batchUpsert, paginate |
| Files | `$client->files()` | uploadProductImage, deleteProductImage, uploadFabricImage, deleteFabricImage, uploadSalesDocumentFile, deleteSalesDocumentFile |
| Sales Documents | `$client->salesDocuments()` | list, get, upsert, listOrders, linkOrder, batchUpsert, paginate |
| Sales Catalogs | `$client->salesCatalogs()` | list, get, upsert, listItems, setItem, batchUpsert, batchSetItems, paginate |
| Selections | `$client->selections()` | list, get, upsert, delete, paginate |
| Sizings | `$client->sizings()` | list, get, upsert, batchUpsert, paginate |
| Invoices | `$client->invoices()` | list, get, paginate |

## Pagination

List endpoints return a `Page` object with 500 items per page:

```php
// Manual pagination
$page = $client->products()->list(page: 2);
echo "Page {$page->page}, has more: " . ($page->hasMore ? 'yes' : 'no') . "\n";

// Auto-pagination (lazy generator)
foreach ($client->products()->paginate() as $product) {
    // Automatically fetches next pages
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

## Authentication

Authentication is fully managed. The SDK automatically:
- Fetches a token on the first API call
- Caches the token for its validity period
- Refreshes the token before it expires (60s buffer)

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
