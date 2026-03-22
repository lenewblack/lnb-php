<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model\Auth;

final class AuthTokenRequest
{
    private string $client_id;
    private string $client_secret;
    private string $grant_type = 'client_credentials';

    public function setClientId(string $client_id): self
    {
        $this->client_id = $client_id;
        return $this;
    }

    public function setClientSecret(string $client_secret): self
    {
        $this->client_secret = $client_secret;
        return $this;
    }

    public function setGrantType(string $grant_type): self
    {
        $this->grant_type = $grant_type;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'grant_type' => $this->grant_type,
        ];
    }
}
