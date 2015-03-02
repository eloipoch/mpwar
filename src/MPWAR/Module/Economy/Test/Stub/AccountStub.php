<?php

namespace MPWAR\Module\Economy\Test\Stub;

use MPWAR\Module\Economy\Domain\Account;
use MPWAR\Module\Economy\Domain\AccountOwner;
use MPWAR\Module\Economy\Domain\VirtualMoney;

final class AccountStub
{
    public static function create(AccountOwner $owner, VirtualMoney $balance)
    {
        return new Account($owner, $balance);
    }

    public static function owned(AccountOwner $owner)
    {
        return self::create($owner, VirtualMoneyStub::randomCoins());
    }

    public static function zeroCoins()
    {
        return self::create(AccountOwnerStub::random(), VirtualMoneyStub::zeroCoins());
    }

    public static function random()
    {
        return self::create(AccountOwnerStub::random(), VirtualMoneyStub::randomCoins());
    }
}
