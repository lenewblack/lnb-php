<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Resource;

use LeNewBlack\Wholesale\Http\Paginator;
use LeNewBlack\Wholesale\Model\Invoice\Invoice;
use LeNewBlack\Wholesale\Model\ResultSet;

final class InvoiceResource extends AbstractResource
{
    /**
     * @return ResultSet<Invoice>
     */
    public function list(
        int $page = 1,
        ?string $invoice_time_from = null,
        ?string $invoice_time_to = null,
        ?string $confirmation_time_from = null,
        ?string $confirmation_time_to = null,
        ?string $update_time_from = null,
        ?string $update_time_to = null,
        ?string $status = null,
    ): ResultSet {
        $filters = array_filter([
            'invoice_time_from' => $invoice_time_from,
            'invoice_time_to' => $invoice_time_to,
            'confirmation_time_from' => $confirmation_time_from,
            'confirmation_time_to' => $confirmation_time_to,
            'update_time_from' => $update_time_from,
            'update_time_to' => $update_time_to,
            'status' => $status,
        ], fn ($v) => $v !== null);

        $response = $this->authenticatedGetPaged('/invoices', array_merge(['page' => $page], $filters));
        return ResultSet::fromPagedResponse($response, Invoice::fromArray(...), $page, 500, $filters);
    }

    public function get(string $reference_number): Invoice
    {
        $data = $this->authenticatedGet('/invoices/' . rawurlencode($reference_number));
        return Invoice::fromArray($data);
    }

    /**
     * @return \Generator<Invoice>
     */
    public function paginate(
        ?string $invoice_time_from = null,
        ?string $invoice_time_to = null,
        ?string $confirmation_time_from = null,
        ?string $confirmation_time_to = null,
        ?string $update_time_from = null,
        ?string $update_time_to = null,
        ?string $status = null,
    ): \Generator {
        return Paginator::paginate(fn(int $page) => $this->list(
            $page,
            $invoice_time_from,
            $invoice_time_to,
            $confirmation_time_from,
            $confirmation_time_to,
            $update_time_from,
            $update_time_to,
            $status,
        ));
    }
}
