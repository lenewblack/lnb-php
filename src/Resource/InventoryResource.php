<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Resource;

use LeNewBlack\Wholesale\Model\Batch\BatchResponse;
use LeNewBlack\Wholesale\Model\Inventory\InventoryDataItem;
use LeNewBlack\Wholesale\Model\Inventory\InventoryEANItem;
use LeNewBlack\Wholesale\Model\Inventory\InventoryItem;
use LeNewBlack\Wholesale\Model\Inventory\InventorySKUItem;

final class InventoryResource extends AbstractResource
{
    /**
     * @return InventoryItem[]
     */
    public function list(): array
    {
        $data = $this->authenticatedGet('/inventory');
        return array_map(InventoryItem::fromArray(...), $data);
    }

    public function getByData(string $model, string $fabric_code, string $size): InventoryItem
    {
        $data = $this->authenticatedGet("/inventory/data/{$model}/{$fabric_code}/{$size}");
        return InventoryItem::fromArray($data);
    }

    public function setByData(InventoryDataItem $item): InventoryDataItem
    {
        $data = $this->authenticatedPost('/inventory/data', $item->toArray());
        return InventoryDataItem::fromArray($data);
    }

    public function getByEan(string $ean13): InventoryItem
    {
        $data = $this->authenticatedGet("/inventory/ean/{$ean13}");
        return InventoryItem::fromArray($data);
    }

    public function setByEan(InventoryEANItem $item): InventoryEANItem
    {
        $data = $this->authenticatedPost('/inventory/ean', $item->toArray());
        return InventoryEANItem::fromArray($data);
    }

    public function getBySku(string $sku): InventoryItem
    {
        $data = $this->authenticatedGet("/inventory/sku/{$sku}");
        return InventoryItem::fromArray($data);
    }

    public function setBySku(InventorySKUItem $item): InventorySKUItem
    {
        $data = $this->authenticatedPost('/inventory/sku', $item->toArray());
        return InventorySKUItem::fromArray($data);
    }

    /**
     * @param InventoryDataItem[] $items
     */
    public function batchSetByData(array $items): BatchResponse
    {
        $body = array_map(fn(InventoryDataItem $i) => $i->toArray(), $items);
        return $this->batchPost('/multi/inventory/data', $body);
    }

    /**
     * @param InventoryEANItem[] $items
     */
    public function batchSetByEan(array $items): BatchResponse
    {
        $body = array_map(fn(InventoryEANItem $i) => $i->toArray(), $items);
        return $this->batchPost('/multi/inventory/ean', $body);
    }

    /**
     * @param InventorySKUItem[] $items
     */
    public function batchSetBySku(array $items): BatchResponse
    {
        $body = array_map(fn(InventorySKUItem $i) => $i->toArray(), $items);
        return $this->batchPost('/multi/inventory/sku', $body);
    }
}
