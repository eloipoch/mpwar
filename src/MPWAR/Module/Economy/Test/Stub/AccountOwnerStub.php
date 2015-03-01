<?php

namespace MPWAR\Module\Economy\Test\Stub;

use MPWAR\Module\Economy\Domain\AccountOwner;
use MPWAR\Test\Stub\UuidStub;

final class AccountOwnerStub
{
    public static function create($owner)
    {
        return new AccountOwner($owner);
    }

    public static function random()
    {
        return self::create(UuidStub::random());
    }
}
