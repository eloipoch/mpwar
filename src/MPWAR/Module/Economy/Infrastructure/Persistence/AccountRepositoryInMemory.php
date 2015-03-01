<?php

namespace MPWAR\Module\Economy\Infrastructure\Persistence;

use Doctrine\Common\Collections\ArrayCollection;
use MPWAR\Module\Economy\Domain\Account\Account;
use MPWAR\Module\Economy\Domain\Account\AccountRepository;

final class AccountRepositoryInMemory implements AccountRepository
{
    private $accounts;

    public function __construct()
    {
        $this->accounts = new ArrayCollection();
    }

    public function add(Account $account)
    {
        $this->accounts->set($account->owner()->value(), $account);
    }
}
