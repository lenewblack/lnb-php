<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\SalesDocument;

final class SetSalesDocumentOrderRequest
{
    private string $action;
    private string $document_number;
    private string $order_reference;

    public function setAction(string $action): self { $this->action = $action; return $this; }
    public function setDocumentNumber(string $document_number): self { $this->document_number = $document_number; return $this; }
    public function setOrderReference(string $order_reference): self { $this->order_reference = $order_reference; return $this; }

    public function toArray(): array
    {
        return [
            'action' => $this->action,
            'document_number' => $this->document_number,
            'order_reference' => $this->order_reference,
        ];
    }
}
