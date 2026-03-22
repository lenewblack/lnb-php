<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\SalesCatalog;

final class SalesCatalogItem
{
    public function __construct(
        public readonly string $sales_catalog_code,
        public readonly string $product_model,
        public readonly string $fabric_code,
        public readonly ?int $rank_in_sales_catalog = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            sales_catalog_code: $data['sales_catalog_code'] ?? '',
            product_model: $data['product_model'] ?? '',
            fabric_code: $data['fabric_code'] ?? '',
            rank_in_sales_catalog: $data['rank_in_sales_catalog'] ?? null,
        );
    }
}
