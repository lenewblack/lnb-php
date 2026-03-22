<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\SalesDocument;

final class SalesDocumentOrder
{
    public function __construct(
        public readonly string $document_number,
        public readonly string $order_reference,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            document_number: $data['document_number'] ?? '',
            order_reference: $data['order_reference'] ?? '',
        );
    }
}
