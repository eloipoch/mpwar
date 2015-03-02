<?php

namespace MPWAR\Module\Economy\Application\Service;

use MPWAR\Module\Economy\Domain\AccountOwner;
use MPWAR\Module\Economy\Domain\AccountRepository;
use MPWAR\Module\Economy\Domain\VirtualMoney;

final class TransactionProcessor
{
    private $repository;

    public function __construct(AccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(AccountOwner $owner, VirtualMoney $money)
    {
        $account = $this->repository->search($owner);

        $account->add($money);

        $this->repository->save($account);
    }
}
