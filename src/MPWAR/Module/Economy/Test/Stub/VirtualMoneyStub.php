<?php

namespace MPWAR\Module\Economy\Test\Stub;

use MPWAR\Module\Economy\Domain\VirtualMoney\VirtualCurrency;
use MPWAR\Module\Economy\Domain\VirtualMoney\VirtualMoney;

final class VirtualMoneyStub
{
    public static function create($amount, VirtualCurrency $currency)
    {
        return new VirtualMoney($amount, $currency);
    }

    public static function zeroCoins()
    {
        return VirtualMoney::coins(0);
    }
}
