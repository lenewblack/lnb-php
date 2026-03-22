<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Product;

final class SKUItem
{
    public function __construct(
        public readonly ?string $create_time = null,
        public readonly ?string $update_time = null,
        public readonly ?string $ean13 = null,
        public readonly ?string $sku = null,
        public readonly ?string $extra_1 = null,
        public readonly bool $is_blocked = false,
        public readonly ?string $size_name = null,
        public readonly ?int $external_size_position = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            create_time: $data['create_time'] ?? null,
            update_time: $data['update_time'] ?? null,
            ean13: $data['ean13'] ?? null,
            sku: $data['sku'] ?? null,
            extra_1: $data['extra_1'] ?? null,
            is_blocked: $data['is_blocked'] ?? false,
            size_name: $data['size_name'] ?? null,
            external_size_position: $data['external_size_position'] ?? null,
        );
    }
}
