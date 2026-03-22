<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Retailer;

final class Buyer
{
    public function __construct(
        public readonly string $email,
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $gender,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            email: $data['email'] ?? '',
            first_name: $data['first_name'] ?? '',
            last_name: $data['last_name'] ?? '',
            gender: $data['gender'] ?? '',
        );
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
        ];
    }
}
