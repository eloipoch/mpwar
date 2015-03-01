<?php

namespace MPWAR\Module\Economy\Test;

use MPWAR\Test\PHPUnit\FunctionalTestCase;

abstract class EconomyModuleFunctionalTestCase extends FunctionalTestCase
{
    protected function getAccountRepositoryInMemory()
    {
        return $this->service('mpwar.economy.infrastructure.account_repository.in_memory');
    }

    protected function getAccountRepositoryMySql()
    {
        return $this->service('mpwar.economy.infrastructure.account_repository.mysql');
    }
}
