<?php

namespace MPWAR\Module\Economy\Test;

use Mockery as m;
use Mockery\MockInterface;
use MPWAR\Module\Economy\Domain\Account;
use MPWAR\Module\Economy\Domain\AccountOwner;
use MPWAR\Module\Economy\Domain\AccountRepository;
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

    protected function shouldSaveAccount(Account $account)
    {
        $this->accountRepository()
            ->shouldReceive('save')
            ->once()
            ->with($this->assertEqualAggregatedRoot($account))
            ->andReturnNull();
    }

    protected function shouldSearchAccount(AccountOwner $owner, Account $account = null)
    {
        $this->accountRepository()
            ->shouldReceive('search')
            ->once()
            ->with(m::mustBe($owner))
            ->andReturn($account);
    }
}
