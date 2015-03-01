<?php

namespace MPWAR\Module\Economy\Application\Service;

use MPWAR\Module\Economy\Domain\Account\Account;
use MPWAR\Module\Economy\Domain\Account\AccountOwner;
use MPWAR\Module\Economy\Domain\Account\AccountRepository;

final class AccountOpener
{
    private $repository;

    public function __construct(AccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(AccountOwner $owner)
    {
        $account = Account::open($owner);

        $this->repository->add($account);
    }
}
