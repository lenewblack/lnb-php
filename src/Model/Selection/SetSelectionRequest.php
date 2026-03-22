<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Selection;

final class SetSelectionRequest
{
    private string $retailer_reference;
    /** @var SetSelectionItemRequest[] */
    private array $items = [];
    private ?int $selection_id = null;
    private ?string $selection_refrence = null;
    private ?string $buyer_email = null;

    public function setRetailerReference(string $retailer_reference): self { $this->retailer_reference = $retailer_reference; return $this; }
    /** @param SetSelectionItemRequest[] $items */
    public function setItems(array $items): self { $this->items = $items; return $this; }
    public function setSelectionId(?int $selection_id): self { $this->selection_id = $selection_id; return $this; }
    public function setSelectionRefrence(?string $selection_refrence): self { $this->selection_refrence = $selection_refrence; return $this; }
    public function setBuyerEmail(?string $buyer_email): self { $this->buyer_email = $buyer_email; return $this; }

    public function toArray(): array
    {
        return array_filter([
            'selection_id' => $this->selection_id,
            'selection_refrence' => $this->selection_refrence,
            'retailer_reference' => $this->retailer_reference,
            'buyer_email' => $this->buyer_email,
            'items' => array_map(fn(SetSelectionItemRequest $i) => $i->toArray(), $this->items),
        ], fn ($v) => $v !== null);
    }
}
