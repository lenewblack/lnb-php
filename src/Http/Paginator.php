<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Http;

use LeNewBlack\Wholesale\Model\Page;

final class Paginator
{
    /**
     * @template T
     * @param callable(int): Page<T> $fetcher
     * @return \Generator<T>
     */
    public static function paginate(callable $fetcher): \Generator
    {
        $page = 1;
        do {
            $result = $fetcher($page);
            foreach ($result->items as $item) {
                yield $item;
            }
            $page++;
        } while ($result->hasMore);
    }
}
