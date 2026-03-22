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
        $raw = $data['errors'] ?? null;
        if (is_array($raw)) {
            $parts = [];
            foreach ($raw as $field => $messages) {
                $parts[] = $field . ': ' . (is_array($messages) ? implode(', ', $messages) : $messages);
            }
            $errors = implode('; ', $parts);
        } else {
            $errors = $raw;
        }

        return new self(
            status: $data['status'] ?? 'error',
            errors: $errors,
            result: $data['result'] ?? null,
        );
    }

    public function isSuccess(): bool
    {
        return $this->status === 'success';
    }
}
