<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\SalesDocument;

final class SalesDocument
{
    public function __construct(
        public readonly ?string $create_time = null,
        public readonly ?string $update_time = null,
        public readonly ?string $document_number = null,
        public readonly ?string $name = null,
        public readonly ?string $category = null,
        public readonly ?string $type = null,
        public readonly ?string $comment = null,
        public readonly ?string $issued_on = null,
        public readonly ?string $due_on = null,
        public readonly ?float $amount = null,
        public readonly ?string $amount_currency_code = null,
        public readonly ?string $shipper_ref = null,
        public readonly ?string $shipper_name = null,
        public readonly ?string $file_local_url = null,
        public readonly ?string $file_remote_url = null,
        public readonly ?string $external_id = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            create_time: $data['create_time'] ?? null,
            update_time: $data['update_time'] ?? null,
            document_number: $data['document_number'] ?? null,
            name: $data['name'] ?? null,
            category: $data['category'] ?? null,
            type: $data['type'] ?? null,
            comment: $data['comment'] ?? null,
            issued_on: $data['issued_on'] ?? null,
            due_on: $data['due_on'] ?? null,
            amount: isset($data['amount']) ? (float) $data['amount'] : null,
            amount_currency_code: $data['amount_currency_code'] ?? null,
            shipper_ref: $data['shipper_ref'] ?? null,
            shipper_name: $data['shipper_name'] ?? null,
            file_local_url: $data['file_local_url'] ?? null,
            file_remote_url: $data['file_remote_url'] ?? null,
            external_id: $data['external_id'] ?? null,
        );
    }
}
