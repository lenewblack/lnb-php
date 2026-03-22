<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Fabric;

final class Fabric
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $create_time = null,
        public readonly ?string $update_time = null,
        public readonly ?string $code = null,
        public readonly ?string $name = null,
        public readonly ?string $material_code = null,
        public readonly ?string $material_name = null,
        public readonly ?string $color_code = null,
        public readonly ?string $color_name = null,
        public readonly ?string $external_name = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            create_time: $data['create_time'] ?? null,
            update_time: $data['update_time'] ?? null,
            code: $data['code'] ?? null,
            name: $data['name'] ?? null,
            material_code: $data['material_code'] ?? null,
            material_name: $data['material_name'] ?? null,
            color_code: $data['color_code'] ?? null,
            color_name: $data['color_name'] ?? null,
            external_name: $data['external_name'] ?? null,
        );
    }
}
