<?php

namespace MPWAR\Test\PHPUnit;

use AppKernel;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;

abstract class FunctionalTestCase extends KernelTestCase
{
    protected function setUp()
    {
        static::bootKernel();
    }

    protected function service($id)
    {
        return $this->container()->get($id);
    }

    protected function parameter($parameter)
    {
        return $this->container()->getParameter($parameter);
    }

    /** @return Container */
    private function container()
    {
        return static::$kernel->getContainer();
    }

    /** @return EntityManager */
    protected function entityManager()
    {
        return $this->service('doctrine.orm.entity_manager');
    }
}
