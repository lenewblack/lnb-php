<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Auth;

use LeNewBlack\Wholesale\Http\HttpClient;

final class TokenManager
{
    private ?string $accessToken = null;
    private ?\DateTimeImmutable $expiresAt = null;

    public function __construct(
        private readonly string $clientId,
        private readonly string $clientSecret,
        private readonly HttpClient $http,
        private readonly int $refreshBufferSeconds = 60,
    ) {}

    public function getToken(): string
    {
        if ($this->accessToken === null || $this->isExpired()) {
            $this->refresh();
        }

        return $this->accessToken;
    }

    private function isExpired(): bool
    {
        if ($this->expiresAt === null) {
            return true;
        }

        return $this->expiresAt <= new \DateTimeImmutable("+{$this->refreshBufferSeconds} seconds");
    }

    private function refresh(): void
    {
        $response = $this->http->postRaw('/auth/token', [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => 'client_credentials',
        ]);

        $this->accessToken = $response['access_token'];
        $this->expiresAt = new \DateTimeImmutable($response['expire_on']);
    }
}
