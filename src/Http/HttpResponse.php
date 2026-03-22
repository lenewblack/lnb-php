<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Http;

final class HttpResponse
{
    /**
     * @param array $body    Decoded JSON body
     * @param array $headers Response headers (Guzzle format: string => string[])
     */
    public function __construct(
        public readonly array $body,
        public readonly array $headers,
    ) {}
}
