<?php

namespace MPWAR\Module\Player\Application\Service;

use MPWAR\Module\Player\Contract\Exception\PlayerAlreadyExistsException;
use MPWAR\Module\Player\Domain\Player;
use MPWAR\Module\Player\Domain\PlayerId;
use MPWAR\Module\Player\Domain\PlayerName;
use MPWAR\Module\Player\Domain\PlayerRepository;

final class PlayerRegistrar
{
    private $repository;

    public function __construct(PlayerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(PlayerId $id, PlayerName $name)
    {
        $this->guardPlayerId($id);

        $player = Player::register($id, $name);

        $this->repository->add($player);
    }

    private function guardPlayerId(PlayerId $id)
    {
        $player = $this->repository->search($id);

        if (null !== $player) {
            throw new PlayerAlreadyExistsException($id);
        }
    }
}
