<?php

namespace MPWAR\Module\Economy\Infrastructure\Persistence;

use Doctrine\Common\Collections\ArrayCollection;
use MPWAR\Module\Economy\Domain\Account;
use MPWAR\Module\Economy\Domain\AccountOwner;
use MPWAR\Module\Economy\Domain\AccountRepository;

final class AccountRepositoryInMemory implements AccountRepository
{
    private $accounts;

    public function __construct()
    {
        $this->accounts = new ArrayCollection();
    }

    public function add(Account $account)
    {
        $this->persist($account);
    }

    public function search(AccountOwner $owner)
    {
        return $this->accounts->get($owner->value());
    }

    public function save(Account $account)
    {
        $this->persist($account);
    }

    private function persist(Account $account)
    {
        $this->accounts->set($account->owner()->value(), $account);
    }
}
