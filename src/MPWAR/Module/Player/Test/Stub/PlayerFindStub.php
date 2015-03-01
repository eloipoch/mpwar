<?php

namespace MPWAR\Module\Player\Test\Stub;

use MPWAR\Module\Player\Contract\Query\PlayerFind;

final class PlayerFindStub
{
    public static function create($id)
    {
        return new PlayerFind($id);
    }

    public static function random()
    {
        return self::create(PlayerIdStub::random()->value());
    }
}
