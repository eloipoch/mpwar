<?php

namespace MPWAR\Module\Player\Tests\Behaviour;

use Mockery as m;
use MPWAR\Module\Player\Application\CommandHandler\PlayerRegistrationCommandHandler;
use MPWAR\Module\Player\Application\Service\PlayerRegistrar;
use MPWAR\Module\Player\Contract\Exception\PlayerAlreadyExistsException;
use MPWAR\Module\Player\Contract\Exception\PlayerIdNotValidException;
use MPWAR\Module\Player\Contract\Exception\PlayerNameNotValidException;
use MPWAR\Module\Player\Test\PlayerModuleUnitTestCase;
use MPWAR\Module\Player\Test\Stub\PlayerIdStub;
use MPWAR\Module\Player\Test\Stub\PlayerNameStub;
use MPWAR\Module\Player\Test\Stub\PlayerRegisteredStub;
use MPWAR\Module\Player\Test\Stub\PlayerRegistrationStub;
use MPWAR\Module\Player\Test\Stub\PlayerStub;

final class PlayerRegistrationTest extends PlayerModuleUnitTestCase
{
    /** @var PlayerRegistrationCommandHandler */
    private $handler;

    protected function setUp()
    {
        parent::setUp();

        $registrar     = new PlayerRegistrar($this->playerRepository(), $this->eventBus());
        $this->handler = new PlayerRegistrationCommandHandler($registrar);
    }

    /** @test */
    public function it_should_register_a_player()
    {
        $command = PlayerRegistrationStub::random();

        $playerId         = PlayerIdStub::create($command->id());
        $playerName       = PlayerNameStub::create($command->name());
        $player           = PlayerStub::create($playerId, $playerName);
        $playerRegistered = PlayerRegisteredStub::from($player);

        $this->shouldSearchPlayer($playerId);
        $this->shouldPersistPlayer($player);
        $this->shouldHandleEvent($playerRegistered);

        $this->handler->handle($command);
    }

    /** @test */
    public function it_should_not_allow_register_a_player_with_the_same_identifier()
    {
        $this->setExpectedException(PlayerAlreadyExistsException::class);

        $command  = PlayerRegistrationStub::random();
        $playerId = PlayerIdStub::create($command->id());

        $this->shouldSearchPlayer($playerId, PlayerStub::withId($playerId));

        $this->handler->handle($command);
    }

    /**
     * @test
     * @dataProvider invalidPlayerIds
     */
    public function it_should_throw_an_exception_registering_a_player_with_an_invalid_identifier($id)
    {
        $this->setExpectedException(PlayerIdNotValidException::class);

        $command = PlayerRegistrationStub::withId($id);

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

    /**
     * @test
     * @dataProvider invalidPlayerNames
     */
    public function it_should_throw_an_exception_registering_a_player_with_an_invalid_name($name)
    {
        $this->setExpectedException(PlayerNameNotValidException::class);

        $command = PlayerRegistrationStub::withName($name);

        $this->handler->handle($command);
    }

    public function invalidPlayerNames()
    {
        return [
            'null'    => ['name' => null],
            'empty'   => ['name' => ''],
            'integer' => ['name' => 123],
        ];
    }
}
