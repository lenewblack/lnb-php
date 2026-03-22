<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\File;

final class SetProductImage
{
    private string $model;
    private string $fabric_code;
    private int $image_index;
    private string $file_path;

    public function setModel(string $model): self { $this->model = $model; return $this; }
    public function setFabricCode(string $fabric_code): self { $this->fabric_code = $fabric_code; return $this; }
    public function setImageIndex(int $image_index): self { $this->image_index = $image_index; return $this; }
    public function setFilePath(string $file_path): self { $this->file_path = $file_path; return $this; }

    public function toMultipart(): array
    {
        return [
            ['name' => 'model', 'contents' => $this->model],
            ['name' => 'fabric_code', 'contents' => $this->fabric_code],
            ['name' => 'image_index', 'contents' => (string) $this->image_index],
            ['name' => 'file', 'contents' => fopen($this->file_path, 'r'), 'filename' => basename($this->file_path)],
        ];
    }
}
