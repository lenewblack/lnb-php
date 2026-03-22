<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Tests\Integration;

use GuzzleHttp\Psr7\Response;

final class AuthFlowTest extends MockHttpTestCase
{
    public function testAutoAuthenticatesOnFirstRequest(): void
    {
        $this->setUpClient([
            new Response(200, [], json_encode([
                ['code' => 'SS25', 'name' => 'Spring Summer 2025'],
            ])),
        ]);

        $result = $this->client->collections()->list();

        $this->assertCount(1, $result->data);
        $this->assertSame('SS25', $result->data[0]->code);

        // First request is auth, second is the actual API call
        $this->assertCount(2, $this->requestHistory);

        // Verify auth request
        $authRequest = $this->requestHistory[0]['request'];
        $this->assertStringContainsString('/auth/token', (string) $authRequest->getUri());

        // Verify token was passed to API call
        $apiRequest = $this->requestHistory[1]['request'];
        $this->assertStringContainsString('access_token=test_token', (string) $apiRequest->getUri());
    }
}
