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
    public function list(
        int $page = 1,
        ?string $create_time_from = null,
        ?string $create_time_to = null,
        ?string $status = null,
    ): ResultSet {
        $filters = array_filter([
            'create_time_from' => $create_time_from,
            'create_time_to' => $create_time_to,
            'status' => $status,
        ], fn ($v) => $v !== null);

        $response = $this->authenticatedGetPaged('/selections', array_merge(['page' => $page], $filters));
        return ResultSet::fromPagedResponse($response, Selection::fromArray(...), $page, 500, $filters);
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
    public function paginate(
        ?string $create_time_from = null,
        ?string $create_time_to = null,
        ?string $status = null,
    ): \Generator {
        return Paginator::paginate(fn(int $page) => $this->list($page, $create_time_from, $create_time_to, $status));
    }
}
