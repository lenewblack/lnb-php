<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Order;

final class OrderItem
{
    public function __construct(
        public readonly ?string $create_time = null,
        public readonly ?string $update_time = null,
        public readonly ?string $confirmation_time = null,
        public readonly ?string $collection_name = null,
        public readonly ?string $name = null,
        public readonly ?string $reference = null,
        public readonly ?string $color = null,
        public readonly ?string $size = null,
        public readonly ?float $discount_amount = null,
        public readonly ?float $discount_rate = null,
        public readonly ?float $promotion_amount = null,
        public readonly ?float $promotion_rate = null,
        public readonly ?float $recommended_retail_price = null,
        public readonly ?float $unit_price = null,
        public readonly ?int $quantity = null,
        public readonly ?string $ean13 = null,
        public readonly ?string $sku = null,
        public readonly ?string $sku_extra_1 = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            create_time: $data['create_time'] ?? null,
            update_time: $data['update_time'] ?? null,
            confirmation_time: $data['confirmation_time'] ?? null,
            collection_name: $data['collection_name'] ?? null,
            name: $data['name'] ?? null,
            reference: $data['reference'] ?? null,
            color: $data['color'] ?? null,
            size: $data['size'] ?? null,
            discount_amount: isset($data['discount_amount']) ? (float) $data['discount_amount'] : null,
            discount_rate: isset($data['discount_rate']) ? (float) $data['discount_rate'] : null,
            promotion_amount: isset($data['promotion_amount']) ? (float) $data['promotion_amount'] : null,
            promotion_rate: isset($data['promotion_rate']) ? (float) $data['promotion_rate'] : null,
            recommended_retail_price: isset($data['recommended_retail_price']) ? (float) $data['recommended_retail_price'] : null,
            unit_price: isset($data['unit_price']) ? (float) $data['unit_price'] : null,
            quantity: $data['quantity'] ?? null,
            ean13: $data['ean13'] ?? null,
            sku: $data['sku'] ?? null,
            sku_extra_1: $data['sku_extra_1'] ?? null,
        );
    }
}
