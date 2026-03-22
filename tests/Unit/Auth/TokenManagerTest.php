<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Tests\Unit\Auth;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use LeNewBlack\Wholesale\Auth\TokenManager;
use LeNewBlack\Wholesale\Http\HttpClient;
use PHPUnit\Framework\TestCase;

final class TokenManagerTest extends TestCase
{
    private function createHttpClient(array $responses): HttpClient
    {
        $mock = new MockHandler($responses);
        $handlerStack = HandlerStack::create($mock);
        return new HttpClient('https://example.com/api', ['handler' => $handlerStack]);
    }

    public function testGetTokenFetchesOnFirstCall(): void
    {
        $http = $this->createHttpClient([
            new Response(200, [], json_encode([
                'access_token' => 'abc123',
                'expire_on' => (new \DateTimeImmutable('+1 hour'))->format('Y-m-d H:i:s'),
                'scope' => 'brand',
                'token_type' => 'Bearer',
            ])),
        ]);

        $manager = new TokenManager('test_id', 'test_secret', $http);

        $this->assertSame('abc123', $manager->getToken());
    }

    public function testGetTokenCachesResult(): void
    {
        $http = $this->createHttpClient([
            new Response(200, [], json_encode([
                'access_token' => 'abc123',
                'expire_on' => (new \DateTimeImmutable('+1 hour'))->format('Y-m-d H:i:s'),
                'scope' => 'brand',
                'token_type' => 'Bearer',
            ])),
        ]);

        $manager = new TokenManager('test_id', 'test_secret', $http);

        $this->assertSame('abc123', $manager->getToken());
        $this->assertSame('abc123', $manager->getToken());
    }

    public function testGetTokenRefreshesWhenExpired(): void
    {
        $http = $this->createHttpClient([
            new Response(200, [], json_encode([
                'access_token' => 'token1',
                'expire_on' => (new \DateTimeImmutable('-1 minute'))->format('Y-m-d H:i:s'),
                'scope' => 'brand',
                'token_type' => 'Bearer',
            ])),
            new Response(200, [], json_encode([
                'access_token' => 'token2',
                'expire_on' => (new \DateTimeImmutable('+1 hour'))->format('Y-m-d H:i:s'),
                'scope' => 'brand',
                'token_type' => 'Bearer',
            ])),
        ]);

        $manager = new TokenManager('test_id', 'test_secret', $http, 0);

        $this->assertSame('token1', $manager->getToken());
        $this->assertSame('token2', $manager->getToken());
    }
}
