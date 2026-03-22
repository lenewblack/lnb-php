<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Product;

final class VariantExtended
{
    /**
     * @param VariantPrice[] $prices
     * @param VariantSalesCatalog[] $sales_catalogs
     * @param SKUItem[] $skus
     */
    public function __construct(
        public readonly ?string $create_time = null,
        public readonly ?string $update_time = null,
        public readonly ?string $fabric_code = null,
        public readonly ?string $fabric_name = null,
        public readonly ?string $fabric_color_code = null,
        public readonly ?string $fabric_color_name = null,
        public readonly ?string $fabric_image_url = null,
        public readonly bool $is_available = false,
        public readonly bool $is_blocked = false,
        public readonly bool $is_core = false,
        public readonly ?string $reference = null,
        public readonly ?string $care_instruction = null,
        public readonly ?string $composition = null,
        public readonly ?string $country_of_origin = null,
        public readonly ?string $customs_code = null,
        public readonly ?string $description = null,
        public readonly ?string $fabric_print = null,
        public readonly ?string $lining = null,
        public readonly ?string $dimensions = null,
        public readonly ?string $weight = null,
        public readonly ?string $available_on = null,
        public readonly ?string $show_looks = null,
        public readonly bool $showroom_availability = false,
        public readonly ?string $special_notice = null,
        public readonly ?string $video_url = null,
        public readonly ?string $image_360_url = null,
        public readonly ?string $image_1_url = null,
        public readonly ?string $image_2_url = null,
        public readonly ?string $image_3_url = null,
        public readonly ?string $image_4_url = null,
        public readonly ?string $image_5_url = null,
        public readonly ?string $image_6_url = null,
        public readonly ?string $image_7_url = null,
        public readonly ?string $image_8_url = null,
        public readonly array $prices = [],
        public readonly array $sales_catalogs = [],
        public readonly array $skus = [],
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            create_time: $data['create_time'] ?? null,
            update_time: $data['update_time'] ?? null,
            fabric_code: $data['fabric_code'] ?? null,
            fabric_name: $data['fabric_name'] ?? null,
            fabric_color_code: $data['fabric_color_code'] ?? null,
            fabric_color_name: $data['fabric_color_name'] ?? null,
            fabric_image_url: $data['fabric_image_url'] ?? null,
            is_available: $data['is_available'] ?? false,
            is_blocked: $data['is_blocked'] ?? false,
            is_core: $data['is_core'] ?? false,
            reference: $data['reference'] ?? null,
            care_instruction: $data['care_instruction'] ?? null,
            composition: $data['composition'] ?? null,
            country_of_origin: $data['country_of_origin'] ?? null,
            customs_code: $data['customs_code'] ?? null,
            description: $data['description'] ?? null,
            fabric_print: $data['fabric_print'] ?? null,
            lining: $data['lining'] ?? null,
            dimensions: $data['dimensions'] ?? null,
            weight: $data['weight'] ?? null,
            available_on: $data['available_on'] ?? null,
            show_looks: $data['show_looks'] ?? null,
            showroom_availability: $data['showroom_availability'] ?? false,
            special_notice: $data['special_notice'] ?? null,
            video_url: $data['video_url'] ?? null,
            image_360_url: $data['image_360_url'] ?? null,
            image_1_url: $data['image_1_url'] ?? null,
            image_2_url: $data['image_2_url'] ?? null,
            image_3_url: $data['image_3_url'] ?? null,
            image_4_url: $data['image_4_url'] ?? null,
            image_5_url: $data['image_5_url'] ?? null,
            image_6_url: $data['image_6_url'] ?? null,
            image_7_url: $data['image_7_url'] ?? null,
            image_8_url: $data['image_8_url'] ?? null,
            prices: array_map(VariantPrice::fromArray(...), $data['prices'] ?? []),
            sales_catalogs: array_map(VariantSalesCatalog::fromArray(...), $data['sales_catalogs'] ?? []),
            skus: array_map(SKUItem::fromArray(...), $data['skus'] ?? []),
        );
    }
}
