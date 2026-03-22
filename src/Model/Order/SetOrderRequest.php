<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Order;

final class SetOrderRequest
{
    private string $retailer_reference;
    /** @var SetOrderItemRequest[] */
    private array $items = [];
    private ?int $reference = null;
    private ?string $purchase_order_reference = null;
    private ?string $retailer_member_email = null;
    private ?string $assigned_collection_code = null;
    private ?string $order_type = null;

    public function setRetailerReference(string $retailer_reference): self { $this->retailer_reference = $retailer_reference; return $this; }
    /** @param SetOrderItemRequest[] $items */
    public function setItems(array $items): self { $this->items = $items; return $this; }
    public function setReference(?int $reference): self { $this->reference = $reference; return $this; }
    public function setPurchaseOrderReference(?string $purchase_order_reference): self { $this->purchase_order_reference = $purchase_order_reference; return $this; }
    public function setRetailerMemberEmail(?string $retailer_member_email): self { $this->retailer_member_email = $retailer_member_email; return $this; }
    public function setAssignedCollectionCode(?string $assigned_collection_code): self { $this->assigned_collection_code = $assigned_collection_code; return $this; }
    public function setOrderType(?string $order_type): self { $this->order_type = $order_type; return $this; }

    public function toArray(): array
    {
        return array_filter([
            'reference' => $this->reference,
            'retailer_reference' => $this->retailer_reference,
            'purchase_order_reference' => $this->purchase_order_reference,
            'retailer_member_email' => $this->retailer_member_email,
            'assigned_collection_code' => $this->assigned_collection_code,
            'order_type' => $this->order_type,
            'items' => array_map(fn(SetOrderItemRequest $i) => $i->toArray(), $this->items),
        ], fn ($v) => $v !== null);
    }
}
