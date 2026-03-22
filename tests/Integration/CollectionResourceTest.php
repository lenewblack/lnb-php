<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Tests\Integration;

use GuzzleHttp\Psr7\Response;
use LeNewBlack\Wholesale\Model\Collection\Collection;
use LeNewBlack\Wholesale\Model\Collection\SetCollectionRequest;

final class CollectionResourceTest extends MockHttpTestCase
{
    public function testListCollections(): void
    {
        $this->setUpClient([
            new Response(200, [], json_encode([
                ['code' => 'SS25', 'name' => 'Spring Summer', 'status' => 'order'],
                ['code' => 'FW25', 'name' => 'Fall Winter', 'status' => 'preview'],
            ])),
        ]);

        $page = $this->client->collections()->list(status: 'order');

        $this->assertCount(2, $page->items);
        $this->assertSame('SS25', $page->items[0]->code);
    }

    public function testGetCollection(): void
    {
        $this->setUpClient([
            new Response(200, [], json_encode([
                'code' => 'SS25',
                'name' => 'Spring Summer 2025',
                'status' => 'order',
                'enable_inventory' => true,
            ])),
        ]);

        $collection = $this->client->collections()->get('SS25');

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertSame('SS25', $collection->code);
        $this->assertTrue($collection->enable_inventory);
    }

    public function testUpsertCollection(): void
    {
        $this->setUpClient([
            new Response(201, [], json_encode([
                'code' => 'SS25',
                'name' => 'Spring Summer 2025',
                'status' => 'order',
            ])),
        ]);

        $request = (new SetCollectionRequest())
            ->setCode('SS25')
            ->setName('Spring Summer 2025')
            ->setStatus('order');

        $result = $this->client->collections()->upsert($request);

        $this->assertSame('SS25', $result->code);
    }
}
