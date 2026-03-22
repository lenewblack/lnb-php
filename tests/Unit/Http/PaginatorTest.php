<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Tests\Unit\Http;

use LeNewBlack\Wholesale\Http\Paginator;
use LeNewBlack\Wholesale\Model\Page;
use PHPUnit\Framework\TestCase;

final class PaginatorTest extends TestCase
{
    public function testPaginatesSinglePage(): void
    {
        $fetcher = function (int $page): Page {
            $this->assertSame(1, $page);
            return new Page(items: ['a', 'b', 'c'], page: 1, hasMore: false);
        };

        $items = iterator_to_array(Paginator::paginate($fetcher));

        $this->assertSame(['a', 'b', 'c'], $items);
    }

    public function testPaginatesMultiplePages(): void
    {
        $calls = 0;
        $fetcher = function (int $page) use (&$calls): Page {
            $calls++;
            return match ($page) {
                1 => new Page(items: ['a', 'b'], page: 1, hasMore: true),
                2 => new Page(items: ['c', 'd'], page: 2, hasMore: true),
                3 => new Page(items: ['e'], page: 3, hasMore: false),
            };
        };

        $items = iterator_to_array(Paginator::paginate($fetcher));

        $this->assertSame(['a', 'b', 'c', 'd', 'e'], $items);
        $this->assertSame(3, $calls);
    }

    public function testPaginatesEmptyResult(): void
    {
        $fetcher = function (int $page): Page {
            return new Page(items: [], page: 1, hasMore: false);
        };

        $items = iterator_to_array(Paginator::paginate($fetcher));

        $this->assertSame([], $items);
    }

    public function testLazyLoading(): void
    {
        $calls = 0;
        $fetcher = function (int $page) use (&$calls): Page {
            $calls++;
            return match ($page) {
                1 => new Page(items: ['a', 'b'], page: 1, hasMore: true),
                2 => new Page(items: ['c'], page: 2, hasMore: false),
            };
        };

        $generator = Paginator::paginate($fetcher);

        $this->assertSame(0, $calls);

        $generator->current();
        $this->assertSame(1, $calls);
    }
}
