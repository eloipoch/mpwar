<?php

namespace MPWAR\Module\Economy\Tests\Integration\Persistence;

use MPWAR\Module\Economy\Domain\AccountRepository;
use MPWAR\Module\Economy\Test\EconomyModuleFunctionalTestCase;
use MPWAR\Module\Economy\Test\Stub\AccountStub;

abstract class AccountRepositoryTestCase extends EconomyModuleFunctionalTestCase
{
    /** @return AccountRepository */
    abstract public function repository();

    /** @test */
    public function it_should_add_an_account()
    {
        $this->repository()->add(AccountStub::random());
    }

    /** @test */
    public function it_should_find_a_player_that_exists()
    {
        $account = AccountStub::random();

        $this->repository()->add($account);

        $this->assertEquals($account, $this->repository()->search($account->owner()));
    }

    /** @test */
    public function it_should_return_null_finding_a_player_that_does_not_exists()
    {
        $account = AccountStub::random();

        $this->assertNull($this->repository()->search($account->owner()));
    }
}
