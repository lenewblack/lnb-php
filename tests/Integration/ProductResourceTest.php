<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Tests\Integration;

use GuzzleHttp\Psr7\Response;
use LeNewBlack\Wholesale\Model\Product\Product;
use LeNewBlack\Wholesale\Model\Product\SetProductRequest;
use LeNewBlack\Wholesale\Model\Product\SetVariantRequest;

final class ProductResourceTest extends MockHttpTestCase
{
    public function testListProducts(): void
    {
        $products = [
            ['model' => 'SS25-001', 'name' => 'Jacket', 'variants' => []],
            ['model' => 'SS25-002', 'name' => 'Shirt', 'variants' => []],
        ];

        $this->setUpClient([
            new Response(200, [], json_encode($products)),
        ]);

        $page = $this->client->products()->list(collection_code: 'SS25');

        $this->assertCount(2, $page->items);
        $this->assertSame('SS25-001', $page->items[0]->model);
        $this->assertSame('Shirt', $page->items[1]->name);
        $this->assertFalse($page->hasMore);
    }

    public function testGetProduct(): void
    {
        $product = [
            'model' => 'SS25-001',
            'name' => 'Silk Jacket',
            'collection_code' => 'SS25',
            'variants' => [
                ['fabric_code' => 'BLK', 'fabric_name' => 'Black', 'prices' => [], 'sales_catalogs' => [], 'skus' => []],
            ],
        ];

        $this->setUpClient([
            new Response(200, [], json_encode($product)),
        ]);

        $result = $this->client->products()->get('SS25-001');

        $this->assertInstanceOf(Product::class, $result);
        $this->assertSame('SS25-001', $result->model);
        $this->assertCount(1, $result->variants);
    }

    public function testUpsertProduct(): void
    {
        $responseData = [
            'model' => 'SS25-001',
            'name' => 'Updated Jacket',
            'variants' => [],
        ];

        $this->setUpClient([
            new Response(201, [], json_encode($responseData)),
        ]);

        $request = (new SetProductRequest())
            ->setModel('SS25-001')
            ->setName('Updated Jacket')
            ->setCategoryName('Jackets')
            ->setCollectionCode('SS25')
            ->setCollectionName('Spring Summer 2025')
            ->setSizingName('EU')
            ->setSizingSizes(['S', 'M', 'L'])
            ->setVariants([]);

        $result = $this->client->products()->upsert($request);

        $this->assertSame('Updated Jacket', $result->name);
    }

    public function testBatchUpsert(): void
    {
        $this->setUpClient([
            new Response(200, [], json_encode([
                'metadata' => ['total_requests' => 2, 'total_successes' => 2, 'total_errors' => 0],
                'data' => [
                    ['status' => 'success', 'errors' => '', 'result' => ['model' => 'A']],
                    ['status' => 'success', 'errors' => '', 'result' => ['model' => 'B']],
                ],
            ])),
        ]);

        $req1 = (new SetProductRequest())->setModel('A')->setName('A')->setCategoryName('C')->setCollectionCode('X')->setCollectionName('X')->setSizingName('S')->setSizingSizes(['S'])->setVariants([]);
        $req2 = (new SetProductRequest())->setModel('B')->setName('B')->setCategoryName('C')->setCollectionCode('X')->setCollectionName('X')->setSizingName('S')->setSizingSizes(['S'])->setVariants([]);

        $response = $this->client->products()->batchUpsert([$req1, $req2]);

        $this->assertSame(2, $response->metadata->total_requests);
        $this->assertSame(2, $response->metadata->total_successes);
        $this->assertCount(2, $response->results);
        $this->assertTrue($response->results[0]->isSuccess());
    }
}
