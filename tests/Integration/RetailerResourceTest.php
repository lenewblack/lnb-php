<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Tests\Integration;

use GuzzleHttp\Psr7\Response;
use LeNewBlack\Wholesale\Model\Retailer\Retailer;

final class RetailerResourceTest extends MockHttpTestCase
{
    public function testListRetailers(): void
    {
        $this->setUpClient([
            new Response(200, [], json_encode([
                ['reference' => 'RET-001', 'name' => 'Acme Store', 'buyers' => [], 'delivery_addresses' => []],
            ])),
        ]);

        $result = $this->client->retailers()->list();

        $this->assertCount(1, $result->data);
        $this->assertSame('RET-001', $result->data[0]->reference);
    }

    public function testGetRetailer(): void
    {
        $this->setUpClient([
            new Response(200, [], json_encode([
                'reference' => 'RET-001',
                'name' => 'Acme Store',
                'price_list_code' => 'EUR',
                'discount_rate' => 15.5,
                'store_address' => [
                    'reference' => 'ADDR-1',
                    'company' => 'Acme Inc',
                    'country' => 'FR',
                    'city' => 'Paris',
                ],
                'buyers' => [
                    ['email' => 'john@acme.com', 'first_name' => 'John', 'last_name' => 'Doe', 'gender' => 'mr'],
                ],
                'delivery_addresses' => [],
            ])),
        ]);

        $retailer = $this->client->retailers()->get('RET-001');

        $this->assertInstanceOf(Retailer::class, $retailer);
        $this->assertSame('Acme Store', $retailer->name);
        $this->assertSame(15.5, $retailer->discount_rate);
        $this->assertSame('Paris', $retailer->store_address->city);
        $this->assertCount(1, $retailer->buyers);
        $this->assertSame('john@acme.com', $retailer->buyers[0]->email);
    }
}
