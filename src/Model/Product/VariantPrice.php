<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Product;

final class VariantPrice
{
    public function __construct(
        public readonly ?string $price_list_code = null,
        public readonly ?float $recommended_retail_price = null,
        public readonly ?float $wholesale_price = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            price_list_code: $data['price_list_code'] ?? null,
            recommended_retail_price: isset($data['recommended_retail_price']) ? (float) $data['recommended_retail_price'] : null,
            wholesale_price: isset($data['wholesale_price']) ? (float) $data['wholesale_price'] : null,
        );
    }
}
