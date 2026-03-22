<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\SalesCatalog;

final class SalesCatalog
{
    public function __construct(
        public readonly ?string $create_time = null,
        public readonly ?string $update_time = null,
        public readonly ?string $publish_time = null,
        public readonly ?string $code = null,
        public readonly ?string $name = null,
        public readonly ?string $line_name = null,
        public readonly ?string $season_name = null,
        public readonly ?string $status = null,
        public readonly ?string $privacy_level = null,
        public readonly bool $enable_inventory = false,
        public readonly ?string $order_type = null,
        public readonly ?string $image_url = null,
        public readonly ?string $close_on = null,
        public readonly ?string $delivery_start_on = null,
        public readonly ?string $delivery_end_on = null,
        public readonly ?string $payment_terms = null,
        public readonly ?string $extra_1 = null,
        public readonly ?string $extra_2 = null,
        public readonly ?string $extra_3 = null,
        public readonly ?string $extra_4 = null,
        public readonly ?string $extra_5 = null,
        public readonly ?string $extra_6 = null,
        public readonly ?string $extra_7 = null,
        public readonly ?string $extra_8 = null,
        public readonly ?string $extra_9 = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            create_time: $data['create_time'] ?? null,
            update_time: $data['update_time'] ?? null,
            publish_time: $data['publish_time'] ?? null,
            code: $data['code'] ?? null,
            name: $data['name'] ?? null,
            line_name: $data['line_name'] ?? null,
            season_name: $data['season_name'] ?? null,
            status: $data['status'] ?? null,
            privacy_level: $data['privacy_level'] ?? null,
            enable_inventory: $data['enable_inventory'] ?? false,
            order_type: $data['order_type'] ?? null,
            image_url: $data['image_url'] ?? null,
            close_on: $data['close_on'] ?? null,
            delivery_start_on: $data['delivery_start_on'] ?? null,
            delivery_end_on: $data['delivery_end_on'] ?? null,
            payment_terms: $data['payment_terms'] ?? null,
            extra_1: $data['extra_1'] ?? null,
            extra_2: $data['extra_2'] ?? null,
            extra_3: $data['extra_3'] ?? null,
            extra_4: $data['extra_4'] ?? null,
            extra_5: $data['extra_5'] ?? null,
            extra_6: $data['extra_6'] ?? null,
            extra_7: $data['extra_7'] ?? null,
            extra_8: $data['extra_8'] ?? null,
            extra_9: $data['extra_9'] ?? null,
        );
    }
}
