<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Tests\Integration;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use LeNewBlack\Wholesale\Client;
use PHPUnit\Framework\TestCase;

abstract class MockHttpTestCase extends TestCase
{
    protected MockHandler $mockHandler;
    protected array $requestHistory = [];
    protected Client $client;

    protected function setUpClient(array $responses = []): void
    {
        $authResponse = new Response(200, [], json_encode([
            'access_token' => 'test_token',
            'expire_on' => (new \DateTimeImmutable('+1 hour'))->format('Y-m-d H:i:s'),
            'scope' => 'brand',
            'token_type' => 'Bearer',
        ]));

        array_unshift($responses, $authResponse);

        $this->mockHandler = new MockHandler($responses);
        $handlerStack = HandlerStack::create($this->mockHandler);

        $history = Middleware::history($this->requestHistory);
        $handlerStack->push($history);

        $this->client = new Client(
            'test_id',
            'test_secret',
            'https://example.com/api',
            ['handler' => $handlerStack],
        );
    }

    protected function getLastRequestUri(): string
    {
        $request = end($this->requestHistory);
        return (string) $request['request']->getUri();
    }

    protected function getLastRequestBody(): array
    {
        $request = end($this->requestHistory);
        return json_decode((string) $request['request']->getBody(), true) ?? [];
    }
}
