<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Order;

final class SetArchiveOrderItemRequest
{
    private int $quantity;
    private ?string $model = null;
    private ?string $product_name = null;
    private ?string $variant = null;
    private ?string $reference = null;
    private ?string $size = null;

    public function setQuantity(int $quantity): self { $this->quantity = $quantity; return $this; }
    public function setModel(?string $model): self { $this->model = $model; return $this; }
    public function setProductName(?string $product_name): self { $this->product_name = $product_name; return $this; }
    public function setVariant(?string $variant): self { $this->variant = $variant; return $this; }
    public function setReference(?string $reference): self { $this->reference = $reference; return $this; }
    public function setSize(?string $size): self { $this->size = $size; return $this; }

    public function toArray(): array
    {
        return array_filter([
            'model' => $this->model,
            'product_name' => $this->product_name,
            'variant' => $this->variant,
            'reference' => $this->reference,
            'size' => $this->size,
            'quantity' => $this->quantity,
        ], fn ($v) => $v !== null);
    }
}
