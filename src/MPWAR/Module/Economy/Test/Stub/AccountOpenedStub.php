<?php

namespace MPWAR\Module\Economy\Test\Stub;

use DateTimeImmutable;
use MPWAR\Module\Economy\Contract\DomainEvent\AccountOpened;

final class AccountOpenedStub
{
    public static function create($owner, DateTimeImmutable $occurredOn)
    {
        return new AccountOpened($owner, $occurredOn);
    }
}
