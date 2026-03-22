<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Batch;

final class BatchMetadata
{
    public function __construct(
        public readonly int $total_requests,
        public readonly int $total_successes,
        public readonly int $total_errors,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            total_requests: $data['total_requests'] ?? 0,
            total_successes: $data['total_successes'] ?? 0,
            total_errors: $data['total_errors'] ?? 0,
        );
    }
}
