<?php

namespace MPWAR\Module\Economy\Application\Service;

use iter;
use MPWAR\Module\Economy\Domain\Account;
use MPWAR\Module\Economy\Domain\AccountOwner;
use MPWAR\Module\Economy\Domain\AccountRepository;
use MPWAR\Module\Economy\Domain\VirtualMoney;
use SimpleBus\Message\Bus\MessageBus;
use SimpleBus\Message\Type\Event;

final class TransactionProcessor
{
    private $repository;
    private $eventBus;

    public function __construct(AccountRepository $repository, MessageBus $eventBus)
    {
        $this->repository = $repository;
        $this->eventBus   = $eventBus;
    }

    public function __invoke(AccountOwner $owner, VirtualMoney $money)
    {
        $account = $this->repository->search($owner);

        $account->add($money);

        $this->repository->save($account);

        $this->publishDomainEvents($account);
    }

    private function publishDomainEvents(Account $account)
    {
        iter\apply($this->handleEvent(), $account->recordedMessages());
        $account->eraseMessages();
    }

    private function handleEvent()
    {
        return function (Event $event) {
            $this->eventBus->handle($event);
        };
    }
}
