<?php

namespace MPWAR\Test\Stub;

use Faker\Factory;

abstract class StubCreator
{
    private static $faker;

    public static function faker()
    {
        return self::$faker = self::$faker ?: Factory::create();
    }
}
