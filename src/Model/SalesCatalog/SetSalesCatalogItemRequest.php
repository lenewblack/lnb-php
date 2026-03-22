<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\SalesCatalog;

final class SetSalesCatalogItemRequest
{
    private string $sales_catalog_code;
    private string $product_model;
    private string $fabric_code;

    public function setSalesCatalogCode(string $sales_catalog_code): self { $this->sales_catalog_code = $sales_catalog_code; return $this; }
    public function setProductModel(string $product_model): self { $this->product_model = $product_model; return $this; }
    public function setFabricCode(string $fabric_code): self { $this->fabric_code = $fabric_code; return $this; }

    public function toArray(): array
    {
        return [
            'sales_catalog_code' => $this->sales_catalog_code,
            'product_model' => $this->product_model,
            'fabric_code' => $this->fabric_code,
        ];
    }
}
