<?php

namespace MPWAR\Module\Economy\Infrastructure\Persistence;

use Doctrine\ORM\EntityManager;
use MPWAR\Module\Economy\Domain\Account;
use MPWAR\Module\Economy\Domain\AccountOwner;
use MPWAR\Module\Economy\Domain\AccountRepository;

final class AccountRepositoryMySql implements AccountRepository
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(Account $account)
    {
        $this->entityManager->persist($account);
        $this->entityManager->flush($account);
    }

    public function search(AccountOwner $owner)
    {
        return $this->repository()->find($owner);
    }

    private function repository()
    {
        return $this->entityManager->getRepository(Account::class);
    }
}
