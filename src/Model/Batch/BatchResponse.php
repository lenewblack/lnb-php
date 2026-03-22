<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Batch;

final class BatchResponse
{
    /**
     * @param BatchResult[] $results
     */
    public function __construct(
        public readonly BatchMetadata $metadata,
        public readonly array $results,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            metadata: BatchMetadata::fromArray($data['metadata'] ?? []),
            results: array_map(
                BatchResult::fromArray(...),
                $data['data'] ?? [],
            ),
        );
    }
}
