<?php

namespace MPWAR\Module\Player\Test\Stub;

use MPWAR\Module\Player\Contract\Command\PlayerRegistration;

final class PlayerRegistrationStub
{
    public static function create($id, $name)
    {
        return new PlayerRegistration($id, $name);
    }

    public static function random()
    {
        return self::create(
            PlayerIdStub::random()->value(),
            PlayerNameStub::random()->value()
        );
    }

    public static function identified($id)
    {
        return self::create($id, PlayerNameStub::random()->value());
    }

    public static function named($name)
    {
        return self::create(PlayerIdStub::random()->value(), $name);
    }
}
