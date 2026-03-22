<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Sizing;

final class SetSizingRequest
{
    private string $code;
    private string $name;
    private string $size_1;
    private ?string $description = null;
    private ?string $size_2 = null;
    private ?string $size_3 = null;
    private ?string $size_4 = null;
    private ?string $size_5 = null;
    private ?string $size_6 = null;
    private ?string $size_7 = null;
    private ?string $size_8 = null;
    private ?string $size_9 = null;
    private ?string $size_10 = null;
    private ?string $size_11 = null;
    private ?string $size_12 = null;
    private ?string $size_13 = null;
    private ?string $size_14 = null;
    private ?string $size_15 = null;
    private ?string $size_16 = null;
    private ?string $size_17 = null;
    private ?string $size_18 = null;
    private ?string $size_19 = null;
    private ?string $size_20 = null;

    public function setCode(string $code): self { $this->code = $code; return $this; }
    public function setName(string $name): self { $this->name = $name; return $this; }
    public function setSize1(string $size_1): self { $this->size_1 = $size_1; return $this; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }
    public function setSize2(?string $size_2): self { $this->size_2 = $size_2; return $this; }
    public function setSize3(?string $size_3): self { $this->size_3 = $size_3; return $this; }
    public function setSize4(?string $size_4): self { $this->size_4 = $size_4; return $this; }
    public function setSize5(?string $size_5): self { $this->size_5 = $size_5; return $this; }
    public function setSize6(?string $size_6): self { $this->size_6 = $size_6; return $this; }
    public function setSize7(?string $size_7): self { $this->size_7 = $size_7; return $this; }
    public function setSize8(?string $size_8): self { $this->size_8 = $size_8; return $this; }
    public function setSize9(?string $size_9): self { $this->size_9 = $size_9; return $this; }
    public function setSize10(?string $size_10): self { $this->size_10 = $size_10; return $this; }
    public function setSize11(?string $size_11): self { $this->size_11 = $size_11; return $this; }
    public function setSize12(?string $size_12): self { $this->size_12 = $size_12; return $this; }
    public function setSize13(?string $size_13): self { $this->size_13 = $size_13; return $this; }
    public function setSize14(?string $size_14): self { $this->size_14 = $size_14; return $this; }
    public function setSize15(?string $size_15): self { $this->size_15 = $size_15; return $this; }
    public function setSize16(?string $size_16): self { $this->size_16 = $size_16; return $this; }
    public function setSize17(?string $size_17): self { $this->size_17 = $size_17; return $this; }
    public function setSize18(?string $size_18): self { $this->size_18 = $size_18; return $this; }
    public function setSize19(?string $size_19): self { $this->size_19 = $size_19; return $this; }
    public function setSize20(?string $size_20): self { $this->size_20 = $size_20; return $this; }

    public function toArray(): array
    {
        return array_filter([
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'size_1' => $this->size_1,
            'size_2' => $this->size_2,
            'size_3' => $this->size_3,
            'size_4' => $this->size_4,
            'size_5' => $this->size_5,
            'size_6' => $this->size_6,
            'size_7' => $this->size_7,
            'size_8' => $this->size_8,
            'size_9' => $this->size_9,
            'size_10' => $this->size_10,
            'size_11' => $this->size_11,
            'size_12' => $this->size_12,
            'size_13' => $this->size_13,
            'size_14' => $this->size_14,
            'size_15' => $this->size_15,
            'size_16' => $this->size_16,
            'size_17' => $this->size_17,
            'size_18' => $this->size_18,
            'size_19' => $this->size_19,
            'size_20' => $this->size_20,
        ], fn ($v) => $v !== null);
    }
}
