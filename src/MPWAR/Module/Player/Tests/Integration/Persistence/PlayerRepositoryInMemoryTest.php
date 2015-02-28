<?php

namespace MPWAR\Module\Player\Tests\Integration\Persistence;

final class PlayerRepositoryInMemoryTest extends PlayerRepositoryTestCase
{
    public function repository()
    {
        return $this->getPlayerRepositoryInMemory();
    }
}
