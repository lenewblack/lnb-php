<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Resource;

use LeNewBlack\Wholesale\Http\Paginator;
use LeNewBlack\Wholesale\Model\Batch\BatchResponse;
use LeNewBlack\Wholesale\Model\Page;
use LeNewBlack\Wholesale\Model\Retailer\Retailer;
use LeNewBlack\Wholesale\Model\Retailer\SetRetailerRequest;

final class RetailerResource extends AbstractResource
{
    /**
     * @return Page<Retailer>
     */
    public function list(int $page = 1): Page
    {
        $data = $this->authenticatedGet('/retailers', ['page' => $page]);
        return Page::fromArray($data, Retailer::fromArray(...), 500, $page);
    }

    public function get(string $reference): Retailer
    {
        $data = $this->authenticatedGet("/retailers/{$reference}");
        return Retailer::fromArray($data);
    }

    public function upsert(SetRetailerRequest $request): Retailer
    {
        $data = $this->authenticatedPost('/retailers', $request->toArray());
        return Retailer::fromArray($data);
    }

    /**
     * @param SetRetailerRequest[] $requests
     */
    public function batchUpsert(array $requests): BatchResponse
    {
        $body = array_map(fn(SetRetailerRequest $r) => $r->toArray(), $requests);
        return $this->batchPost('/multi/retailers', $body);
    }

    /**
     * @return \Generator<Retailer>
     */
    public function paginate(): \Generator
    {
        return Paginator::paginate(fn(int $page) => $this->list($page));
    }
}
