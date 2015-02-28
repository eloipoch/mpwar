<?php

namespace MPWAR\Module\Player\Test;

use Mockery as m;
use Mockery\MockInterface;
use MPWAR\Module\Player\Domain\Player;
use MPWAR\Module\Player\Domain\PlayerRepository;
use MPWAR\Test\PHPUnit\UnitTestCase;

abstract class PlayerModuleUnitTestCase extends UnitTestCase
{
    private $playerRepository;

    /** @return PlayerRepository|MockInterface */
    protected function playerRepository()
    {
        return $this->playerRepository = $this->playerRepository ?: $this->mock(PlayerRepository::class);
    }

    protected function shouldPersistPlayer(Player $player)
    {
        $this->playerRepository()
            ->shouldReceive('add')
            ->once()
            ->with(m::mustBe($player))
            ->andReturnNull();
    }
}
