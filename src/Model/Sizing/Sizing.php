<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Sizing;

final class Sizing
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $size_0 = null,
        public readonly ?string $size_1 = null,
        public readonly ?string $size_2 = null,
        public readonly ?string $size_3 = null,
        public readonly ?string $size_4 = null,
        public readonly ?string $size_5 = null,
        public readonly ?string $size_6 = null,
        public readonly ?string $size_7 = null,
        public readonly ?string $size_8 = null,
        public readonly ?string $size_9 = null,
        public readonly ?string $size_10 = null,
        public readonly ?string $size_11 = null,
        public readonly ?string $size_12 = null,
        public readonly ?string $size_13 = null,
        public readonly ?string $size_14 = null,
        public readonly ?string $size_15 = null,
        public readonly ?string $size_16 = null,
        public readonly ?string $size_17 = null,
        public readonly ?string $size_18 = null,
        public readonly ?string $size_19 = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'] ?? null,
            size_0: $data['size_0'] ?? null,
            size_1: $data['size_1'] ?? null,
            size_2: $data['size_2'] ?? null,
            size_3: $data['size_3'] ?? null,
            size_4: $data['size_4'] ?? null,
            size_5: $data['size_5'] ?? null,
            size_6: $data['size_6'] ?? null,
            size_7: $data['size_7'] ?? null,
            size_8: $data['size_8'] ?? null,
            size_9: $data['size_9'] ?? null,
            size_10: $data['size_10'] ?? null,
            size_11: $data['size_11'] ?? null,
            size_12: $data['size_12'] ?? null,
            size_13: $data['size_13'] ?? null,
            size_14: $data['size_14'] ?? null,
            size_15: $data['size_15'] ?? null,
            size_16: $data['size_16'] ?? null,
            size_17: $data['size_17'] ?? null,
            size_18: $data['size_18'] ?? null,
            size_19: $data['size_19'] ?? null,
        );
    }
}
