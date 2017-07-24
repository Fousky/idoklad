<?php

namespace Fousky\Component\iDoklad\Model\PaymentOptions;

use Doctrine\Common\Collections\ArrayCollection;
use Fousky\Component\iDoklad\Exception\InvalidResponseException;
use Fousky\Component\iDoklad\Model\iDokladAbstractModel;
use Fousky\Component\iDoklad\Model\iDokladModelInterface;
use Fousky\Component\iDoklad\Util\ResponseUtil;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Lukáš Brzák <lukas.brzak@aquadigital.cz>
 */
class PaymentOptionCollectionModel extends iDokladAbstractModel
{
    public $Data;
    public $TotalItems;
    public $TotalPages;

    /**
     * @param ResponseInterface $response
     *
     * @return iDokladModelInterface
     *
     * @throws \RuntimeException
     * @throws InvalidResponseException
     */
    public static function createFromResponse(ResponseInterface $response): iDokladModelInterface
    {
        $responseData = (array) ResponseUtil::handle($response);

        if (!array_key_exists('Data', $responseData)) {
            throw new InvalidResponseException();
        }

        $model = new static();
        $items = new ArrayCollection();

        foreach ($responseData['Data'] as $index => $option) {
            $items->add(PaymentOptionModel::createFromStd($option));
        }

        $model->Data = $items;
        $model->TotalPages = $responseData['TotalPages'];
        $model->TotalItems = $responseData['TotalItems'];

        return $model;
    }
}
