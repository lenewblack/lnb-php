<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Collection;

final class SetCollectionRequest
{
    private string $code;
    private string $name;
    private string $status;
    private ?string $line_name = null;
    private ?string $season_name = null;
    private ?string $privacy_level = null;
    private ?bool $enable_inventory = null;
    private ?string $order_type = null;
    private ?string $close_on = null;
    private ?string $delivery_start_on = null;
    private ?string $delivery_end_on = null;
    private ?string $payment_terms = null;
    private ?string $extra_1 = null;
    private ?string $extra_2 = null;
    private ?string $extra_3 = null;
    private ?string $extra_4 = null;
    private ?string $extra_5 = null;
    private ?string $extra_6 = null;
    private ?string $extra_7 = null;
    private ?string $extra_8 = null;
    private ?string $extra_9 = null;

    public function setCode(string $code): self { $this->code = $code; return $this; }
    public function setName(string $name): self { $this->name = $name; return $this; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }
    public function setLineName(?string $line_name): self { $this->line_name = $line_name; return $this; }
    public function setSeasonName(?string $season_name): self { $this->season_name = $season_name; return $this; }
    public function setPrivacyLevel(?string $privacy_level): self { $this->privacy_level = $privacy_level; return $this; }
    public function setEnableInventory(?bool $enable_inventory): self { $this->enable_inventory = $enable_inventory; return $this; }
    public function setOrderType(?string $order_type): self { $this->order_type = $order_type; return $this; }
    public function setCloseOn(?string $close_on): self { $this->close_on = $close_on; return $this; }
    public function setDeliveryStartOn(?string $delivery_start_on): self { $this->delivery_start_on = $delivery_start_on; return $this; }
    public function setDeliveryEndOn(?string $delivery_end_on): self { $this->delivery_end_on = $delivery_end_on; return $this; }
    public function setPaymentTerms(?string $payment_terms): self { $this->payment_terms = $payment_terms; return $this; }
    public function setExtra1(?string $extra_1): self { $this->extra_1 = $extra_1; return $this; }
    public function setExtra2(?string $extra_2): self { $this->extra_2 = $extra_2; return $this; }
    public function setExtra3(?string $extra_3): self { $this->extra_3 = $extra_3; return $this; }
    public function setExtra4(?string $extra_4): self { $this->extra_4 = $extra_4; return $this; }
    public function setExtra5(?string $extra_5): self { $this->extra_5 = $extra_5; return $this; }
    public function setExtra6(?string $extra_6): self { $this->extra_6 = $extra_6; return $this; }
    public function setExtra7(?string $extra_7): self { $this->extra_7 = $extra_7; return $this; }
    public function setExtra8(?string $extra_8): self { $this->extra_8 = $extra_8; return $this; }
    public function setExtra9(?string $extra_9): self { $this->extra_9 = $extra_9; return $this; }

    public function toArray(): array
    {
        return array_filter([
            'code' => $this->code,
            'name' => $this->name,
            'status' => $this->status,
            'line_name' => $this->line_name,
            'season_name' => $this->season_name,
            'privacy_level' => $this->privacy_level,
            'enable_inventory' => $this->enable_inventory,
            'order_type' => $this->order_type,
            'close_on' => $this->close_on,
            'delivery_start_on' => $this->delivery_start_on,
            'delivery_end_on' => $this->delivery_end_on,
            'payment_terms' => $this->payment_terms,
            'extra_1' => $this->extra_1,
            'extra_2' => $this->extra_2,
            'extra_3' => $this->extra_3,
            'extra_4' => $this->extra_4,
            'extra_5' => $this->extra_5,
            'extra_6' => $this->extra_6,
            'extra_7' => $this->extra_7,
            'extra_8' => $this->extra_8,
            'extra_9' => $this->extra_9,
        ], fn ($v) => $v !== null);
    }
}
