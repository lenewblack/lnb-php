<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model;

/**
 * @template T
 */
final class Page
{
    /**
     * @param T[] $items
     */
    public function __construct(
        public readonly array $items,
        public readonly int $page,
        public readonly bool $hasMore,
    ) {}

    /**
     * @template U
     * @param callable(array): U $mapper
     * @return Page<U>
     */
    public static function fromArray(array $data, callable $mapper, int $pageSize = 500, int $page = 1): self
    {
        $items = array_map($mapper, $data);

        return new self(
            items: $items,
            page: $page,
            hasMore: count($items) >= $pageSize,
        );
    }
}
