<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Resource;

use LeNewBlack\Wholesale\Http\Paginator;
use LeNewBlack\Wholesale\Model\Batch\BatchResponse;
use LeNewBlack\Wholesale\Model\ResultSet;
use LeNewBlack\Wholesale\Model\Sizing\SetSizingRequest;
use LeNewBlack\Wholesale\Model\Sizing\Sizing;

final class SizingResource extends AbstractResource
{
    /**
     * @return ResultSet<Sizing>
     */
    public function list(int $page = 1): ResultSet
    {
        $response = $this->authenticatedGetPaged('/sizings', ['page' => $page]);
        return ResultSet::fromPagedResponse($response, Sizing::fromArray(...), $page, 500);
    }

    public function get(string $code): Sizing
    {
        $data = $this->authenticatedGet("/sizings/{$code}");
        return Sizing::fromArray($data);
    }

    public function upsert(SetSizingRequest $request): Sizing
    {
        $data = $this->authenticatedPost('/sizings', $request->toArray());
        return Sizing::fromArray($data);
    }

    /**
     * @param SetSizingRequest[] $requests
     */
    public function batchUpsert(array $requests): BatchResponse
    {
        $body = array_map(fn(SetSizingRequest $r) => $r->toArray(), $requests);
        return $this->batchPost('/multi/sizings', $body);
    }

    /**
     * @return \Generator<Sizing>
     */
    public function paginate(): \Generator
    {
        return Paginator::paginate(fn(int $page) => $this->list($page));
    }
}
