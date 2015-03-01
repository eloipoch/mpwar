<?php

namespace MPWAR\Module\Player\Tests\Integration\Persistence;

use MPWAR\Infrastructure\Doctrine\DatabaseCleaner;

final class PlayerRepositoryMySqlTest extends PlayerRepositoryTestCase
{
    protected function setUp()
    {
        parent::setUp();

        DatabaseCleaner::clean($this->entityManager());
    }

    public function repository()
    {
        return $this->getPlayerRepositoryMySql();
    }
}
