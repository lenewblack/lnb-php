<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Invoice;

final class InvoiceItem
{
    public function __construct(
        public readonly ?string $create_time = null,
        public readonly ?string $update_time = null,
        public readonly ?string $description = null,
        public readonly ?string $product_name = null,
        public readonly ?string $variant_reference = null,
        public readonly ?string $variant_color = null,
        public readonly ?string $variant_composition = null,
        public readonly ?string $variant_fabric_print = null,
        public readonly ?string $variant_made_in = null,
        public readonly ?string $size = null,
        public readonly ?string $sku = null,
        public readonly ?float $unit_price = null,
        public readonly ?int $quantity = null,
        public readonly ?float $amount_tax_excl = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            create_time: $data['create_time'] ?? null,
            update_time: $data['update_time'] ?? null,
            description: $data['description'] ?? null,
            product_name: $data['product_name'] ?? null,
            variant_reference: $data['variant_reference'] ?? null,
            variant_color: $data['variant_color'] ?? null,
            variant_composition: $data['variant_composition'] ?? null,
            variant_fabric_print: $data['variant_fabric_print'] ?? null,
            variant_made_in: $data['variant_made_in'] ?? null,
            size: $data['size'] ?? null,
            sku: $data['sku'] ?? null,
            unit_price: isset($data['unit_price']) ? (float) $data['unit_price'] : null,
            quantity: $data['quantity'] ?? null,
            amount_tax_excl: isset($data['amount_tax_excl']) ? (float) $data['amount_tax_excl'] : null,
        );
    }
}
