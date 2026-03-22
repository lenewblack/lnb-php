<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model;

use LeNewBlack\Wholesale\Http\HttpResponse;

/**
 * @template T
 * @implements \IteratorAggregate<int, T>
 */
final class ResultSet implements \IteratorAggregate, \Countable
{
    /**
     * @param T[] $data
     */
    public function __construct(
        public readonly array $data,
        public readonly ResultSetMetadata $metadata,
    ) {}

    /**
     * @return \ArrayIterator<int, T>
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->data);
    }

    public function count(): int
    {
        return count($this->data);
    }

    /**
     * Factory for paginated list() calls — reads X-Pagination-* response headers.
     * Falls back to the provided $page/$pageSize when headers are absent (e.g. before API update).
     *
     * @template U
     * @param callable(array): U $mapper
     * @return ResultSet<U>
     */
    public static function fromPagedResponse(
        HttpResponse $response,
        callable $mapper,
        int $page,
        int $pageSize,
        array $filters = [],
    ): self {
        $h = $response->headers;
        $intHeader = static fn(string $k): ?int => isset($h[$k][0]) ? (int) $h[$k][0] : null;
        $hasMore = isset($h['X-Pagination-Has-More'][0])
            ? $h['X-Pagination-Has-More'][0] === 'true'
            : null;

        return new self(
            data: array_map($mapper, $response->body),
            metadata: new ResultSetMetadata(
                page: $intHeader('X-Pagination-Current-Page') ?? $page,
                pageSize: $intHeader('X-Pagination-Page-Size') ?? $pageSize,
                hasMore: $hasMore,
                totalPages: $intHeader('X-Pagination-Total-Pages'),
                totalItems: $intHeader('X-Pagination-Total-Items'),
                filters: $filters,
            ),
        );
    }

    /**
     * Factory for non-paginated list() calls.
     *
     * @template U
     * @param callable(array): U $mapper
     * @return ResultSet<U>
     */
    public static function fromList(array $raw, callable $mapper, array $filters = []): self
    {
        return new self(
            data: array_map($mapper, $raw),
            metadata: new ResultSetMetadata(
                page: null,
                pageSize: null,
                hasMore: null,
                totalPages: null,
                totalItems: null,
                filters: $filters,
            ),
        );
    }
}
