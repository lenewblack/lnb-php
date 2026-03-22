<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Batch;

final class BatchResult
{
    public function __construct(
        public readonly string $status,
        public readonly ?string $errors,
        public readonly ?array $result,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            status: $data['status'] ?? 'error',
            errors: $data['errors'] ?? null,
            result: $data['result'] ?? null,
        );
    }

    public function isSuccess(): bool
    {
        return $this->status === 'success';
    }
}
