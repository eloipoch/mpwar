<?php

namespace MPWAR\Module\Economy\Tests\Integration\Persistence;

use MPWAR\Module\Economy\Domain\Account;
use MPWAR\Module\Economy\Domain\AccountRepository;
use MPWAR\Module\Economy\Domain\VirtualMoney;
use MPWAR\Module\Economy\Test\EconomyModuleFunctionalTestCase;
use MPWAR\Module\Economy\Test\Stub\AccountStub;
use PHPUnit_Framework_Assert as Assertions;

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

    /** @test */
    public function it_should_allow_save_a_modified_account()
    {
        $account         = AccountStub::zeroCoins();
        $owner           = $account->owner();
        $amountToAdd     = VirtualMoney::coins(50);
        $expectedAccount = AccountStub::create($owner, $amountToAdd);

        $this->repository()->add($account);

        $originalAccount = $this->repository()->search($owner);

        $originalAccount->add($amountToAdd);

        $this->repository()->save($originalAccount);

        $this->assertEqualAccounts($expectedAccount, $this->repository()->search($owner));
    }

    private function assertEqualAccounts(Account $expected, Account $actualCloned)
    {
        $actualCloned = clone($actualCloned);
        $actualCloned->eraseMessages();

        return Assertions::equalTo($expected)->evaluate($actualCloned, '', true);
    }
}
