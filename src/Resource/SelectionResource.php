<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Resource;

use LeNewBlack\Wholesale\Http\Paginator;
use LeNewBlack\Wholesale\Model\ResultSet;
use LeNewBlack\Wholesale\Model\Selection\Selection;
use LeNewBlack\Wholesale\Model\Selection\SetSelectionRequest;

final class SelectionResource extends AbstractResource
{
    /**
     * @return ResultSet<Selection>
     */
    public function list(int $page = 1): ResultSet
    {
        $response = $this->authenticatedGetPaged('/selections', ['page' => $page]);
        return ResultSet::fromPagedResponse($response, Selection::fromArray(...), $page, 500);
    }

    public function get(int $id): Selection
    {
        $data = $this->authenticatedGet("/selections/{$id}");
        return Selection::fromArray($data);
    }

    public function upsert(SetSelectionRequest $request): Selection
    {
        $data = $this->authenticatedPost('/selections', $request->toArray());
        return Selection::fromArray($data);
    }

    public function delete(int $id): void
    {
        $this->authenticatedDelete("/selections/{$id}");
    }

    /**
     * @return \Generator<Selection>
     */
    public function paginate(): \Generator
    {
        return Paginator::paginate(fn(int $page) => $this->list($page));
    }
}
