<?php

namespace MPWAR\Module\Economy\Test\Stub;

use DateTimeImmutable;
use MPWAR\Module\Economy\Contract\DomainEvent\AccountOpened;
use MPWAR\Test\Stub\DateTimeStub;

final class AccountOpenedStub
{
    public static function create($owner, DateTimeImmutable $occurredOn)
    {
        return new AccountOpened($owner, $occurredOn);
    }

    public static function random()
    {
        return self::create(AccountOwnerStub::random()->value(), DateTimeStub::random());
    }

    public static function owned($owner)
    {
        return self::create($owner, DateTimeStub::random());
    }
}
