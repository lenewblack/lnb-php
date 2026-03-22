<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Order;

final class SetArchiveOrderRequest
{
    private string $purchase_order_reference;
    private string $retailer_reference;
    /** @var SetArchiveOrderItemRequest[] */
    private array $items = [];
    private ?string $retailer_member_email = null;
    private ?string $assigned_collection_code = null;
    private ?string $order_mode = null;
    private ?string $order_type = null;

    public function setPurchaseOrderReference(string $purchase_order_reference): self { $this->purchase_order_reference = $purchase_order_reference; return $this; }
    public function setRetailerReference(string $retailer_reference): self { $this->retailer_reference = $retailer_reference; return $this; }
    /** @param SetArchiveOrderItemRequest[] $items */
    public function setItems(array $items): self { $this->items = $items; return $this; }
    public function setRetailerMemberEmail(?string $retailer_member_email): self { $this->retailer_member_email = $retailer_member_email; return $this; }
    public function setAssignedCollectionCode(?string $assigned_collection_code): self { $this->assigned_collection_code = $assigned_collection_code; return $this; }
    public function setOrderMode(?string $order_mode): self { $this->order_mode = $order_mode; return $this; }
    public function setOrderType(?string $order_type): self { $this->order_type = $order_type; return $this; }

    public function toArray(): array
    {
        return array_filter([
            'purchase_order_reference' => $this->purchase_order_reference,
            'retailer_reference' => $this->retailer_reference,
            'retailer_member_email' => $this->retailer_member_email,
            'assigned_collection_code' => $this->assigned_collection_code,
            'order_mode' => $this->order_mode,
            'order_type' => $this->order_type,
            'items' => array_map(fn(SetArchiveOrderItemRequest $i) => $i->toArray(), $this->items),
        ], fn ($v) => $v !== null);
    }
}
