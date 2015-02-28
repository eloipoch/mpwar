<?php

namespace MPWAR\Test\PHPUnit;

use Mockery as m;
use PHPUnit_Framework_TestCase;

abstract class UnitTestCase extends PHPUnit_Framework_TestCase
{
    protected function mock($className)
    {
        return m::mock($className);
    }
}
