<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Resource;

use LeNewBlack\Wholesale\Http\Paginator;
use LeNewBlack\Wholesale\Model\Order\Order;
use LeNewBlack\Wholesale\Model\Order\SetArchiveOrderRequest;
use LeNewBlack\Wholesale\Model\Order\SetOrderRequest;
use LeNewBlack\Wholesale\Model\Order\SetOrderStatusRequest;
use LeNewBlack\Wholesale\Model\ResultSet;

final class OrderResource extends AbstractResource
{
    /**
     * @return ResultSet<Order>
     */
    public function list(
        int $page = 1,
        ?string $order_time_from = null,
        ?string $order_time_to = null,
        ?string $confirmation_time_from = null,
        ?string $confirmation_time_to = null,
        ?string $update_time_from = null,
        ?string $update_time_to = null,
        ?string $status = null,
    ): ResultSet {
        $filters = array_filter([
            'order_time_from' => $order_time_from,
            'order_time_to' => $order_time_to,
            'confirmation_time_from' => $confirmation_time_from,
            'confirmation_time_to' => $confirmation_time_to,
            'update_time_from' => $update_time_from,
            'update_time_to' => $update_time_to,
            'status' => $status,
        ], fn ($v) => $v !== null);

        $response = $this->authenticatedGetPaged('/orders', array_merge(['page' => $page], $filters));

        return ResultSet::fromPagedResponse($response, Order::fromArray(...), $page, 500, $filters);
    }

    public function get(string $reference): Order
    {
        $data = $this->authenticatedGet("/orders/{$reference}");
        return Order::fromArray($data);
    }

    public function upsert(SetOrderRequest $request): Order
    {
        $data = $this->authenticatedPost('/orders', $request->toArray());
        return Order::fromArray($data);
    }

    public function updateStatus(SetOrderStatusRequest $request): array
    {
        return $this->authenticatedPost('/orders/status', $request->toArray());
    }

    public function archive(SetArchiveOrderRequest $request): Order
    {
        $data = $this->authenticatedPost('/orders_archive', $request->toArray());
        return Order::fromArray($data);
    }

    /**
     * @return \Generator<Order>
     */
    public function paginate(
        ?string $order_time_from = null,
        ?string $order_time_to = null,
        ?string $confirmation_time_from = null,
        ?string $confirmation_time_to = null,
        ?string $update_time_from = null,
        ?string $update_time_to = null,
        ?string $status = null,
    ): \Generator {
        return Paginator::paginate(
            fn(int $page) => $this->list($page, $order_time_from, $order_time_to, $confirmation_time_from, $confirmation_time_to, $update_time_from, $update_time_to, $status)
        );
    }
}
