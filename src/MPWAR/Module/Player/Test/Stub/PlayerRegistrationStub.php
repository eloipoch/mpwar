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
            PlayerIdStub::random()->id(),
            PlayerNameStub::random()->name()
        );
    }

    public static function withId($id)
    {
        return self::create($id, PlayerNameStub::random()->name());
    }

    public static function withName($name)
    {
        return self::create(PlayerIdStub::random()->id(), $name);
    }
}
