<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Retailer;

final class Address
{
    public function __construct(
        public readonly string $reference,
        public readonly string $company,
        public readonly string $country,
        public readonly ?string $contact_name = null,
        public readonly ?string $contact_email = null,
        public readonly ?string $tel = null,
        public readonly ?string $address_1 = null,
        public readonly ?string $address_2 = null,
        public readonly ?string $zipcode = null,
        public readonly ?string $city = null,
        public readonly ?string $vat_number = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            reference: $data['reference'] ?? '',
            company: $data['company'] ?? '',
            country: $data['country'] ?? '',
            contact_name: $data['contact_name'] ?? null,
            contact_email: $data['contact_email'] ?? null,
            tel: $data['tel'] ?? null,
            address_1: $data['address_1'] ?? null,
            address_2: $data['address_2'] ?? null,
            zipcode: $data['zipcode'] ?? null,
            city: $data['city'] ?? null,
            vat_number: $data['vat_number'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'reference' => $this->reference,
            'company' => $this->company,
            'country' => $this->country,
            'contact_name' => $this->contact_name,
            'contact_email' => $this->contact_email,
            'tel' => $this->tel,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'zipcode' => $this->zipcode,
            'city' => $this->city,
            'vat_number' => $this->vat_number,
        ], fn ($v) => $v !== null);
    }
}
