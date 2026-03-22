<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Product;

final class Product
{
    /**
     * @param string[] $sizing_sizes
     * @param VariantExtended[] $variants
     */
    public function __construct(
        public readonly string $model,
        public readonly string $name,
        public readonly ?string $create_time = null,
        public readonly ?string $update_time = null,
        public readonly ?string $category_name = null,
        public readonly ?string $sub_category_name = null,
        public readonly ?string $sub_sub_category_name = null,
        public readonly ?string $collection_code = null,
        public readonly ?string $collection_name = null,
        public readonly ?string $sizing_name = null,
        public readonly array $sizing_sizes = [],
        public readonly ?int $rank_in_category = null,
        public readonly bool $has_core_variant = false,
        public readonly bool $is_published = false,
        public readonly bool $is_new = false,
        public readonly bool $is_top = false,
        public readonly ?int $order_min = null,
        public readonly ?int $order_max = null,
        public readonly ?int $order_multiple = null,
        public readonly ?string $extra_1 = null,
        public readonly ?string $extra_2 = null,
        public readonly ?string $extra_3 = null,
        public readonly ?string $extra_4 = null,
        public readonly ?string $extra_5 = null,
        public readonly ?string $extra_6 = null,
        public readonly ?string $extra_7 = null,
        public readonly ?string $extra_8 = null,
        public readonly ?string $extra_9 = null,
        public readonly ?string $popin_url = null,
        public readonly array $variants = [],
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            model: $data['model'] ?? '',
            name: $data['name'] ?? '',
            create_time: $data['create_time'] ?? null,
            update_time: $data['update_time'] ?? null,
            category_name: $data['category_name'] ?? null,
            sub_category_name: $data['sub_category_name'] ?? null,
            sub_sub_category_name: $data['sub_sub_category_name'] ?? null,
            collection_code: $data['collection_code'] ?? null,
            collection_name: $data['collection_name'] ?? null,
            sizing_name: $data['sizing_name'] ?? null,
            sizing_sizes: $data['sizing_sizes'] ?? [],
            rank_in_category: $data['rank_in_category'] ?? null,
            has_core_variant: $data['has_core_variant'] ?? false,
            is_published: $data['is_published'] ?? false,
            is_new: $data['is_new'] ?? false,
            is_top: $data['is_top'] ?? false,
            order_min: $data['order_min'] ?? null,
            order_max: $data['order_max'] ?? null,
            order_multiple: $data['order_multiple'] ?? null,
            extra_1: $data['extra_1'] ?? null,
            extra_2: $data['extra_2'] ?? null,
            extra_3: $data['extra_3'] ?? null,
            extra_4: $data['extra_4'] ?? null,
            extra_5: $data['extra_5'] ?? null,
            extra_6: $data['extra_6'] ?? null,
            extra_7: $data['extra_7'] ?? null,
            extra_8: $data['extra_8'] ?? null,
            extra_9: $data['extra_9'] ?? null,
            popin_url: $data['popin_url'] ?? null,
            variants: array_map(VariantExtended::fromArray(...), $data['variants'] ?? []),
        );
    }
}
