<?php

namespace MPWAR\Module\Player\Test\Stub;

use MPWAR\Module\Player\Domain\PlayerId;
use MPWAR\Test\Stub\UuidStub;

final class PlayerIdStub
{
    public static function create($id)
    {
        return new PlayerId($id);
    }

    public static function random()
    {
        return self::create(UuidStub::random());
    }
}
