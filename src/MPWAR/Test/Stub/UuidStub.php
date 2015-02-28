<?php

namespace MPWAR\Test\Stub;

final class UuidStub
{
    public static function random()
    {
        return StubCreator::faker()->uuid;
    }
}
