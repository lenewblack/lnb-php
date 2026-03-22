<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Selection;

final class SelectionItem
{
    public function __construct(
        public readonly ?string $create_time = null,
        public readonly ?string $update_time = null,
        public readonly ?string $origin_collection_code = null,
        public readonly ?string $product_model = null,
        public readonly ?string $product_name = null,
        public readonly ?string $fabric_code = null,
        public readonly ?string $fabric_name = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            create_time: $data['create_time'] ?? null,
            update_time: $data['update_time'] ?? null,
            origin_collection_code: $data['origin_collection_code'] ?? null,
            product_model: $data['product_model'] ?? null,
            product_name: $data['product_name'] ?? null,
            fabric_code: $data['fabric_code'] ?? null,
            fabric_name: $data['fabric_name'] ?? null,
        );
    }
}
