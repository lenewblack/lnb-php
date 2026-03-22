<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Product;

final class SetVariantRequest
{
    private string $fabric_code;
    private string $fabric_name;
    private string $reference;
    private ?string $fabric_color_code = null;
    private ?string $fabric_color_name = null;
    private ?bool $is_available = null;
    private ?bool $is_blocked = null;
    private ?bool $is_core = null;
    private ?string $care_instruction = null;
    private ?string $composition = null;
    private ?string $country_of_origin = null;
    private ?string $customs_code = null;
    private ?string $description = null;
    private ?string $fabric_print = null;
    private ?string $lining = null;
    private ?string $dimensions = null;
    private ?string $weight = null;
    private ?string $available_on = null;
    private ?string $show_looks = null;
    private ?bool $showroom_availability = null;
    private ?string $special_notice = null;
    private ?string $video_url = null;
    private ?string $image_360_url = null;
    /** @var SetSKUItemRequest[] */
    private array $skus = [];

    public function setFabricCode(string $fabric_code): self { $this->fabric_code = $fabric_code; return $this; }
    public function setFabricName(string $fabric_name): self { $this->fabric_name = $fabric_name; return $this; }
    public function setReference(string $reference): self { $this->reference = $reference; return $this; }
    public function setFabricColorCode(?string $fabric_color_code): self { $this->fabric_color_code = $fabric_color_code; return $this; }
    public function setFabricColorName(?string $fabric_color_name): self { $this->fabric_color_name = $fabric_color_name; return $this; }
    public function setIsAvailable(?bool $is_available): self { $this->is_available = $is_available; return $this; }
    public function setIsBlocked(?bool $is_blocked): self { $this->is_blocked = $is_blocked; return $this; }
    public function setIsCore(?bool $is_core): self { $this->is_core = $is_core; return $this; }
    public function setCareInstruction(?string $care_instruction): self { $this->care_instruction = $care_instruction; return $this; }
    public function setComposition(?string $composition): self { $this->composition = $composition; return $this; }
    public function setCountryOfOrigin(?string $country_of_origin): self { $this->country_of_origin = $country_of_origin; return $this; }
    public function setCustomsCode(?string $customs_code): self { $this->customs_code = $customs_code; return $this; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }
    public function setFabricPrint(?string $fabric_print): self { $this->fabric_print = $fabric_print; return $this; }
    public function setLining(?string $lining): self { $this->lining = $lining; return $this; }
    public function setDimensions(?string $dimensions): self { $this->dimensions = $dimensions; return $this; }
    public function setWeight(?string $weight): self { $this->weight = $weight; return $this; }
    public function setAvailableOn(?string $available_on): self { $this->available_on = $available_on; return $this; }
    public function setShowLooks(?string $show_looks): self { $this->show_looks = $show_looks; return $this; }
    public function setShowroomAvailability(?bool $showroom_availability): self { $this->showroom_availability = $showroom_availability; return $this; }
    public function setSpecialNotice(?string $special_notice): self { $this->special_notice = $special_notice; return $this; }
    public function setVideoUrl(?string $video_url): self { $this->video_url = $video_url; return $this; }
    public function setImage360Url(?string $image_360_url): self { $this->image_360_url = $image_360_url; return $this; }
    /** @param SetSKUItemRequest[] $skus */
    public function setSkus(array $skus): self { $this->skus = $skus; return $this; }

    public function toArray(): array
    {
        return array_filter([
            'fabric_code' => $this->fabric_code,
            'fabric_name' => $this->fabric_name,
            'reference' => $this->reference,
            'fabric_color_code' => $this->fabric_color_code,
            'fabric_color_name' => $this->fabric_color_name,
            'is_available' => $this->is_available,
            'is_blocked' => $this->is_blocked,
            'is_core' => $this->is_core,
            'care_instruction' => $this->care_instruction,
            'composition' => $this->composition,
            'country_of_origin' => $this->country_of_origin,
            'customs_code' => $this->customs_code,
            'description' => $this->description,
            'fabric_print' => $this->fabric_print,
            'lining' => $this->lining,
            'dimensions' => $this->dimensions,
            'weight' => $this->weight,
            'available_on' => $this->available_on,
            'show_looks' => $this->show_looks,
            'showroom_availability' => $this->showroom_availability,
            'special_notice' => $this->special_notice,
            'video_url' => $this->video_url,
            'image_360_url' => $this->image_360_url,
            'skus' => !empty($this->skus) ? array_map(fn(SetSKUItemRequest $s) => $s->toArray(), $this->skus) : null,
        ], fn ($v) => $v !== null);
    }
}
