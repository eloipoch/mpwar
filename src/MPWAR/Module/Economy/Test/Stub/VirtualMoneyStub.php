<?php

namespace MPWAR\Module\Economy\Test\Stub;

use MPWAR\Module\Economy\Domain\VirtualCurrency;
use MPWAR\Module\Economy\Domain\VirtualMoney;
use MPWAR\Test\Stub\StubCreator;

final class VirtualMoneyStub
{
    public static function create($amount, VirtualCurrency $currency)
    {
        return new VirtualMoney($amount, $currency);
    }

    public static function zeroCoins()
    {
        return self::create(0, VirtualCurrency::coin());
    }

    public static function randomCoins()
    {
        return self::create(StubCreator::faker()->randomNumber(), VirtualCurrency::coin());
    }
}
