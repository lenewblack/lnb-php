<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Tests\Unit\Model;

use LeNewBlack\Wholesale\Model\Collection\Collection;
use LeNewBlack\Wholesale\Model\Collection\SetCollectionRequest;
use PHPUnit\Framework\TestCase;

final class CollectionTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = [
            'code' => 'SS25',
            'name' => 'Spring Summer 2025',
            'line_name' => 'Main Line',
            'season_name' => 'SS25',
            'status' => 'order',
            'privacy_level' => 'open',
            'enable_inventory' => true,
            'delivery_start_on' => '2025-03-01',
            'delivery_end_on' => '2025-06-30',
            'extra_1' => 'val1',
        ];

        $collection = Collection::fromArray($data);

        $this->assertSame('SS25', $collection->code);
        $this->assertSame('Spring Summer 2025', $collection->name);
        $this->assertSame('order', $collection->status);
        $this->assertTrue($collection->enable_inventory);
        $this->assertSame('2025-03-01', $collection->delivery_start_on);
        $this->assertSame('val1', $collection->extra_1);
    }

    public function testSetCollectionRequestToArray(): void
    {
        $request = (new SetCollectionRequest())
            ->setCode('SS25')
            ->setName('Spring Summer 2025')
            ->setStatus('order')
            ->setLineName('Main Line')
            ->setSeasonName('SS25')
            ->setEnableInventory(true);

        $array = $request->toArray();

        $this->assertSame('SS25', $array['code']);
        $this->assertSame('Spring Summer 2025', $array['name']);
        $this->assertSame('order', $array['status']);
        $this->assertSame('Main Line', $array['line_name']);
        $this->assertTrue($array['enable_inventory']);
        $this->assertArrayNotHasKey('extra_1', $array);
    }
}
