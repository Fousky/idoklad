<?php

namespace Fousky\Component\iDoklad\Model\CashVoucher;

use Fousky\Component\iDoklad\LOV\PriceTypeWithoutOnlyBaseEnum;
use Fousky\Component\iDoklad\LOV\VatRateTypeEnum;
use Fousky\Component\iDoklad\Model\iDokladAbstractModel;
use Fousky\Component\iDoklad\Model\iDokladModelInterface;

/**
 * @method null|float getAmount()
 * @method null|string getName()
 * @method null|float getPrice()
 * @method null|PriceTypeWithoutOnlyBaseEnum getPriceType()
 * @method null|bool getStatus()
 * @method null|string getVariableSymbol()
 * @method null|float getVatRate()
 * @method null|VatRateTypeEnum getVatRateType()
 *
 * @author Lukáš Brzák <brzak@fousky.cz>
 */
class CashVoucherItemApiModelInsert extends iDokladAbstractModel
{
    public $Amount;
    public $Name;
    public $Price;
    public $PriceType;
    public $Status;
    public $VariableSymbol;
    public $VatRate;
    public $VatRateType;

    /**
     * @param \stdClass $data
     *
     * @return iDokladModelInterface
     */
    public static function createFromStd(\stdClass $data): iDokladModelInterface
    {
        /** @var CashVoucherItemApiModelInsert $model */
        $model = parent::createFromStd($data);

        if ($model->PriceType !== null) {
            $model->PriceType = new PriceTypeWithoutOnlyBaseEnum((int) $model->PriceType);
        }

        if ($model->VatRateType !== null) {
            $model->VatRateType = new VatRateTypeEnum((int) $model->VatRateType);
        }

        return $model;
    }
}
