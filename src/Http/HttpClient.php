<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Http;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use LeNewBlack\Wholesale\Exception\ApiException;
use LeNewBlack\Wholesale\Exception\AuthenticationException;
use LeNewBlack\Wholesale\Exception\NotFoundException;
use LeNewBlack\Wholesale\Exception\RateLimitException;
use LeNewBlack\Wholesale\Exception\ValidationException;

final class HttpClient
{
    private readonly GuzzleClient $guzzle;

    public function __construct(
        private readonly string $baseUrl,
        array $guzzleOptions = [],
        string $sdkVersion = '0.0.0',
    ) {
        $this->guzzle = new GuzzleClient(array_merge([
            'base_uri' => rtrim($baseUrl, '/') . '/',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'User-Agent' => 'lenewblack-php-sdk/' . $sdkVersion,
            ],
        ], $guzzleOptions));
    }

    public function get(string $path, array $query = []): array
    {
        return $this->request('GET', $path, ['query' => $query]);
    }

    public function post(string $path, array $body, array $query = []): array
    {
        return $this->request('POST', $path, [
            'json' => $body,
            'query' => $query,
        ]);
    }

    public function postRaw(string $path, array $body): array
    {
        return $this->request('POST', $path, ['json' => $body]);
    }

    public function delete(string $path, array $query = []): void
    {
        $this->request('DELETE', $path, ['query' => $query]);
    }

    public function postMultipart(string $path, array $multipart, array $query = []): array
    {
        return $this->request('POST', $path, [
            'multipart' => $multipart,
            'query' => $query,
            'headers' => ['Content-Type' => null],
        ]);
    }

    private function request(string $method, string $path, array $options): array
    {
        $path = ltrim($path, '/');

        try {
            $response = $this->guzzle->request($method, $path, $options);
            $body = (string) $response->getBody();

            if ($body === '') {
                return [];
            }

            return json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $body = json_decode((string) $response->getBody(), true) ?: [];
            $message = $body['message'] ?? $body['error'] ?? $e->getMessage();

            throw match ($statusCode) {
                401 => new AuthenticationException($message, $statusCode, $body, $e),
                404 => new NotFoundException($message, $statusCode, $body, $e),
                422 => new ValidationException($message, $statusCode, $body, $e),
                429 => new RateLimitException($message, $statusCode, $body, $e),
                default => new ApiException($message, $statusCode, $body, $e),
            };
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            throw new ApiException($e->getMessage(), 0, null, $e);
        }
    }
}
