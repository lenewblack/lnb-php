<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Model;

final class ResultSetMetadata
{
    /**
     * @param int|null   $page       Current page number (X-Pagination-Current-Page); null for non-paginated endpoints
     * @param int|null   $pageSize   Page size (X-Pagination-Page-Size); null for non-paginated endpoints
     * @param bool|null  $hasMore    Whether more pages exist (X-Pagination-Has-More); null for non-paginated endpoints
     * @param int|null   $totalPages Total number of pages (X-Pagination-Total-Pages); null for non-paginated endpoints
     * @param int|null   $totalItems Total number of items (X-Pagination-Total-Items); null for non-paginated endpoints
     * @param array      $filters    Applied filters (nulls excluded)
     */
    public function __construct(
        public readonly ?int $page,
        public readonly ?int $pageSize,
        public readonly ?bool $hasMore,
        public readonly ?int $totalPages,
        public readonly ?int $totalItems,
        public readonly array $filters,
    ) {}
}
