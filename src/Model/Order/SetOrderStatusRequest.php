<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Order;

final class SetOrderStatusRequest
{
    private string $reference;
    private string $status;

    public function setReference(string $reference): self { $this->reference = $reference; return $this; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }

    public function toArray(): array
    {
        return [
            'reference' => $this->reference,
            'status' => $this->status,
        ];
    }
}
