<?php

namespace MPWAR\Module\Economy\Tests\Behaviour;

use MPWAR\Module\Economy\Application\DomainEventSubscriber\CreateAccountOnPlayerRegistered;
use MPWAR\Module\Economy\Application\Service\AccountOpener;
use MPWAR\Module\Economy\Contract\Exception\AccountOwnerAlreadyHasAnAccountException;
use MPWAR\Module\Economy\Contract\Exception\AccountOwnerNotValidException;
use MPWAR\Module\Economy\Test\EconomyModuleUnitTestCase;
use MPWAR\Module\Economy\Test\Stub\AccountOwnerStub;
use MPWAR\Module\Economy\Test\Stub\AccountStub;
use MPWAR\Module\Economy\Test\Stub\VirtualMoneyStub;
use MPWAR\Module\Player\Test\Stub\PlayerRegisteredStub;

final class AccountOpenOnPlayerRegisteredTest extends EconomyModuleUnitTestCase
{
    /** @var CreateAccountOnPlayerRegistered */
    private $subscriber;

    protected function setUp()
    {
        parent::setUp();

        $opener           = new AccountOpener($this->accountRepository());
        $this->subscriber = new CreateAccountOnPlayerRegistered($opener);
    }

    /** @test */
    public function it_should_open_an_account_when_a_player_has_been_registered()
    {
        $event = PlayerRegisteredStub::random();

        $owner   = AccountOwnerStub::create($event->aggregateId());
        $account = AccountStub::create($owner, VirtualMoneyStub::zeroCoins());

        $this->shouldSearchAccount($owner);
        $this->shouldPersistAccount($account);

        $this->subscriber->notify($event);
    }

    /** @test */
    public function it_should_not_allow_open_an_account_to_an_owner_that_already_has_one()
    {
        $this->setExpectedException(AccountOwnerAlreadyHasAnAccountException::class);

        $event = PlayerRegisteredStub::random();
        $owner = AccountOwnerStub::create($event->aggregateId());

        $this->shouldSearchAccount($owner, AccountStub::owned($owner));

        $this->subscriber->notify($event);
    }

    /**
     * @test
     * @dataProvider invalidAccountOwners
     */
    public function it_should_throw_an_exception_registering_a_player_with_an_invalid_identifier($owner)
    {
        $this->setExpectedException(AccountOwnerNotValidException::class);

        $event = PlayerRegisteredStub::identified($owner);

        $this->subscriber->notify($event);
    }

    public function invalidAccountOwners()
    {
        return [
            'null'    => ['owner' => null],
            'integer' => ['owner' => 1],
            'string'  => ['owner' => 'asdsa'],
        ];
    }
}
