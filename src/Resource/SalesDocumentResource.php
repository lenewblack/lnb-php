<?php

declare(strict_types=1);

namespace LeNewBlack\Wholesale\Resource;

use LeNewBlack\Wholesale\Http\Paginator;
use LeNewBlack\Wholesale\Model\Batch\BatchResponse;
use LeNewBlack\Wholesale\Model\ResultSet;
use LeNewBlack\Wholesale\Model\SalesDocument\SalesDocument;
use LeNewBlack\Wholesale\Model\SalesDocument\SalesDocumentOrder;
use LeNewBlack\Wholesale\Model\SalesDocument\SetSalesDocumentOrderRequest;
use LeNewBlack\Wholesale\Model\SalesDocument\SetSalesDocumentRequest;

final class SalesDocumentResource extends AbstractResource
{
    /**
     * @return ResultSet<SalesDocument>
     */
    public function list(int $page = 1): ResultSet
    {
        $response = $this->authenticatedGetPaged('/sales_documents', ['page' => $page]);
        return ResultSet::fromPagedResponse($response, SalesDocument::fromArray(...), $page, 500);
    }

    public function get(string $document_number): SalesDocument
    {
        $data = $this->authenticatedGet("/sales_documents/{$document_number}");
        return SalesDocument::fromArray($data);
    }

    public function upsert(SetSalesDocumentRequest $request): SalesDocument
    {
        $data = $this->authenticatedPost('/sales_documents', $request->toArray());
        return SalesDocument::fromArray($data);
    }

    /**
     * @return ResultSet<SalesDocumentOrder>
     */
    public function listOrders(): ResultSet
    {
        $data = $this->authenticatedGet('/sales_document_orders');
        return ResultSet::fromList($data, SalesDocumentOrder::fromArray(...));
    }

    public function linkOrder(SetSalesDocumentOrderRequest $request): SalesDocumentOrder
    {
        $data = $this->authenticatedPost('/sales_document_orders', $request->toArray());
        return SalesDocumentOrder::fromArray($data);
    }

    /**
     * @param SetSalesDocumentRequest[] $requests
     */
    public function batchUpsert(array $requests): BatchResponse
    {
        $body = array_map(fn(SetSalesDocumentRequest $r) => $r->toArray(), $requests);
        return $this->batchPost('/multi/sales_documents', $body);
    }

    /**
     * @param SetSalesDocumentOrderRequest[] $requests
     */
    public function batchLinkOrders(array $requests): BatchResponse
    {
        $body = array_map(fn(SetSalesDocumentOrderRequest $r) => $r->toArray(), $requests);
        return $this->batchPost('/multi/sales_document_orders', $body);
    }

    /**
     * @return \Generator<SalesDocument>
     */
    public function paginate(): \Generator
    {
        return Paginator::paginate(fn(int $page) => $this->list($page));
    }
}
