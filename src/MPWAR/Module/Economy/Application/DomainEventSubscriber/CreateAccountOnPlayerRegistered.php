<?php

namespace MPWAR\Module\Economy\Application\DomainEventSubscriber;

use MPWAR\Module\Economy\Application\Service\AccountOpener;
use MPWAR\Module\Economy\Contract\Exception\AccountOwnerNotValidException;
use MPWAR\Module\Economy\Domain\Account\AccountOwner;
use MPWAR\Module\Player\Contract\DomainEvent\PlayerRegistered;
use SimpleBus\Message\Message;
use SimpleBus\Message\Subscriber\MessageSubscriber;

final class CreateAccountOnPlayerRegistered implements MessageSubscriber
{
    private $opener;

    public function __construct(AccountOpener $opener)
    {
        $this->opener = $opener;
    }

    /**
     * @param PlayerRegistered|Message $message
     *
     * @throws AccountOwnerNotValidException
     *
     * @return void
     */
    public function notify(Message $message)
    {
        $owner = new AccountOwner($message->aggregateId());

        $this->opener->__invoke($owner);
    }
}
