<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Retailer;

final class Retailer
{
    /**
     * @param Address[] $delivery_addresses
     * @param Buyer[] $buyers
     */
    public function __construct(
        public readonly ?string $create_time = null,
        public readonly ?string $update_time = null,
        public readonly ?string $name = null,
        public readonly ?string $reference = null,
        public readonly ?string $price_list_code = null,
        public readonly ?string $delivery_incoterm = null,
        public readonly ?float $discount_rate = null,
        public readonly ?float $discount_special_rate = null,
        public readonly ?string $terms_of_delivery = null,
        public readonly ?string $terms_of_payment = null,
        public readonly ?string $contact_group = null,
        public readonly ?string $sales_group = null,
        public readonly ?string $sales_admin_email = null,
        public readonly ?string $sales_rep_email = null,
        public readonly ?string $extra_1 = null,
        public readonly ?string $extra_2 = null,
        public readonly ?string $extra_3 = null,
        public readonly ?string $extra_4 = null,
        public readonly ?string $extra_5 = null,
        public readonly ?string $extra_6 = null,
        public readonly ?string $extra_7 = null,
        public readonly ?string $extra_8 = null,
        public readonly ?string $extra_9 = null,
        public readonly ?Address $store_address = null,
        public readonly ?Address $billing_address = null,
        public readonly array $delivery_addresses = [],
        public readonly array $buyers = [],
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            create_time: $data['create_time'] ?? null,
            update_time: $data['update_time'] ?? null,
            name: $data['name'] ?? null,
            reference: $data['reference'] ?? null,
            price_list_code: $data['price_list_code'] ?? null,
            delivery_incoterm: $data['delivery_incoterm'] ?? null,
            discount_rate: isset($data['discount_rate']) ? (float) $data['discount_rate'] : null,
            discount_special_rate: isset($data['discount_special_rate']) ? (float) $data['discount_special_rate'] : null,
            terms_of_delivery: $data['terms_of_delivery'] ?? null,
            terms_of_payment: $data['terms_of_payment'] ?? null,
            contact_group: $data['contact_group'] ?? null,
            sales_group: $data['sales_group'] ?? null,
            sales_admin_email: $data['sales_admin_email'] ?? null,
            sales_rep_email: $data['sales_rep_email'] ?? null,
            extra_1: $data['extra_1'] ?? null,
            extra_2: $data['extra_2'] ?? null,
            extra_3: $data['extra_3'] ?? null,
            extra_4: $data['extra_4'] ?? null,
            extra_5: $data['extra_5'] ?? null,
            extra_6: $data['extra_6'] ?? null,
            extra_7: $data['extra_7'] ?? null,
            extra_8: $data['extra_8'] ?? null,
            extra_9: $data['extra_9'] ?? null,
            store_address: isset($data['store_address']) ? Address::fromArray($data['store_address']) : null,
            billing_address: isset($data['billing_address']) ? Address::fromArray($data['billing_address']) : null,
            delivery_addresses: array_map(Address::fromArray(...), $data['delivery_addresses'] ?? []),
            buyers: array_map(Buyer::fromArray(...), $data['buyers'] ?? []),
        );
    }
}
