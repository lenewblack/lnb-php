<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\SalesDocument;

final class SetSalesDocumentRequest
{
    private string $document_number;
    private string $name;
    private string $category;
    private string $type;
    private ?string $comment = null;
    private ?string $issued_on = null;
    private ?string $due_on = null;
    private ?float $amount = null;
    private ?string $amount_currency_code = null;
    private ?string $shipper_ref = null;
    private ?string $shipper_name = null;
    private ?string $file_remote_url = null;
    private ?string $external_id = null;

    public function setDocumentNumber(string $document_number): self { $this->document_number = $document_number; return $this; }
    public function setName(string $name): self { $this->name = $name; return $this; }
    public function setCategory(string $category): self { $this->category = $category; return $this; }
    public function setType(string $type): self { $this->type = $type; return $this; }
    public function setComment(?string $comment): self { $this->comment = $comment; return $this; }
    public function setIssuedOn(?string $issued_on): self { $this->issued_on = $issued_on; return $this; }
    public function setDueOn(?string $due_on): self { $this->due_on = $due_on; return $this; }
    public function setAmount(?float $amount): self { $this->amount = $amount; return $this; }
    public function setAmountCurrencyCode(?string $amount_currency_code): self { $this->amount_currency_code = $amount_currency_code; return $this; }
    public function setShipperRef(?string $shipper_ref): self { $this->shipper_ref = $shipper_ref; return $this; }
    public function setShipperName(?string $shipper_name): self { $this->shipper_name = $shipper_name; return $this; }
    public function setFileRemoteUrl(?string $file_remote_url): self { $this->file_remote_url = $file_remote_url; return $this; }
    public function setExternalId(?string $external_id): self { $this->external_id = $external_id; return $this; }

    public function toArray(): array
    {
        return array_filter([
            'document_number' => $this->document_number,
            'name' => $this->name,
            'category' => $this->category,
            'type' => $this->type,
            'comment' => $this->comment,
            'issued_on' => $this->issued_on,
            'due_on' => $this->due_on,
            'amount' => $this->amount,
            'amount_currency_code' => $this->amount_currency_code,
            'shipper_ref' => $this->shipper_ref,
            'shipper_name' => $this->shipper_name,
            'file_remote_url' => $this->file_remote_url,
            'external_id' => $this->external_id,
        ], fn ($v) => $v !== null);
    }
}
