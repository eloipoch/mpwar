<?php

namespace MPWAR\Module\Economy\Tests\Behaviour;

use MPWAR\Module\Economy\Application\DomainEventSubscriber\GiveWelcomeBonusOnAccountOpened;
use MPWAR\Module\Economy\Application\Service\TransactionProcessor;
use MPWAR\Module\Economy\Contract\Exception\AccountOwnerNotValidException;
use MPWAR\Module\Economy\Domain\VirtualMoney;
use MPWAR\Module\Economy\Test\EconomyModuleUnitTestCase;
use MPWAR\Module\Economy\Test\Stub\AccountBalanceChangedStub;
use MPWAR\Module\Economy\Test\Stub\AccountOpenedStub;
use MPWAR\Module\Economy\Test\Stub\AccountOwnerStub;
use MPWAR\Module\Economy\Test\Stub\AccountStub;
use MPWAR\Module\Economy\Test\Stub\VirtualMoneyStub;

final class GiveWelcomeBonusOnAccountOpenedTest extends EconomyModuleUnitTestCase
{
    /** @var GiveWelcomeBonusOnAccountOpened */
    private $subscriber;

    protected function setUp()
    {
        parent::setUp();

        $opener           = new TransactionProcessor($this->accountRepository(), $this->eventBus());
        $this->subscriber = new GiveWelcomeBonusOnAccountOpened($opener);
    }

    /** @test */
    public function it_should_open_an_account_when_a_player_has_been_registered()
    {
        $event = AccountOpenedStub::random();

        $owner                 = AccountOwnerStub::create($event->aggregateId());
        $account               = AccountStub::create($owner, VirtualMoneyStub::zeroCoins());
        $accountUpdated        = AccountStub::create($owner, VirtualMoney::coins(100));
        $accountBalanceChanged = AccountBalanceChangedStub::from($owner, VirtualMoney::coins(100));

        $this->shouldSearchAccount($owner, $account);
        $this->shouldSaveAccount($accountUpdated);
        $this->shouldHandleEvent($accountBalanceChanged);

        $this->subscriber->notify($event);
    }

    /**
     * @test
     * @dataProvider invalidAccountOwners
     */
    public function it_should_throw_an_exception_registering_a_player_with_an_invalid_identifier($owner)
    {
        $this->setExpectedException(AccountOwnerNotValidException::class);

        $event = AccountOpenedStub::owned($owner);

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
