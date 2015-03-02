<?php

namespace MPWAR\Module\Economy\Test\Stub;

use MPWAR\Module\Economy\Contract\DomainEvent\AccountBalanceChanged;
use MPWAR\Module\Economy\Domain\AccountOwner;
use MPWAR\Module\Economy\Domain\VirtualMoney;

final class AccountBalanceChangedStub
{
    public static function create($owner, $amount, $currency)
    {
        return new AccountBalanceChanged($owner, $amount, $currency);
    }

    public static function from(AccountOwner $owner, VirtualMoney $money)
    {
        return self::create($owner->value(), $money->amount(), $money->currency()->value());
    }
}
