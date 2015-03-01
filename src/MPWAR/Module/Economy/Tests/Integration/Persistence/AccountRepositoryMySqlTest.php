<?php

namespace MPWAR\Module\Economy\Tests\Integration\Persistence;

use MPWAR\Infrastructure\Doctrine\DatabaseCleaner;

final class AccountRepositoryMySqlTest extends AccountRepositoryTestCase
{
    protected function setUp()
    {
        parent::setUp();

        DatabaseCleaner::clean($this->entityManager());
    }

    public function repository()
    {
        return $this->getAccountRepositoryMySql();
    }
}
