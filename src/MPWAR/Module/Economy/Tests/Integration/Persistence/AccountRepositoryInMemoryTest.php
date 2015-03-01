<?php

namespace MPWAR\Module\Economy\Tests\Integration\Persistence;

final class AccountRepositoryInMemoryTest extends AccountRepositoryTestCase
{
    public function repository()
    {
        return $this->getAccountRepositoryInMemory();
    }
}
