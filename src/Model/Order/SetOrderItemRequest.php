<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Order;

final class SetOrderItemRequest
{
    private int $quantity;
    private ?string $model = null;
    private ?string $variant = null;
    private ?string $size = null;
    private ?string $ean13 = null;

    public function setQuantity(int $quantity): self { $this->quantity = $quantity; return $this; }
    public function setModel(?string $model): self { $this->model = $model; return $this; }
    public function setVariant(?string $variant): self { $this->variant = $variant; return $this; }
    public function setSize(?string $size): self { $this->size = $size; return $this; }
    public function setEan13(?string $ean13): self { $this->ean13 = $ean13; return $this; }

    public function toArray(): array
    {
        return array_filter([
            'model' => $this->model,
            'variant' => $this->variant,
            'size' => $this->size,
            'ean13' => $this->ean13,
            'quantity' => $this->quantity,
        ], fn ($v) => $v !== null);
    }
}
