<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Resource;

use LeNewBlack\Wholesale\Http\Paginator;
use LeNewBlack\Wholesale\Model\Batch\BatchResponse;
use LeNewBlack\Wholesale\Model\Product\Product;
use LeNewBlack\Wholesale\Model\Product\SetProductRequest;
use LeNewBlack\Wholesale\Model\Product\SetVariantAltRequest;
use LeNewBlack\Wholesale\Model\Product\SetVariantRequest;
use LeNewBlack\Wholesale\Model\Product\VariantExtended;
use LeNewBlack\Wholesale\Model\ResultSet;

final class ProductResource extends AbstractResource
{
    /**
     * @return ResultSet<Product>
     */
    public function list(
        int $page = 1,
        ?string $collection_code = null,
        ?string $models = null,
        ?string $sales_catalog_code = null,
        ?string $from = null,
        ?string $columns_set = null,
    ): ResultSet {
        $filters = array_filter([
            'collection_code' => $collection_code,
            'models' => $models,
            'sales_catalog_code' => $sales_catalog_code,
            'from' => $from,
            'columns-set' => $columns_set,
        ], fn ($v) => $v !== null);

        $response = $this->authenticatedGetPaged('/products', array_merge(['page' => $page], $filters));

        return ResultSet::fromPagedResponse($response, Product::fromArray(...), $page, 500, $filters);
    }

    public function get(string $model): Product
    {
        $data = $this->authenticatedGet('/products/' . rawurlencode($model));
        return Product::fromArray($data);
    }

    public function getVariant(string $model, string $fabric_code): VariantExtended
    {
        $data = $this->authenticatedGet('/products/' . rawurlencode($model) . '/' . rawurlencode($fabric_code));
        return VariantExtended::fromArray($data);
    }

    public function upsert(SetProductRequest $request): Product
    {
        $data = $this->authenticatedPost('/products', $request->toArray());
        return Product::fromArray($data);
    }

    public function updateVariant(string $model, string $fabric_code, SetVariantRequest $request): VariantExtended
    {
        $path = '/products/' . rawurlencode($model) . '/' . rawurlencode($fabric_code);
        $data = $this->authenticatedPost($path, $request->toArray());
        return VariantExtended::fromArray($data);
    }

    /**
     * Set a variant via the alt endpoint (link a variant to another product).
     */
    public function setVariantAlternative(SetVariantAltRequest $request): VariantExtended
    {
        $data = $this->authenticatedPost('/products-variants', $request->toArray());
        return VariantExtended::fromArray($data);
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
        ?string $columns_set = null,
    ): \Generator {
        return Paginator::paginate(
            fn(int $page) => $this->list($page, $collection_code, $models, $sales_catalog_code, $from, $columns_set)
        );
    }
}
