<?php

namespace MPWAR\Module\Economy\Test\Stub;

use MPWAR\Module\Economy\Domain\Account\AccountOwner;

final class AccountOwnerStub
{
    public static function create($owner)
    {
        return new AccountOwner($owner);
    }
}
