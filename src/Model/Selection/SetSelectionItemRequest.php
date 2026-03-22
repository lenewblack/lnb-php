<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Selection;

final class SetSelectionItemRequest
{
    private string $collection_code;
    private string $model;
    private string $variant;

    public function setCollectionCode(string $collection_code): self { $this->collection_code = $collection_code; return $this; }
    public function setModel(string $model): self { $this->model = $model; return $this; }
    public function setVariant(string $variant): self { $this->variant = $variant; return $this; }

    public function toArray(): array
    {
        return [
            'collection_code' => $this->collection_code,
            'model' => $this->model,
            'variant' => $this->variant,
        ];
    }
}
