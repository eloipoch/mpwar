<?php

namespace MPWAR\Module\Player\Tests\Integration\Persistence;

use MPWAR\Module\Player\Domain\PlayerRepository;
use MPWAR\Module\Player\Test\PlayerModuleFunctionalTestCase;
use MPWAR\Module\Player\Test\Stub\PlayerStub;

abstract class PlayerRepositoryTestCase extends PlayerModuleFunctionalTestCase
{
    /** @return PlayerRepository */
    abstract public function repository();

    /** @test */
    public function it_should_add_a_player()
    {
        $this->repository()->add(PlayerStub::random());
    }

    /** @test */
    public function it_should_find_a_player_that_exists()
    {
        $player = PlayerStub::random();

        $this->repository()->add($player);

        $this->assertEquals($player, $this->repository()->search($player->id()));
    }

    /** @test */
    public function it_should_return_null_finding_a_player_that_does_not_exists()
    {
        $player = PlayerStub::random();

        $this->assertNull($this->repository()->search($player->id()));
    }
}
