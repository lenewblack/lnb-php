<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Tests\Unit\Model;

use LeNewBlack\Wholesale\Model\Order\Order;
use LeNewBlack\Wholesale\Model\Order\OrderItem;
use LeNewBlack\Wholesale\Model\Order\SetOrderItemRequest;
use LeNewBlack\Wholesale\Model\Order\SetOrderRequest;
use LeNewBlack\Wholesale\Model\Retailer\Address;
use PHPUnit\Framework\TestCase;

final class OrderTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = [
            'reference' => 'ORD-001',
            'retailer_reference' => 'RET-001',
            'retailer_name' => 'Acme Store',
            'status' => 'confirmed',
            'amount_total' => 1500.50,
            'currency' => 'EUR',
            'discount_rate' => 10.0,
            'billing_address' => [
                'reference' => 'ADDR-1',
                'company' => 'Acme Inc',
                'country' => 'FR',
                'city' => 'Paris',
            ],
            'items' => [
                [
                    'name' => 'Silk Jacket',
                    'reference' => 'SS25-001-BLK',
                    'size' => 'M',
                    'quantity' => 5,
                    'unit_price' => 150.00,
                    'ean13' => '1234567890123',
                ],
            ],
        ];

        $order = Order::fromArray($data);

        $this->assertSame('ORD-001', $order->reference);
        $this->assertSame('RET-001', $order->retailer_reference);
        $this->assertSame('confirmed', $order->status);
        $this->assertSame(1500.50, $order->amount_total);
        $this->assertSame('EUR', $order->currency);
        $this->assertSame(10.0, $order->discount_rate);
        $this->assertInstanceOf(Address::class, $order->billing_address);
        $this->assertSame('Paris', $order->billing_address->city);
        $this->assertCount(1, $order->items);

        $item = $order->items[0];
        $this->assertInstanceOf(OrderItem::class, $item);
        $this->assertSame('Silk Jacket', $item->name);
        $this->assertSame(5, $item->quantity);
        $this->assertSame(150.00, $item->unit_price);
    }

    public function testSetOrderRequestToArray(): void
    {
        $item = (new SetOrderItemRequest())
            ->setModel('SS25-001')
            ->setVariant('BLK-001')
            ->setSize('M')
            ->setQuantity(5);

        $request = (new SetOrderRequest())
            ->setRetailerReference('RET-001')
            ->setItems([$item])
            ->setPurchaseOrderReference('PO-123')
            ->setOrderType('wholesale');

        $array = $request->toArray();

        $this->assertSame('RET-001', $array['retailer_reference']);
        $this->assertSame('PO-123', $array['purchase_order_reference']);
        $this->assertSame('wholesale', $array['order_type']);
        $this->assertCount(1, $array['items']);
        $this->assertSame(5, $array['items'][0]['quantity']);
    }
}
