<?php

namespace MPWAR\Module\Player\Test\Stub;

use MPWAR\Module\Player\Domain\Player;
use MPWAR\Module\Player\Domain\PlayerId;
use MPWAR\Module\Player\Domain\PlayerName;

final class PlayerStub
{
    public static function create(PlayerId $id, PlayerName $name)
    {
        return new Player($id, $name);
    }

    public static function random()
    {
        return self::create(PlayerIdStub::random(), PlayerNameStub::random());
    }

    public static function identified(PlayerId $id)
    {
        return self::create($id, PlayerNameStub::random());
    }
}
