<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Tests\Unit\Http;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use LeNewBlack\Wholesale\Exception\AuthenticationException;
use LeNewBlack\Wholesale\Exception\NotFoundException;
use LeNewBlack\Wholesale\Exception\ValidationException;
use LeNewBlack\Wholesale\Http\HttpClient;
use PHPUnit\Framework\TestCase;

final class HttpClientTest extends TestCase
{
    private function createClientWithMock(array $responses): HttpClient
    {
        $mock = new MockHandler($responses);
        $handlerStack = HandlerStack::create($mock);

        return new HttpClient(
            'https://example.com/api',
            ['handler' => $handlerStack],
        );
    }

    public function testGetReturnsDecodedJson(): void
    {
        $client = $this->createClientWithMock([
            new Response(200, [], json_encode(['key' => 'value'])),
        ]);

        $result = $client->get('/test');

        $this->assertSame(['key' => 'value'], $result);
    }

    public function testPostSendsJsonBody(): void
    {
        $client = $this->createClientWithMock([
            new Response(201, [], json_encode(['id' => 1])),
        ]);

        $result = $client->post('/test', ['name' => 'foo'], ['token' => 'abc']);

        $this->assertSame(['id' => 1], $result);
    }

    public function testDeleteReturnsEmpty(): void
    {
        $client = $this->createClientWithMock([
            new Response(204, [], ''),
        ]);

        $client->delete('/test');

        $this->assertTrue(true);
    }

    public function test401ThrowsAuthenticationException(): void
    {
        $client = $this->createClientWithMock([
            new Response(401, [], json_encode(['message' => 'Invalid credentials'])),
        ]);

        $this->expectException(AuthenticationException::class);
        $this->expectExceptionMessage('Invalid credentials');

        $client->get('/test');
    }

    public function test404ThrowsNotFoundException(): void
    {
        $client = $this->createClientWithMock([
            new Response(404, [], json_encode(['message' => 'Not found'])),
        ]);

        $this->expectException(NotFoundException::class);

        $client->get('/test');
    }

    public function test422ThrowsValidationException(): void
    {
        $client = $this->createClientWithMock([
            new Response(422, [], json_encode(['message' => 'Validation failed'])),
        ]);

        $this->expectException(ValidationException::class);

        $client->post('/test', ['invalid' => 'data']);
    }
}
