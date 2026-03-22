<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Product;

final class SetProductRequest
{
    private string $model;
    private string $name;
    private string $category_name;
    private string $collection_code;
    private string $collection_name;
    private string $sizing_name;
    /** @var string[] */
    private array $sizing_sizes = [];
    /** @var SetVariantRequest[] */
    private array $variants = [];
    private ?string $sub_category_name = null;
    private ?string $sub_sub_category_name = null;
    private ?bool $is_published = null;
    private ?bool $is_new = null;
    private ?bool $is_top = null;
    private ?int $order_min = null;
    private ?int $order_max = null;
    private ?int $order_multiple = null;
    private ?string $extra_1 = null;
    private ?string $extra_2 = null;
    private ?string $extra_3 = null;
    private ?string $extra_4 = null;
    private ?string $extra_5 = null;
    private ?string $extra_6 = null;
    private ?string $extra_7 = null;
    private ?string $extra_8 = null;
    private ?string $extra_9 = null;

    public function setModel(string $model): self { $this->model = $model; return $this; }
    public function setName(string $name): self { $this->name = $name; return $this; }
    public function setCategoryName(string $category_name): self { $this->category_name = $category_name; return $this; }
    public function setSubCategoryName(?string $sub_category_name): self { $this->sub_category_name = $sub_category_name; return $this; }
    public function setSubSubCategoryName(?string $sub_sub_category_name): self { $this->sub_sub_category_name = $sub_sub_category_name; return $this; }
    public function setCollectionCode(string $collection_code): self { $this->collection_code = $collection_code; return $this; }
    public function setCollectionName(string $collection_name): self { $this->collection_name = $collection_name; return $this; }
    public function setSizingName(string $sizing_name): self { $this->sizing_name = $sizing_name; return $this; }
    /** @param string[] $sizing_sizes */
    public function setSizingSizes(array $sizing_sizes): self { $this->sizing_sizes = $sizing_sizes; return $this; }
    public function setIsPublished(?bool $is_published): self { $this->is_published = $is_published; return $this; }
    public function setIsNew(?bool $is_new): self { $this->is_new = $is_new; return $this; }
    public function setIsTop(?bool $is_top): self { $this->is_top = $is_top; return $this; }
    public function setOrderMin(?int $order_min): self { $this->order_min = $order_min; return $this; }
    public function setOrderMax(?int $order_max): self { $this->order_max = $order_max; return $this; }
    public function setOrderMultiple(?int $order_multiple): self { $this->order_multiple = $order_multiple; return $this; }
    public function setExtra1(?string $extra_1): self { $this->extra_1 = $extra_1; return $this; }
    public function setExtra2(?string $extra_2): self { $this->extra_2 = $extra_2; return $this; }
    public function setExtra3(?string $extra_3): self { $this->extra_3 = $extra_3; return $this; }
    public function setExtra4(?string $extra_4): self { $this->extra_4 = $extra_4; return $this; }
    public function setExtra5(?string $extra_5): self { $this->extra_5 = $extra_5; return $this; }
    public function setExtra6(?string $extra_6): self { $this->extra_6 = $extra_6; return $this; }
    public function setExtra7(?string $extra_7): self { $this->extra_7 = $extra_7; return $this; }
    public function setExtra8(?string $extra_8): self { $this->extra_8 = $extra_8; return $this; }
    public function setExtra9(?string $extra_9): self { $this->extra_9 = $extra_9; return $this; }
    /** @param SetVariantRequest[] $variants */
    public function setVariants(array $variants): self { $this->variants = $variants; return $this; }

    public function toArray(): array
    {
        return array_filter([
            'model' => $this->model,
            'name' => $this->name,
            'category_name' => $this->category_name,
            'sub_category_name' => $this->sub_category_name,
            'sub_sub_category_name' => $this->sub_sub_category_name,
            'collection_code' => $this->collection_code,
            'collection_name' => $this->collection_name,
            'sizing_name' => $this->sizing_name,
            'sizing_sizes' => $this->sizing_sizes,
            'is_published' => $this->is_published,
            'is_new' => $this->is_new,
            'is_top' => $this->is_top,
            'order_min' => $this->order_min,
            'order_max' => $this->order_max,
            'order_multiple' => $this->order_multiple,
            'extra_1' => $this->extra_1,
            'extra_2' => $this->extra_2,
            'extra_3' => $this->extra_3,
            'extra_4' => $this->extra_4,
            'extra_5' => $this->extra_5,
            'extra_6' => $this->extra_6,
            'extra_7' => $this->extra_7,
            'extra_8' => $this->extra_8,
            'extra_9' => $this->extra_9,
            'variants' => array_map(fn(SetVariantRequest $v) => $v->toArray(), $this->variants),
        ], fn ($v) => $v !== null);
    }
}
