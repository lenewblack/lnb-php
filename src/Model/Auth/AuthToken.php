<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Auth;

final class AuthToken
{
    public function __construct(
        public readonly string $access_token,
        public readonly string $expire_on,
        public readonly string $scope,
        public readonly string $token_type,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            access_token: $data['access_token'] ?? '',
            expire_on: $data['expire_on'] ?? '',
            scope: $data['scope'] ?? '',
            token_type: $data['token_type'] ?? '',
        );
    }
}
