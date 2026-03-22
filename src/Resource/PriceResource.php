<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Resource;

use LeNewBlack\Wholesale\Model\Batch\BatchResponse;
use LeNewBlack\Wholesale\Model\Price\Price;
use LeNewBlack\Wholesale\Model\Price\PriceBySize;
use LeNewBlack\Wholesale\Model\ResultSet;

final class PriceResource extends AbstractResource
{
    /**
     * @return ResultSet<Price>
     */
    public function list(string $product_model, string $fabric_code): ResultSet
    {
        $filters = ['product_model' => $product_model, 'fabric_code' => $fabric_code];
        $data = $this->authenticatedGet('/prices', $filters);
        return ResultSet::fromList($data, Price::fromArray(...), $filters);
    }

    public function set(Price $price): Price
    {
        $data = $this->authenticatedPost('/prices', $price->toArray());
        return Price::fromArray($data);
    }

    /**
     * @return ResultSet<PriceBySize>
     */
    public function listBySize(string $product_model, string $fabric_code): ResultSet
    {
        $filters = ['product_model' => $product_model, 'fabric_code' => $fabric_code];
        $data = $this->authenticatedGet('/prices_by_size', $filters);
        return ResultSet::fromList($data, PriceBySize::fromArray(...), $filters);
    }

    public function setBySize(PriceBySize $price): PriceBySize
    {
        $data = $this->authenticatedPost('/prices_by_size', $price->toArray());
        return PriceBySize::fromArray($data);
    }

    /**
     * @param Price[] $prices
     */
    public function batchSet(array $prices): BatchResponse
    {
        $body = array_map(fn(Price $p) => $p->toArray(), $prices);
        return $this->batchPost('/multi/prices', $body);
    }

    /**
     * @param PriceBySize[] $prices
     */
    public function batchSetBySize(array $prices): BatchResponse
    {
        $body = array_map(fn(PriceBySize $p) => $p->toArray(), $prices);
        return $this->batchPost('/multi/prices_by_size', $body);
    }
}
