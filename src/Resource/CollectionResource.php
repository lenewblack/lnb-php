<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Resource;

use LeNewBlack\Wholesale\Http\Paginator;
use LeNewBlack\Wholesale\Model\Batch\BatchResponse;
use LeNewBlack\Wholesale\Model\Collection\Collection;
use LeNewBlack\Wholesale\Model\Collection\SetCollectionRequest;
use LeNewBlack\Wholesale\Model\ResultSet;

final class CollectionResource extends AbstractResource
{
    /**
     * @return ResultSet<Collection>
     */
    public function list(
        int $page = 1,
        ?string $name = null,
        ?string $code = null,
        ?string $status = null,
        ?string $season = null,
    ): ResultSet {
        $filters = array_filter([
            'name' => $name,
            'code' => $code,
            'status' => $status,
            'season' => $season,
        ], fn ($v) => $v !== null);

        $response = $this->authenticatedGetPaged('/collections', array_merge(['page' => $page], $filters));

        return ResultSet::fromPagedResponse($response, Collection::fromArray(...), $page, 500, $filters);
    }

    public function get(string $code): Collection
    {
        $data = $this->authenticatedGet("/collections/{$code}");
        return Collection::fromArray($data);
    }

    public function upsert(SetCollectionRequest $request): Collection
    {
        $data = $this->authenticatedPost('/collections', $request->toArray());
        return Collection::fromArray($data);
    }

    /**
     * @param SetCollectionRequest[] $requests
     */
    public function batchUpsert(array $requests): BatchResponse
    {
        $body = array_map(fn(SetCollectionRequest $r) => $r->toArray(), $requests);
        return $this->batchPost('/multi/collections', $body);
    }

    /**
     * @return \Generator<Collection>
     */
    public function paginate(
        ?string $name = null,
        ?string $code = null,
        ?string $status = null,
        ?string $season = null,
    ): \Generator {
        return Paginator::paginate(
            fn(int $page) => $this->list($page, $name, $code, $status, $season)
        );
    }
}
