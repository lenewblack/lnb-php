<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Tests\Unit\Model;

use LeNewBlack\Wholesale\Model\Product\Product;
use LeNewBlack\Wholesale\Model\Product\SetProductRequest;
use LeNewBlack\Wholesale\Model\Product\SetVariantRequest;
use LeNewBlack\Wholesale\Model\Product\SetSKUItemRequest;
use LeNewBlack\Wholesale\Model\Product\VariantExtended;
use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = [
            'model' => 'SS25-001',
            'name' => 'Silk Jacket',
            'category_name' => 'Jackets',
            'collection_code' => 'SS25',
            'collection_name' => 'Spring Summer 2025',
            'sizing_name' => 'EU Standard',
            'sizing_sizes' => ['S', 'M', 'L', 'XL'],
            'is_published' => true,
            'is_new' => false,
            'is_top' => true,
            'order_min' => 1,
            'order_max' => 100,
            'order_multiple' => 1,
            'extra_1' => 'custom_field',
            'variants' => [
                [
                    'fabric_code' => 'BLK-001',
                    'fabric_name' => 'Black Silk',
                    'is_available' => true,
                    'prices' => [
                        ['price_list_code' => 'EUR', 'wholesale_price' => 150.00],
                    ],
                    'skus' => [
                        ['ean13' => '1234567890123', 'size_name' => 'M'],
                    ],
                ],
            ],
        ];

        $product = Product::fromArray($data);

        $this->assertSame('SS25-001', $product->model);
        $this->assertSame('Silk Jacket', $product->name);
        $this->assertSame('Jackets', $product->category_name);
        $this->assertSame('SS25', $product->collection_code);
        $this->assertSame(['S', 'M', 'L', 'XL'], $product->sizing_sizes);
        $this->assertTrue($product->is_published);
        $this->assertFalse($product->is_new);
        $this->assertTrue($product->is_top);
        $this->assertSame(1, $product->order_min);
        $this->assertSame('custom_field', $product->extra_1);
        $this->assertCount(1, $product->variants);

        $variant = $product->variants[0];
        $this->assertInstanceOf(VariantExtended::class, $variant);
        $this->assertSame('BLK-001', $variant->fabric_code);
        $this->assertTrue($variant->is_available);
        $this->assertCount(1, $variant->prices);
        $this->assertSame(150.00, $variant->prices[0]->wholesale_price);
        $this->assertCount(1, $variant->skus);
        $this->assertSame('1234567890123', $variant->skus[0]->ean13);
    }

    public function testFromArrayDefaults(): void
    {
        $product = Product::fromArray(['model' => 'X', 'name' => 'Y']);

        $this->assertSame('X', $product->model);
        $this->assertSame('Y', $product->name);
        $this->assertNull($product->category_name);
        $this->assertFalse($product->is_published);
        $this->assertEmpty($product->variants);
        $this->assertEmpty($product->sizing_sizes);
    }

    public function testSetProductRequestToArray(): void
    {
        $sku = (new SetSKUItemRequest())
            ->setSizeName('M')
            ->setEan13('1234567890123');

        $variant = (new SetVariantRequest())
            ->setFabricCode('BLK-001')
            ->setFabricName('Black Silk')
            ->setReference('REF-001')
            ->setIsAvailable(true)
            ->setSkus([$sku]);

        $request = (new SetProductRequest())
            ->setModel('SS25-001')
            ->setName('Silk Jacket')
            ->setCategoryName('Jackets')
            ->setCollectionCode('SS25')
            ->setCollectionName('Spring Summer 2025')
            ->setSizingName('EU Standard')
            ->setSizingSizes(['S', 'M', 'L'])
            ->setVariants([$variant])
            ->setIsPublished(true);

        $array = $request->toArray();

        $this->assertSame('SS25-001', $array['model']);
        $this->assertSame('Silk Jacket', $array['name']);
        $this->assertSame('Jackets', $array['category_name']);
        $this->assertSame('SS25', $array['collection_code']);
        $this->assertTrue($array['is_published']);
        $this->assertCount(1, $array['variants']);
        $this->assertSame('BLK-001', $array['variants'][0]['fabric_code']);
        $this->assertCount(1, $array['variants'][0]['skus']);
    }

    public function testSetProductRequestFiltersNulls(): void
    {
        $request = (new SetProductRequest())
            ->setModel('X')
            ->setName('Y')
            ->setCategoryName('Z')
            ->setCollectionCode('C')
            ->setCollectionName('CN')
            ->setSizingName('S')
            ->setSizingSizes(['S'])
            ->setVariants([]);

        $array = $request->toArray();

        $this->assertArrayNotHasKey('extra_1', $array);
        $this->assertArrayNotHasKey('order_min', $array);
        $this->assertArrayNotHasKey('is_new', $array);
    }
}
