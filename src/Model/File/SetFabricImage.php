<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\File;

final class SetFabricImage
{
    private string $fabric_code;
    private string $file_path;

    public function setFabricCode(string $fabric_code): self { $this->fabric_code = $fabric_code; return $this; }
    public function setFilePath(string $file_path): self { $this->file_path = $file_path; return $this; }

    public function toMultipart(): array
    {
        return [
            ['name' => 'fabric_code', 'contents' => $this->fabric_code],
            ['name' => 'file', 'contents' => fopen($this->file_path, 'r'), 'filename' => basename($this->file_path)],
        ];
    }
}
