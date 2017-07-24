<?php

namespace Fousky\Component\iDoklad\Functions\ProformaInvoices;

use Fousky\Component\iDoklad\Functions\iDokladAbstractFunction;
use Fousky\Component\iDoklad\Model\ProformaInvoices\ProformaInvoiceModel;

/**
 * @author Lukáš Brzák <lukas.brzak@aquadigital.cz>
 */
class GetDefaultProformaInvoice extends iDokladAbstractFunction
{
    /**
     * Get iDokladModelInterface class.
     *
     * @see iDokladModelInterface
     *
     * @return string
     */
    public function getModelClass(): string
    {
        return ProformaInvoiceModel::class;
    }

    /**
     * GET|POST|PUT|DELETE e.g.
     *
     * @see iDokladApiCaller::request()
     *
     * @return string
     */
    public function getHttpMethod(): string
    {
        return 'GET';
    }

    /**
     * Return base URI, e.g. /invoices; /invoice/1/edit and so on.
     *
     * @see iDokladApiClient::call()
     *
     * @return string
     */
    public function getUri(): string
    {
        return 'ProformaInvoices/Default';
    }

    /**
     * Vrátí seznam parametrů, které se předají GuzzleHttp\Client
     *
     * @see \GuzzleHttp\Client::request()
     * @see iDokladApiClient::call()
     *
     * @return array
     */
    public function getGuzzleOptions(): array
    {
        return [];
    }
}
