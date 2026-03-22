<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model;

final class ApiVersion
{
    public function __construct(
        public readonly string $name,
        public readonly string $version,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? '',
            version: $data['version'] ?? '',
        );
    }
}
