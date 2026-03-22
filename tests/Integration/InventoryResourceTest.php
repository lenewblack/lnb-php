<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Tests\Integration;

use GuzzleHttp\Psr7\Response;
use LeNewBlack\Wholesale\Model\Inventory\InventoryEANItem;
use LeNewBlack\Wholesale\Model\Inventory\InventoryItem;
use LeNewBlack\Wholesale\Model\Inventory\InventorySKUItem;

final class InventoryResourceTest extends MockHttpTestCase
{
    public function testListInventory(): void
    {
        $this->setUpClient([
            new Response(200, [], json_encode([
                ['ean13' => '1234567890123', 'in_stock' => 50, 'is_blocked' => false],
                ['sku' => 'SKU-001', 'in_stock' => 25, 'is_blocked' => true],
            ])),
        ]);

        $items = $this->client->inventory()->list();

        $this->assertCount(2, $items);
        $this->assertInstanceOf(InventoryItem::class, $items[0]);
        $this->assertSame(50, $items[0]->in_stock);
        $this->assertFalse($items[0]->is_blocked);
    }

    public function testSetByEan(): void
    {
        $this->setUpClient([
            new Response(201, [], json_encode([
                'ean13' => '1234567890123',
                'in_stock' => 100,
                'is_blocked' => false,
            ])),
        ]);

        $item = new InventoryEANItem(ean13: '1234567890123', in_stock: 100);
        $result = $this->client->inventory()->setByEan($item);

        $this->assertInstanceOf(InventoryEANItem::class, $result);
        $this->assertSame(100, $result->in_stock);
    }

    public function testSetBySku(): void
    {
        $this->setUpClient([
            new Response(201, [], json_encode([
                'sku' => 'SKU-001',
                'in_stock' => 75,
            ])),
        ]);

        $item = new InventorySKUItem(sku: 'SKU-001', in_stock: 75);
        $result = $this->client->inventory()->setBySku($item);

        $this->assertInstanceOf(InventorySKUItem::class, $result);
        $this->assertSame(75, $result->in_stock);
    }
}
