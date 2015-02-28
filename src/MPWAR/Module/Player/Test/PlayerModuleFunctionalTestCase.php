<?php

namespace MPWAR\Module\Player\Test;

use MPWAR\Test\PHPUnit\FunctionalTestCase;

abstract class PlayerModuleFunctionalTestCase extends FunctionalTestCase
{
    protected function getPlayerRepositoryInMemory()
    {
        return $this->service('mpwar.player.infrastructure.palyer_repository.in_memory');
    }
}
