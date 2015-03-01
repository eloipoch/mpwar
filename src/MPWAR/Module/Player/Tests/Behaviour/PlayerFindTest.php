<?php

namespace MPWAR\Module\Player\Tests\Behaviour;

use MPWAR\Module\Player\Application\QueryHandler\PlayerFindQueryHandler;
use MPWAR\Module\Player\Application\Service\PlayerFinder;
use MPWAR\Module\Player\Contract\Exception\PlayerIdNotValidException;
use MPWAR\Module\Player\Contract\Exception\PlayerNotExistsException;
use MPWAR\Module\Player\Test\PlayerModuleUnitTestCase;
use MPWAR\Module\Player\Test\Stub\PlayerFindStub;
use MPWAR\Module\Player\Test\Stub\PlayerIdStub;
use MPWAR\Module\Player\Test\Stub\PlayerResponseStub;
use MPWAR\Module\Player\Test\Stub\PlayerStub;

final class PlayerFindTest extends PlayerModuleUnitTestCase
{
    /** @var PlayerFindQueryHandler */
    private $handler;

    protected function setUp()
    {
        parent::setUp();

        $finder        = new PlayerFinder($this->playerRepository());
        $this->handler = new PlayerFindQueryHandler($finder);
    }

    /** @test */
    public function it_should_find_a_player_that_exists()
    {
        $query = PlayerFindStub::random();

        $playerId       = PlayerIdStub::create($query->playerId());
        $player         = PlayerStub::identified($playerId);
        $playerResponse = PlayerResponseStub::from($player);

        $this->shouldSearchPlayer($playerId, $player);

        $this->assertEquals($playerResponse, $this->handler->handle($query));
    }

    /** @test */
    public function it_should_throw_an_exception_finding_a_player_that_does_not_exists()
    {
        $this->setExpectedException(PlayerNotExistsException::class);

        $query    = PlayerFindStub::random();
        $playerId = PlayerIdStub::create($query->playerId());

        $this->shouldSearchPlayer($playerId);

        $this->handler->handle($query);
    }

    /**
     * @test
     * @dataProvider invalidPlayerIds
     */
    public function it_should_throw_an_exception_finding_a_player_with_an_invalid_identifier($id)
    {
        $this->setExpectedException(PlayerIdNotValidException::class);

        $command = PlayerFindStub::create($id);

        $this->handler->handle($command);
    }

    public function invalidPlayerIds()
    {
        return [
            'null'    => ['id' => null],
            'integer' => ['id' => 1],
            'string'  => ['id' => 'asdsa'],
        ];
    }
}
