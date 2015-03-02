<?php

namespace MPWAR\Module\Player\Application\Service;

use iter;
use MPWAR\Module\Player\Contract\Exception\PlayerAlreadyExistsException;
use MPWAR\Module\Player\Domain\Player;
use MPWAR\Module\Player\Domain\PlayerId;
use MPWAR\Module\Player\Domain\PlayerName;
use MPWAR\Module\Player\Domain\PlayerRepository;
use SimpleBus\Message\Bus\MessageBus;
use SimpleBus\Message\Type\Event;

final class PlayerRegistrar
{
    private $repository;
    private $eventBus;

    public function __construct(PlayerRepository $repository, MessageBus $eventBus)
    {
        $this->repository = $repository;
        $this->eventBus   = $eventBus;
    }

    public function __invoke(PlayerId $id, PlayerName $name)
    {
        $this->guardPlayerId($id);

        $player = Player::register($id, $name);

        $this->repository->add($player);

        $this->publishDomainEvents($player);
    }

    private function guardPlayerId(PlayerId $id)
    {
        $player = $this->repository->search($id);

        if (null !== $player) {
            throw new PlayerAlreadyExistsException($id);
        }
    }

    private function publishDomainEvents(Player $player)
    {
        iter\apply($this->handleEvent(), $player->recordedMessages());
        $player->eraseMessages();
    }

    private function handleEvent()
    {
        return function (Event $event) {
            $this->eventBus->handle($event);
        };
    }
}
