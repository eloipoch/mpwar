<?php

namespace MPWAR\Module\Economy\Application\Service;

use iter;
use MPWAR\Module\Economy\Contract\Exception\AccountOwnerAlreadyHasAnAccountException;
use MPWAR\Module\Economy\Domain\Account;
use MPWAR\Module\Economy\Domain\AccountOwner;
use MPWAR\Module\Economy\Domain\AccountRepository;
use SimpleBus\Message\Bus\MessageBus;
use SimpleBus\Message\Type\Event;

final class AccountOpener
{
    private $repository;
    private $eventBus;

    public function __construct(AccountRepository $repository, MessageBus $eventBus)
    {
        $this->repository = $repository;
        $this->eventBus   = $eventBus;
    }

    public function __invoke(AccountOwner $owner)
    {
        $this->guardOneAccountPerOwner($owner);

        $account = Account::open($owner);

        $this->repository->add($account);

        $this->publishDomainEvents($account);
    }

    private function guardOneAccountPerOwner(AccountOwner $owner)
    {
        $account = $this->repository->search($owner);

        if (null !== $account) {
            throw new AccountOwnerAlreadyHasAnAccountException($owner);
        }
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
