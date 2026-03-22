<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Inventory;

final class InventoryEANItem
{
    public function __construct(
        public readonly string $ean13,
        public readonly int $in_stock,
        public readonly bool $is_blocked = false,
        public readonly ?string $in_stock_update_time = null,
        public readonly ?int $incoming_stock = null,
        public readonly ?string $incoming_stock_date = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            ean13: $data['ean13'] ?? '',
            in_stock: $data['in_stock'] ?? 0,
            is_blocked: $data['is_blocked'] ?? false,
            in_stock_update_time: $data['in_stock_update_time'] ?? null,
            incoming_stock: $data['incoming_stock'] ?? null,
            incoming_stock_date: $data['incoming_stock_date'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'ean13' => $this->ean13,
            'in_stock' => $this->in_stock,
            'is_blocked' => $this->is_blocked,
            'in_stock_update_time' => $this->in_stock_update_time,
            'incoming_stock' => $this->incoming_stock,
            'incoming_stock_date' => $this->incoming_stock_date,
        ], fn ($v) => $v !== null);
    }
}
