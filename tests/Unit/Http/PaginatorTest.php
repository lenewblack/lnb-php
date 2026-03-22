<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Tests\Unit\Http;

use LeNewBlack\Wholesale\Http\Paginator;
use LeNewBlack\Wholesale\Model\ResultSet;
use LeNewBlack\Wholesale\Model\ResultSetMetadata;
use PHPUnit\Framework\TestCase;

final class PaginatorTest extends TestCase
{
    private static function makeResultSet(array $data, ?bool $hasMore, int $pageSize = 3): ResultSet
    {
        return new ResultSet(
            data: $data,
            metadata: new ResultSetMetadata(
                page: 1,
                pageSize: $pageSize,
                hasMore: $hasMore,
                totalPages: null,
                totalItems: null,
                filters: [],
            ),
        );
    }

    public function testPaginatesSinglePage(): void
    {
        $fetcher = function (int $page): ResultSet {
            $this->assertSame(1, $page);
            return self::makeResultSet(['a', 'b', 'c'], false);
        };

        $items = iterator_to_array(Paginator::paginate($fetcher));

        $this->assertSame(['a', 'b', 'c'], $items);
    }

    public function testPaginatesMultiplePages(): void
    {
        $calls = 0;
        $fetcher = function (int $page) use (&$calls): ResultSet {
            $calls++;
            return match ($page) {
                1 => self::makeResultSet(['a', 'b'], true, 2),
                2 => self::makeResultSet(['c', 'd'], true, 2),
                3 => self::makeResultSet(['e'], false, 2),
            };
        };

        $items = iterator_to_array(Paginator::paginate($fetcher));

        $this->assertSame(['a', 'b', 'c', 'd', 'e'], $items);
        $this->assertSame(3, $calls);
    }

    public function testPaginatesEmptyResult(): void
    {
        $fetcher = function (int $page): ResultSet {
            return self::makeResultSet([], false);
        };

        $items = iterator_to_array(Paginator::paginate($fetcher));

        $this->assertSame([], $items);
    }

    public function testLazyLoading(): void
    {
        $calls = 0;
        $fetcher = function (int $page) use (&$calls): ResultSet {
            $calls++;
            return match ($page) {
                1 => self::makeResultSet(['a', 'b'], true, 2),
                2 => self::makeResultSet(['c'], false, 2),
            };
        };

        $generator = Paginator::paginate($fetcher);

        $this->assertSame(0, $calls);

        $generator->current();
        $this->assertSame(1, $calls);
    }

    public function testFallbackHeuristicWhenNoHeaders(): void
    {
        // hasMore = null (no headers) — should use count-based fallback
        $calls = 0;
        $fetcher = function (int $page) use (&$calls): ResultSet {
            $calls++;
            return match ($page) {
                1 => new ResultSet(
                    data: ['a', 'b'],
                    metadata: new ResultSetMetadata(page: 1, pageSize: 2, hasMore: null, totalPages: null, totalItems: null, filters: []),
                ),
                2 => new ResultSet(
                    data: ['c'],
                    metadata: new ResultSetMetadata(page: 2, pageSize: 2, hasMore: null, totalPages: null, totalItems: null, filters: []),
                ),
            };
        };

        $items = iterator_to_array(Paginator::paginate($fetcher));

        $this->assertSame(['a', 'b', 'c'], $items);
        $this->assertSame(2, $calls);
    }
}
