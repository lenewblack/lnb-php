<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Product;

final class SetSKUItemRequest
{
    private string $size_name;
    private ?string $ean13 = null;
    private ?string $sku = null;
    private ?string $extra_1 = null;
    private ?bool $is_blocked = null;
    private ?int $external_size_position = null;

    public function setSizeName(string $size_name): self { $this->size_name = $size_name; return $this; }
    public function setEan13(?string $ean13): self { $this->ean13 = $ean13; return $this; }
    public function setSku(?string $sku): self { $this->sku = $sku; return $this; }
    public function setExtra1(?string $extra_1): self { $this->extra_1 = $extra_1; return $this; }
    public function setIsBlocked(?bool $is_blocked): self { $this->is_blocked = $is_blocked; return $this; }
    public function setExternalSizePosition(?int $external_size_position): self { $this->external_size_position = $external_size_position; return $this; }

    public function toArray(): array
    {
        return array_filter([
            'size_name' => $this->size_name,
            'ean13' => $this->ean13,
            'sku' => $this->sku,
            'extra_1' => $this->extra_1,
            'is_blocked' => $this->is_blocked,
            'external_size_position' => $this->external_size_position,
        ], fn ($v) => $v !== null);
    }
}
