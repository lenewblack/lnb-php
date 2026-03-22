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
    public function list(int $page = 1): ResultSet
    {
        $response = $this->authenticatedGetPaged('/invoices', ['page' => $page]);
        return ResultSet::fromPagedResponse($response, Invoice::fromArray(...), $page, 500);
    }

    public function get(string $reference_number): Invoice
    {
        $data = $this->authenticatedGet("/invoices/{$reference_number}");
        return Invoice::fromArray($data);
    }

    /**
     * @return \Generator<Invoice>
     */
    public function paginate(): \Generator
    {
        return Paginator::paginate(fn(int $page) => $this->list($page));
    }
}
