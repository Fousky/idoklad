<?php

namespace Fousky\Component\iDoklad\Functions\ExchangeRates;

use Fousky\Component\iDoklad\Functions\iDokladAbstractFunction;
use Fousky\Component\iDoklad\Model\ExchangeRates\ExchangeRateModel;

/**
 * @author Lukáš Brzák <lukas.brzak@aquadigital.cz>
 */
class GetExchangeRate extends iDokladAbstractFunction
{
    /** @var string $id */
    protected $id;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * Get iDokladModelInterface class.
     *
     * @see iDokladModelInterface
     *
     * @return string
     */
    public function getModelClass(): string
    {
        return ExchangeRateModel::class;
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
        return sprintf('ExchangeRates/%s', $this->id);
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
