<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Resource;

use LeNewBlack\Wholesale\Model\File\SetFabricImage;
use LeNewBlack\Wholesale\Model\File\SetProductImage;
use LeNewBlack\Wholesale\Model\File\SetSalesDocumentFile;

final class FileResource extends AbstractResource
{
    public function uploadProductImage(SetProductImage $request): array
    {
        return $this->authenticatedMultipart('/files/products', $request->toMultipart());
    }

    public function deleteProductImage(string $model, string $fabric_code, int $image_index): void
    {
        $this->authenticatedDelete("/files/products/{$model}/{$fabric_code}/{$image_index}");
    }

    public function uploadFabricImage(SetFabricImage $request): array
    {
        return $this->authenticatedMultipart('/files/fabrics', $request->toMultipart());
    }

    public function deleteFabricImage(string $fabric_code): void
    {
        $this->authenticatedDelete("/files/fabrics/{$fabric_code}");
    }

    public function uploadSalesDocumentFile(SetSalesDocumentFile $request): array
    {
        return $this->authenticatedMultipart('/files/sales_documents', $request->toMultipart());
    }

    public function deleteSalesDocumentFile(string $document_number): void
    {
        $this->authenticatedDelete("/files/sales_documents/{$document_number}");
    }
}
