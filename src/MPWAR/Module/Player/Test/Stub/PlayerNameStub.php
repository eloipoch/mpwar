<?php

namespace MPWAR\Module\Player\Test\Stub;

use MPWAR\Module\Player\Domain\PlayerName;
use MPWAR\Test\Stub\StubCreator;

final class PlayerNameStub
{
    public static function create($name)
    {
        return new PlayerName($name);
    }

    public static function random()
    {
        return self::create(StubCreator::faker()->unique()->name);
    }
}
