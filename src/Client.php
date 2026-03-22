<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale;

use LeNewBlack\Wholesale\Auth\TokenManager;
use LeNewBlack\Wholesale\Http\HttpClient;
use LeNewBlack\Wholesale\Model\ApiVersion;
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

final class Client
{
    public const VERSION = '1.0.0';

    private readonly HttpClient $http;
    private readonly TokenManager $auth;

    public function __construct(
        string $clientId,
        string $clientSecret,
        string $baseUrl = 'https://www.lenewblack.com/apis/wholesale/v2',
        array $guzzleOptions = [],
    ) {
        $this->http = new HttpClient($baseUrl, $guzzleOptions, self::VERSION);
        $this->auth = new TokenManager($clientId, $clientSecret, $this->http);
    }

    public function sdkVersion(): string
    {
        return self::VERSION;
    }

    public function products(): ProductResource
    {
        return new ProductResource($this->http, $this->auth);
    }

    public function collections(): CollectionResource
    {
        return new CollectionResource($this->http, $this->auth);
    }

    public function orders(): OrderResource
    {
        return new OrderResource($this->http, $this->auth);
    }

    public function retailers(): RetailerResource
    {
        return new RetailerResource($this->http, $this->auth);
    }

    public function prices(): PriceResource
    {
        return new PriceResource($this->http, $this->auth);
    }

    public function inventory(): InventoryResource
    {
        return new InventoryResource($this->http, $this->auth);
    }

    public function fabrics(): FabricResource
    {
        return new FabricResource($this->http, $this->auth);
    }

    public function files(): FileResource
    {
        return new FileResource($this->http, $this->auth);
    }

    public function salesDocuments(): SalesDocumentResource
    {
        return new SalesDocumentResource($this->http, $this->auth);
    }

    public function salesCatalogs(): SalesCatalogResource
    {
        return new SalesCatalogResource($this->http, $this->auth);
    }

    public function selections(): SelectionResource
    {
        return new SelectionResource($this->http, $this->auth);
    }

    public function sizings(): SizingResource
    {
        return new SizingResource($this->http, $this->auth);
    }

    public function invoices(): InvoiceResource
    {
        return new InvoiceResource($this->http, $this->auth);
    }

    public function version(): ApiVersion
    {
        $data = $this->http->get('/version');
        return ApiVersion::fromArray($data);
    }
}
