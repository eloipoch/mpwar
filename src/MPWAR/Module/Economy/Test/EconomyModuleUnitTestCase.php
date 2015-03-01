<?php

namespace MPWAR\Module\Economy\Test;

use Mockery as m;
use Mockery\MockInterface;
use MPWAR\Module\Economy\Domain\Account\Account;
use MPWAR\Module\Economy\Domain\Account\AccountRepository;
use MPWAR\Test\PHPUnit\UnitTestCase;

abstract class EconomyModuleUnitTestCase extends UnitTestCase
{
    private $accountRepository;

    /** @return AccountRepository|MockInterface */
    protected function accountRepository()
    {
        return $this->accountRepository = $this->accountRepository ?: $this->mock(AccountRepository::class);
    }

    protected function shouldPersistAccount(Account $account)
    {
        $this->accountRepository()
            ->shouldReceive('add')
            ->once()
            ->with($this->assertEqualAggregatedRoot($account))
            ->andReturnNull();
    }
}
