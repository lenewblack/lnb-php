<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Retailer;

final class SetRetailerRequest
{
    private string $reference;
    private string $name;
    private string $price_list_code;
    private Address $store_address;
    private ?string $company = null;
    private ?string $delivery_incoterm = null;
    private ?float $discount_rate = null;
    private ?float $discount_special_rate = null;
    private ?string $terms_of_delivery = null;
    private ?string $terms_of_payment = null;
    private ?string $access_status = null;
    private ?string $access_role_level = null;
    private ?string $contact_group = null;
    private ?string $sales_group = null;
    private ?string $sales_admin_email = null;
    private ?string $sales_rep_email = null;
    private ?string $extra_1 = null;
    private ?string $extra_2 = null;
    private ?string $extra_3 = null;
    private ?string $extra_4 = null;
    private ?string $extra_5 = null;
    private ?string $extra_6 = null;
    private ?string $extra_7 = null;
    private ?string $extra_8 = null;
    private ?string $extra_9 = null;
    private ?Address $billing_address = null;
    /** @var Address[] */
    private array $delivery_addresses = [];
    /** @var Buyer[] */
    private array $buyers = [];

    public function setReference(string $reference): self { $this->reference = $reference; return $this; }
    public function setName(string $name): self { $this->name = $name; return $this; }
    public function setPriceListCode(string $price_list_code): self { $this->price_list_code = $price_list_code; return $this; }
    public function setStoreAddress(Address $store_address): self { $this->store_address = $store_address; return $this; }
    public function setCompany(?string $company): self { $this->company = $company; return $this; }
    public function setDeliveryIncoterm(?string $delivery_incoterm): self { $this->delivery_incoterm = $delivery_incoterm; return $this; }
    public function setDiscountRate(?float $discount_rate): self { $this->discount_rate = $discount_rate; return $this; }
    public function setDiscountSpecialRate(?float $discount_special_rate): self { $this->discount_special_rate = $discount_special_rate; return $this; }
    public function setTermsOfDelivery(?string $terms_of_delivery): self { $this->terms_of_delivery = $terms_of_delivery; return $this; }
    public function setTermsOfPayment(?string $terms_of_payment): self { $this->terms_of_payment = $terms_of_payment; return $this; }
    public function setAccessStatus(?string $access_status): self { $this->access_status = $access_status; return $this; }
    public function setAccessRoleLevel(?string $access_role_level): self { $this->access_role_level = $access_role_level; return $this; }
    public function setContactGroup(?string $contact_group): self { $this->contact_group = $contact_group; return $this; }
    public function setSalesGroup(?string $sales_group): self { $this->sales_group = $sales_group; return $this; }
    public function setSalesAdminEmail(?string $sales_admin_email): self { $this->sales_admin_email = $sales_admin_email; return $this; }
    public function setSalesRepEmail(?string $sales_rep_email): self { $this->sales_rep_email = $sales_rep_email; return $this; }
    public function setExtra1(?string $extra_1): self { $this->extra_1 = $extra_1; return $this; }
    public function setExtra2(?string $extra_2): self { $this->extra_2 = $extra_2; return $this; }
    public function setExtra3(?string $extra_3): self { $this->extra_3 = $extra_3; return $this; }
    public function setExtra4(?string $extra_4): self { $this->extra_4 = $extra_4; return $this; }
    public function setExtra5(?string $extra_5): self { $this->extra_5 = $extra_5; return $this; }
    public function setExtra6(?string $extra_6): self { $this->extra_6 = $extra_6; return $this; }
    public function setExtra7(?string $extra_7): self { $this->extra_7 = $extra_7; return $this; }
    public function setExtra8(?string $extra_8): self { $this->extra_8 = $extra_8; return $this; }
    public function setExtra9(?string $extra_9): self { $this->extra_9 = $extra_9; return $this; }
    public function setBillingAddress(?Address $billing_address): self { $this->billing_address = $billing_address; return $this; }
    /** @param Address[] $delivery_addresses */
    public function setDeliveryAddresses(array $delivery_addresses): self { $this->delivery_addresses = $delivery_addresses; return $this; }
    /** @param Buyer[] $buyers */
    public function setBuyers(array $buyers): self { $this->buyers = $buyers; return $this; }

    public function toArray(): array
    {
        return array_filter([
            'reference' => $this->reference,
            'name' => $this->name,
            'company' => $this->company,
            'price_list_code' => $this->price_list_code,
            'delivery_incoterm' => $this->delivery_incoterm,
            'discount_rate' => $this->discount_rate,
            'discount_special_rate' => $this->discount_special_rate,
            'terms_of_delivery' => $this->terms_of_delivery,
            'terms_of_payment' => $this->terms_of_payment,
            'access_status' => $this->access_status,
            'access_role_level' => $this->access_role_level,
            'contact_group' => $this->contact_group,
            'sales_group' => $this->sales_group,
            'sales_admin_email' => $this->sales_admin_email,
            'sales_rep_email' => $this->sales_rep_email,
            'extra_1' => $this->extra_1,
            'extra_2' => $this->extra_2,
            'extra_3' => $this->extra_3,
            'extra_4' => $this->extra_4,
            'extra_5' => $this->extra_5,
            'extra_6' => $this->extra_6,
            'extra_7' => $this->extra_7,
            'extra_8' => $this->extra_8,
            'extra_9' => $this->extra_9,
            'store_address' => isset($this->store_address) ? $this->store_address->toArray() : null,
            'billing_address' => $this->billing_address?->toArray(),
            'delivery_addresses' => !empty($this->delivery_addresses) ? array_map(fn(Address $a) => $a->toArray(), $this->delivery_addresses) : null,
            'buyers' => !empty($this->buyers) ? array_map(fn(Buyer $b) => $b->toArray(), $this->buyers) : null,
        ], fn ($v) => $v !== null);
    }
}
