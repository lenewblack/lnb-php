<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Http;

use LeNewBlack\Wholesale\Model\ResultSet;

final class Paginator
{
    /**
     * @template T
     * @param callable(int): ResultSet<T> $fetcher
     * @return \Generator<T>
     */
    public static function paginate(callable $fetcher): \Generator
    {
        $page = 1;
        do {
            $result = $fetcher($page);
            foreach ($result->data as $item) {
                yield $item;
            }
            $page++;
            $meta = $result->metadata;
            // Use hasMore from response headers when available; fall back to
            // count-based heuristic while headers aren't yet sent by the API.
            $continue = $meta->hasMore ?? (
                !empty($result->data) && count($result->data) >= $meta->pageSize
            );
        } while ($continue);
    }
}
