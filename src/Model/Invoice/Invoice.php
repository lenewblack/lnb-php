<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Invoice;

use LeNewBlack\Wholesale\Model\Retailer\Address;

final class Invoice
{
    /**
     * @param InvoiceItem[] $items
     */
    public function __construct(
        public readonly ?string $reference_number = null,
        public readonly ?string $create_time = null,
        public readonly ?string $update_time = null,
        public readonly ?string $invoice_on = null,
        public readonly ?string $due_on = null,
        public readonly ?string $paid_on = null,
        public readonly ?string $shipping_start_on = null,
        public readonly ?string $shipping_end_on = null,
        public readonly ?string $status = null,
        public readonly ?string $price_list_code = null,
        public readonly ?string $purchase_order_reference = null,
        public readonly ?string $order_reference = null,
        public readonly ?string $retailer_reference = null,
        public readonly ?string $retailer_name = null,
        public readonly ?string $delivery_incoterm_ref = null,
        public readonly ?string $currency_code = null,
        public readonly ?float $deposit_rate = null,
        public readonly ?float $discount_rate = null,
        public readonly ?float $tax_rate = null,
        public readonly ?float $amount_order_tax_free = null,
        public readonly ?float $amount_shipping_tax_free = null,
        public readonly ?float $amount_discount_tax_free = null,
        public readonly ?float $amount_tax = null,
        public readonly ?float $amount_total_tax_inclusive = null,
        public readonly ?float $amount_deposit = null,
        public readonly ?float $amount_paid = null,
        public readonly ?string $terms_of_delivery = null,
        public readonly ?string $terms_of_payment = null,
        public readonly ?Address $billing_address = null,
        public readonly ?Address $delivery_address = null,
        public readonly array $items = [],
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            reference_number: $data['reference_number'] ?? null,
            create_time: $data['create_time'] ?? null,
            update_time: $data['update_time'] ?? null,
            invoice_on: $data['invoice_on'] ?? null,
            due_on: $data['due_on'] ?? null,
            paid_on: $data['paid_on'] ?? null,
            shipping_start_on: $data['shipping_start_on'] ?? null,
            shipping_end_on: $data['shipping_end_on'] ?? null,
            status: $data['status'] ?? null,
            price_list_code: $data['price_list_code'] ?? null,
            purchase_order_reference: $data['purchase_order_reference'] ?? null,
            order_reference: $data['order_reference'] ?? null,
            retailer_reference: $data['retailer_reference'] ?? null,
            retailer_name: $data['retailer_name'] ?? null,
            delivery_incoterm_ref: $data['delivery_incoterm_ref'] ?? null,
            currency_code: $data['currency_code'] ?? null,
            deposit_rate: isset($data['deposit_rate']) ? (float) $data['deposit_rate'] : null,
            discount_rate: isset($data['discount_rate']) ? (float) $data['discount_rate'] : null,
            tax_rate: isset($data['tax_rate']) ? (float) $data['tax_rate'] : null,
            amount_order_tax_free: isset($data['amount_order_tax_free']) ? (float) $data['amount_order_tax_free'] : null,
            amount_shipping_tax_free: isset($data['amount_shipping_tax_free']) ? (float) $data['amount_shipping_tax_free'] : null,
            amount_discount_tax_free: isset($data['amount_discount_tax_free']) ? (float) $data['amount_discount_tax_free'] : null,
            amount_tax: isset($data['amount_tax']) ? (float) $data['amount_tax'] : null,
            amount_total_tax_inclusive: isset($data['amount_total_tax_inclusive']) ? (float) $data['amount_total_tax_inclusive'] : null,
            amount_deposit: isset($data['amount_deposit']) ? (float) $data['amount_deposit'] : null,
            amount_paid: isset($data['amount_paid']) ? (float) $data['amount_paid'] : null,
            terms_of_delivery: $data['terms_of_delivery'] ?? null,
            terms_of_payment: $data['terms_of_payment'] ?? null,
            billing_address: isset($data['billing_address']) ? Address::fromArray($data['billing_address']) : null,
            delivery_address: isset($data['delivery_address']) ? Address::fromArray($data['delivery_address']) : null,
            items: array_map(InvoiceItem::fromArray(...), $data['items'] ?? []),
        );
    }
}
