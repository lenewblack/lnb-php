<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Product;

final class VariantSalesCatalog
{
    public function __construct(
        public readonly ?string $code = null,
        public readonly ?string $name = null,
        public readonly ?string $order_mode = null,
        public readonly ?string $inventory_type = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            code: $data['code'] ?? null,
            name: $data['name'] ?? null,
            order_mode: $data['order_mode'] ?? null,
            inventory_type: $data['inventory_type'] ?? null,
        );
    }
}
