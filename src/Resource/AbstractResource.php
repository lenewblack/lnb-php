<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Resource;

use LeNewBlack\Wholesale\Auth\TokenManager;
use LeNewBlack\Wholesale\Http\HttpClient;
use LeNewBlack\Wholesale\Model\Batch\BatchResponse;

abstract class AbstractResource
{
    public function __construct(
        protected readonly HttpClient $http,
        protected readonly TokenManager $auth,
    ) {}

    protected function authenticatedGet(string $path, array $query = []): array
    {
        $query['access_token'] = $this->auth->getToken();
        return $this->http->get($path, $query);
    }

    protected function authenticatedPost(string $path, array $body, array $query = []): array
    {
        $query['access_token'] = $this->auth->getToken();
        return $this->http->post($path, $body, $query);
    }

    protected function authenticatedDelete(string $path, array $query = []): void
    {
        $query['access_token'] = $this->auth->getToken();
        $this->http->delete($path, $query);
    }

    protected function authenticatedMultipart(string $path, array $multipart, array $query = []): array
    {
        $query['access_token'] = $this->auth->getToken();
        return $this->http->postMultipart($path, $multipart, $query);
    }

    protected function batchPost(string $path, array $requests): BatchResponse
    {
        $data = $this->authenticatedPost($path, ['requests' => $requests]);
        return BatchResponse::fromArray($data);
    }
}
