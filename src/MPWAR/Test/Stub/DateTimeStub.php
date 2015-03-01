<?php

namespace MPWAR\Test\Stub;

use DateTime;
use DateTimeImmutable;

final class DateTimeStub
{
    public static function random()
    {
        return new DateTimeImmutable(
            StubCreator::faker()->dateTimeBetween('-1 year', '+ 1 year')->format(DateTime::ISO8601)
        );
    }
}
