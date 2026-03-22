<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Resource;

use LeNewBlack\Wholesale\Http\Paginator;
use LeNewBlack\Wholesale\Model\Batch\BatchResponse;
use LeNewBlack\Wholesale\Model\Page;
use LeNewBlack\Wholesale\Model\SalesCatalog\SalesCatalog;
use LeNewBlack\Wholesale\Model\SalesCatalog\SalesCatalogItem;
use LeNewBlack\Wholesale\Model\SalesCatalog\SetSalesCatalogItemRequest;
use LeNewBlack\Wholesale\Model\SalesCatalog\SetSalesCatalogRequest;

final class SalesCatalogResource extends AbstractResource
{
    /**
     * @return Page<SalesCatalog>
     */
    public function list(int $page = 1): Page
    {
        $data = $this->authenticatedGet('/sales_catalogs', ['page' => $page]);
        return Page::fromArray($data, SalesCatalog::fromArray(...), 500, $page);
    }

    public function get(string $code): SalesCatalog
    {
        $data = $this->authenticatedGet("/sales_catalogs/{$code}");
        return SalesCatalog::fromArray($data);
    }

    public function upsert(SetSalesCatalogRequest $request): SalesCatalog
    {
        $data = $this->authenticatedPost('/sales_catalogs', $request->toArray());
        return SalesCatalog::fromArray($data);
    }

    /**
     * @return SalesCatalogItem[]
     */
    public function listItems(): array
    {
        $data = $this->authenticatedGet('/sales_catalog_items');
        return array_map(SalesCatalogItem::fromArray(...), $data);
    }

    public function setItem(SetSalesCatalogItemRequest $request): SalesCatalogItem
    {
        $data = $this->authenticatedPost('/sales_catalog_items', $request->toArray());
        return SalesCatalogItem::fromArray($data);
    }

    /**
     * @param SetSalesCatalogRequest[] $requests
     */
    public function batchUpsert(array $requests): BatchResponse
    {
        $body = array_map(fn(SetSalesCatalogRequest $r) => $r->toArray(), $requests);
        return $this->batchPost('/multi/sales_catalogs', $body);
    }

    /**
     * @param SetSalesCatalogItemRequest[] $requests
     */
    public function batchSetItems(array $requests): BatchResponse
    {
        $body = array_map(fn(SetSalesCatalogItemRequest $r) => $r->toArray(), $requests);
        return $this->batchPost('/multi/sales_catalog_items', $body);
    }

    /**
     * @return \Generator<SalesCatalog>
     */
    public function paginate(): \Generator
    {
        return Paginator::paginate(fn(int $page) => $this->list($page));
    }
}
