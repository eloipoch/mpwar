<?php

namespace MPWAR\Module\Player\Test;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;
use igorw;
use iter;
use MPWAR\Module\Player\Contract\Command\PlayerRegistration;
use MPWAR\Module\Player\Test\Stub\PlayerRegistrationStub;
use SimpleBus\Message\Bus\MessageBus;

final class PlayerContext implements Context, SnippetAcceptingContext
{
    private $commandBus;

    public function __construct(MessageBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @Given /^there are registered players:$/
     */
    public function thereAreRegisteredPlayers(TableNode $players)
    {
        iter\apply($this->registerPlayer(), $players);
    }

    public function handle()
    {
        return function (PlayerRegistration $command) {
            $this->commandBus->handle($command);
        };
    }

    private function command()
    {
        return function (array $playerInfo) {
            return PlayerRegistrationStub::create($playerInfo['id'], $playerInfo['name']);
        };
    }

    private function registerPlayer()
    {
        return igorw\compose($this->handle(), $this->command());
    }
}
