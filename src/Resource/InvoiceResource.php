<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Resource;

use LeNewBlack\Wholesale\Http\Paginator;
use LeNewBlack\Wholesale\Model\Invoice\Invoice;
use LeNewBlack\Wholesale\Model\Page;

final class InvoiceResource extends AbstractResource
{
    /**
     * @return Page<Invoice>
     */
    public function list(int $page = 1): Page
    {
        $data = $this->authenticatedGet('/invoices', ['page' => $page]);
        return Page::fromArray($data, Invoice::fromArray(...), 500, $page);
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
