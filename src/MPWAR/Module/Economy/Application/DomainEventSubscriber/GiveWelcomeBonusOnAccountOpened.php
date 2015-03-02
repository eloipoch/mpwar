<?php

namespace MPWAR\Module\Economy\Application\DomainEventSubscriber;

use MPWAR\Module\Economy\Application\Service\TransactionProcessor;
use MPWAR\Module\Economy\Contract\DomainEvent\AccountOpened;
use MPWAR\Module\Economy\Contract\Exception\AccountOwnerNotValidException;
use MPWAR\Module\Economy\Domain\AccountOwner;
use MPWAR\Module\Economy\Domain\AccountWelcomeBonus;
use SimpleBus\Message\Message;
use SimpleBus\Message\Subscriber\MessageSubscriber;

final class GiveWelcomeBonusOnAccountOpened implements MessageSubscriber
{
    private $processor;

    public function __construct(TransactionProcessor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * @param AccountOpened|Message $message
     *
     * @throws AccountOwnerNotValidException
     *
     * @return void
     */
    public function notify(Message $message)
    {
        $owner = new AccountOwner($message->aggregateId());
        $coins = AccountWelcomeBonus::coins();

        $this->processor->__invoke($owner, $coins);
    }
}
