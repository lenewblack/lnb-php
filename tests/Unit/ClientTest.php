<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Tests\Unit;

use LeNewBlack\Wholesale\Client;
use LeNewBlack\Wholesale\Resource\CollectionResource;
use LeNewBlack\Wholesale\Resource\FabricResource;
use LeNewBlack\Wholesale\Resource\FileResource;
use LeNewBlack\Wholesale\Resource\InventoryResource;
use LeNewBlack\Wholesale\Resource\InvoiceResource;
use LeNewBlack\Wholesale\Resource\OrderResource;
use LeNewBlack\Wholesale\Resource\PriceResource;
use LeNewBlack\Wholesale\Resource\ProductResource;
use LeNewBlack\Wholesale\Resource\RetailerResource;
use LeNewBlack\Wholesale\Resource\SalesCatalogResource;
use LeNewBlack\Wholesale\Resource\SalesDocumentResource;
use LeNewBlack\Wholesale\Resource\SelectionResource;
use LeNewBlack\Wholesale\Resource\SizingResource;
use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase
{
    private Client $client;

    protected function setUp(): void
    {
        $this->client = new Client('id', 'secret', 'https://example.com/api');
    }

    public function testProductsReturnsProductResource(): void
    {
        $this->assertInstanceOf(ProductResource::class, $this->client->products());
    }

    public function testCollectionsReturnsCollectionResource(): void
    {
        $this->assertInstanceOf(CollectionResource::class, $this->client->collections());
    }

    public function testOrdersReturnsOrderResource(): void
    {
        $this->assertInstanceOf(OrderResource::class, $this->client->orders());
    }

    public function testRetailersReturnsRetailerResource(): void
    {
        $this->assertInstanceOf(RetailerResource::class, $this->client->retailers());
    }

    public function testPricesReturnsPriceResource(): void
    {
        $this->assertInstanceOf(PriceResource::class, $this->client->prices());
    }

    public function testInventoryReturnsInventoryResource(): void
    {
        $this->assertInstanceOf(InventoryResource::class, $this->client->inventory());
    }

    public function testFabricsReturnsFabricResource(): void
    {
        $this->assertInstanceOf(FabricResource::class, $this->client->fabrics());
    }

    public function testFilesReturnsFileResource(): void
    {
        $this->assertInstanceOf(FileResource::class, $this->client->files());
    }

    public function testSalesDocumentsReturnsSalesDocumentResource(): void
    {
        $this->assertInstanceOf(SalesDocumentResource::class, $this->client->salesDocuments());
    }

    public function testSalesCatalogsReturnsSalesCatalogResource(): void
    {
        $this->assertInstanceOf(SalesCatalogResource::class, $this->client->salesCatalogs());
    }

    public function testSelectionsReturnsSelectionResource(): void
    {
        $this->assertInstanceOf(SelectionResource::class, $this->client->selections());
    }

    public function testSizingsReturnsSizingResource(): void
    {
        $this->assertInstanceOf(SizingResource::class, $this->client->sizings());
    }

    public function testInvoicesReturnsInvoiceResource(): void
    {
        $this->assertInstanceOf(InvoiceResource::class, $this->client->invoices());
    }
}
