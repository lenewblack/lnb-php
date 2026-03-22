<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Fabric;

final class SetFabricRequest
{
    private string $code;
    private string $name;
    private ?string $material_code = null;
    private ?string $color_code = null;
    private ?string $color_name = null;
    private ?string $external_name = null;

    public function setCode(string $code): self { $this->code = $code; return $this; }
    public function setName(string $name): self { $this->name = $name; return $this; }
    public function setMaterialCode(?string $material_code): self { $this->material_code = $material_code; return $this; }
    public function setColorCode(?string $color_code): self { $this->color_code = $color_code; return $this; }
    public function setColorName(?string $color_name): self { $this->color_name = $color_name; return $this; }
    public function setExternalName(?string $external_name): self { $this->external_name = $external_name; return $this; }

    public function toArray(): array
    {
        return array_filter([
            'code' => $this->code,
            'name' => $this->name,
            'material_code' => $this->material_code,
            'color_code' => $this->color_code,
            'color_name' => $this->color_name,
            'external_name' => $this->external_name,
        ], fn ($v) => $v !== null);
    }
}
