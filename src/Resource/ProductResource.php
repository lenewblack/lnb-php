<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Resource;

use LeNewBlack\Wholesale\Http\Paginator;
use LeNewBlack\Wholesale\Model\Batch\BatchResponse;
use LeNewBlack\Wholesale\Model\Page;
use LeNewBlack\Wholesale\Model\Product\Product;
use LeNewBlack\Wholesale\Model\Product\SetProductRequest;
use LeNewBlack\Wholesale\Model\Product\SetVariantAltRequest;
use LeNewBlack\Wholesale\Model\Product\VariantExtended;

final class ProductResource extends AbstractResource
{
    /**
     * @return Page<Product>
     */
    public function list(
        int $page = 1,
        ?string $collection_code = null,
        ?string $models = null,
        ?string $sales_catalog_code = null,
        ?string $from = null,
    ): Page {
        $query = array_filter([
            'page' => $page,
            'collection_code' => $collection_code,
            'models' => $models,
            'sales_catalog_code' => $sales_catalog_code,
            'from' => $from,
        ], fn ($v) => $v !== null);

        $data = $this->authenticatedGet('/products', $query);

        return Page::fromArray($data, Product::fromArray(...), 500, $page);
    }

    public function get(string $model): Product
    {
        $data = $this->authenticatedGet("/products/{$model}");
        return Product::fromArray($data);
    }

    public function getVariant(string $model, string $fabric_code): VariantExtended
    {
        $data = $this->authenticatedGet("/products/{$model}/{$fabric_code}");
        return VariantExtended::fromArray($data);
    }

    public function upsert(SetProductRequest $request): Product
    {
        $data = $this->authenticatedPost('/products', $request->toArray());
        return Product::fromArray($data);
    }

    public function updateVariant(string $model, string $fabric_code, SetVariantAltRequest $request): VariantExtended
    {
        $data = $this->authenticatedPost("/products/{$model}/{$fabric_code}", $request->toArray());
        return VariantExtended::fromArray($data);
    }

    /**
     * Set variant alternatives (link variants across products).
     *
     * @param SetVariantAltRequest[] $requests
     */
    public function setVariantAlternatives(array $requests): array
    {
        $body = array_map(fn(SetVariantAltRequest $r) => $r->toArray(), $requests);
        return $this->authenticatedPost('/products-variants', $body);
    }

    /**
     * @param SetProductRequest[] $requests
     */
    public function batchUpsert(array $requests): BatchResponse
    {
        $body = array_map(fn(SetProductRequest $r) => $r->toArray(), $requests);
        return $this->batchPost('/multi/products', $body);
    }

    /**
     * @return \Generator<Product>
     */
    public function paginate(
        ?string $collection_code = null,
        ?string $models = null,
        ?string $sales_catalog_code = null,
        ?string $from = null,
    ): \Generator {
        return Paginator::paginate(
            fn(int $page) => $this->list($page, $collection_code, $models, $sales_catalog_code, $from)
        );
    }
}
