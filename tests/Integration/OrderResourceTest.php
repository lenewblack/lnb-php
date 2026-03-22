<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Tests\Integration;

use GuzzleHttp\Psr7\Response;
use LeNewBlack\Wholesale\Model\Order\Order;

final class OrderResourceTest extends MockHttpTestCase
{
    public function testListOrders(): void
    {
        $this->setUpClient([
            new Response(200, [], json_encode([
                ['reference' => 'ORD-001', 'status' => 'confirmed', 'items' => []],
                ['reference' => 'ORD-002', 'status' => 'pending', 'items' => []],
            ])),
        ]);

        $result = $this->client->orders()->list(status: 'confirmed');

        $this->assertCount(2, $result->data);
        $this->assertSame('ORD-001', $result->data[0]->reference);
    }

    public function testGetOrder(): void
    {
        $this->setUpClient([
            new Response(200, [], json_encode([
                'reference' => 'ORD-001',
                'status' => 'confirmed',
                'retailer_reference' => 'RET-001',
                'amount_total' => 5000.00,
                'items' => [
                    ['name' => 'Jacket', 'quantity' => 10, 'unit_price' => 500.00],
                ],
            ])),
        ]);

        $order = $this->client->orders()->get('ORD-001');

        $this->assertInstanceOf(Order::class, $order);
        $this->assertSame('ORD-001', $order->reference);
        $this->assertSame(5000.00, $order->amount_total);
        $this->assertCount(1, $order->items);
    }
}
