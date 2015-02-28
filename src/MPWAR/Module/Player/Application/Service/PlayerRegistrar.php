<?php

namespace MPWAR\Module\Player\Application\Service;

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
        $player = Player::register($id, $name);

        $this->repository->add($player);
    }
}
