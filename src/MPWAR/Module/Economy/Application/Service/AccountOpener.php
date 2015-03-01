<?php

namespace MPWAR\Module\Economy\Application\Service;

use MPWAR\Module\Economy\Contract\Exception\AccountOwnerAlreadyHasAnAccountException;
use MPWAR\Module\Economy\Domain\Account;
use MPWAR\Module\Economy\Domain\AccountOwner;
use MPWAR\Module\Economy\Domain\AccountRepository;

final class AccountOpener
{
    private $repository;

    public function __construct(AccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(AccountOwner $owner)
    {
        $this->guardOneAccountPerOwner($owner);

        $account = Account::open($owner);

        $this->repository->add($account);
    }

    private function guardOneAccountPerOwner(AccountOwner $owner)
    {
        $account = $this->repository->search($owner);

        if (null !== $account) {
            throw new AccountOwnerAlreadyHasAnAccountException($owner);
        }
    }
}
