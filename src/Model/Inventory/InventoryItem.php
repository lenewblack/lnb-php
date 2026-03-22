<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Inventory;

final class InventoryItem
{
    public function __construct(
        public readonly ?string $ean13 = null,
        public readonly ?string $sku = null,
        public readonly ?string $extra_1 = null,
        public readonly bool $is_blocked = false,
        public readonly ?int $in_stock = null,
        public readonly ?string $in_stock_update_time = null,
        public readonly ?int $incoming_stock = null,
        public readonly ?string $incoming_stock_date = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            ean13: $data['ean13'] ?? null,
            sku: $data['sku'] ?? null,
            extra_1: $data['extra_1'] ?? null,
            is_blocked: $data['is_blocked'] ?? false,
            in_stock: $data['in_stock'] ?? null,
            in_stock_update_time: $data['in_stock_update_time'] ?? null,
            incoming_stock: $data['incoming_stock'] ?? null,
            incoming_stock_date: $data['incoming_stock_date'] ?? null,
        );
    }
}
