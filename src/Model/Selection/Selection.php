<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Selection;

final class Selection
{
    /**
     * @param SelectionItem[] $items
     */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $create_time = null,
        public readonly ?string $update_time = null,
        public readonly ?string $retailer_reference = null,
        public readonly ?string $retailer_name = null,
        public readonly ?string $retailer_link = null,
        public readonly ?string $buyer_name = null,
        public readonly ?string $buyer_first_name = null,
        public readonly ?string $buyer_email = null,
        public readonly ?string $status = null,
        public readonly ?string $channel = null,
        public readonly bool $is_viewed = false,
        public readonly bool $is_ordered = false,
        public readonly array $items = [],
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            create_time: $data['create_time'] ?? null,
            update_time: $data['update_time'] ?? null,
            retailer_reference: $data['retailer_reference'] ?? null,
            retailer_name: $data['retailer_name'] ?? null,
            retailer_link: $data['retailer_link'] ?? null,
            buyer_name: $data['buyer_name'] ?? null,
            buyer_first_name: $data['buyer_first_name'] ?? null,
            buyer_email: $data['buyer_email'] ?? null,
            status: $data['status'] ?? null,
            channel: $data['channel'] ?? null,
            is_viewed: $data['is_viewed'] ?? false,
            is_ordered: $data['is_ordered'] ?? false,
            items: array_map(SelectionItem::fromArray(...), $data['items'] ?? []),
        );
    }
}
