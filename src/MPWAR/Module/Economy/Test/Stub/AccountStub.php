<?php

namespace MPWAR\Module\Economy\Test\Stub;

use MPWAR\Module\Economy\Domain\Account\Account;
use MPWAR\Module\Economy\Domain\Account\AccountOwner;
use MPWAR\Module\Economy\Domain\VirtualMoney\VirtualMoney;

final class AccountStub
{
    public static function create(AccountOwner $owner, VirtualMoney $balance)
    {
        return new Account($owner, $balance);
    }
}
