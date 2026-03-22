<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Inventory;

final class InventoryDataItem
{
    public function __construct(
        public readonly string $model,
        public readonly string $fabric_code,
        public readonly string $size,
        public readonly ?string $ean13 = null,
        public readonly ?string $sku = null,
        public readonly bool $is_blocked = false,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            model: $data['model'] ?? '',
            fabric_code: $data['fabric_code'] ?? '',
            size: $data['size'] ?? '',
            ean13: $data['ean13'] ?? null,
            sku: $data['sku'] ?? null,
            is_blocked: $data['is_blocked'] ?? false,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'model' => $this->model,
            'fabric_code' => $this->fabric_code,
            'size' => $this->size,
            'ean13' => $this->ean13,
            'sku' => $this->sku,
            'is_blocked' => $this->is_blocked,
        ], fn ($v) => $v !== null);
    }
}
