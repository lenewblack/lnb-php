<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Price;

final class PriceBySize
{
    public function __construct(
        public readonly string $product_model,
        public readonly string $fabric_code,
        public readonly string $size_name,
        public readonly string $price_list_code,
        public readonly float $wholesale_price,
        public readonly ?string $price_period_code = null,
        public readonly ?float $cost_price = null,
        public readonly ?float $recommended_retail_price = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            product_model: $data['product_model'] ?? '',
            fabric_code: $data['fabric_code'] ?? '',
            size_name: $data['size_name'] ?? '',
            price_list_code: $data['price_list_code'] ?? '',
            wholesale_price: (float) ($data['wholesale_price'] ?? 0),
            price_period_code: $data['price_period_code'] ?? null,
            cost_price: isset($data['cost_price']) ? (float) $data['cost_price'] : null,
            recommended_retail_price: isset($data['recommended_retail_price']) ? (float) $data['recommended_retail_price'] : null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'product_model' => $this->product_model,
            'fabric_code' => $this->fabric_code,
            'size_name' => $this->size_name,
            'price_list_code' => $this->price_list_code,
            'wholesale_price' => $this->wholesale_price,
            'price_period_code' => $this->price_period_code,
            'cost_price' => $this->cost_price,
            'recommended_retail_price' => $this->recommended_retail_price,
        ], fn ($v) => $v !== null);
    }
}
