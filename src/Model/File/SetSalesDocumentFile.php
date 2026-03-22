<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\File;

final class SetSalesDocumentFile
{
    private string $document_number;
    private string $file_path;

    public function setDocumentNumber(string $document_number): self { $this->document_number = $document_number; return $this; }
    public function setFilePath(string $file_path): self { $this->file_path = $file_path; return $this; }

    public function toMultipart(): array
    {
        return [
            ['name' => 'document_number', 'contents' => $this->document_number],
            ['name' => 'file', 'contents' => fopen($this->file_path, 'r'), 'filename' => basename($this->file_path)],
        ];
    }
}
