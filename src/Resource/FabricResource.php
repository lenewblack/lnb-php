<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Resource;

use LeNewBlack\Wholesale\Http\Paginator;
use LeNewBlack\Wholesale\Model\Batch\BatchResponse;
use LeNewBlack\Wholesale\Model\Fabric\Fabric;
use LeNewBlack\Wholesale\Model\Fabric\SetFabricRequest;
use LeNewBlack\Wholesale\Model\ResultSet;

final class FabricResource extends AbstractResource
{
    /**
     * @return ResultSet<Fabric>
     */
    public function list(int $page = 1): ResultSet
    {
        $response = $this->authenticatedGetPaged('/fabrics', ['page' => $page]);
        return ResultSet::fromPagedResponse($response, Fabric::fromArray(...), $page, 500);
    }

    public function get(string $code): Fabric
    {
        $data = $this->authenticatedGet("/fabrics/{$code}");
        return Fabric::fromArray($data);
    }

    public function upsert(SetFabricRequest $request): Fabric
    {
        $data = $this->authenticatedPost('/fabrics', $request->toArray());
        return Fabric::fromArray($data);
    }

    /**
     * @param SetFabricRequest[] $requests
     */
    public function batchUpsert(array $requests): BatchResponse
    {
        $body = array_map(fn(SetFabricRequest $r) => $r->toArray(), $requests);
        return $this->batchPost('/multi/fabrics', $body);
    }

    /**
     * @return \Generator<Fabric>
     */
    public function paginate(): \Generator
    {
        return Paginator::paginate(fn(int $page) => $this->list($page));
    }
}
