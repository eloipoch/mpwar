<?php

namespace MPWAR\Module\Player\Infrastructure\Persistence;

use Doctrine\Common\Collections\ArrayCollection;
use MPWAR\Module\Player\Domain\Player;
use MPWAR\Module\Player\Domain\PlayerId;
use MPWAR\Module\Player\Domain\PlayerRepository;

final class PlayerRepositoryInMemory implements PlayerRepository
{
    private $players;

    public function __construct()
    {
        $this->players = new ArrayCollection();
    }

    public function add(Player $player)
    {
        $this->players->set($player->id()->id(), $player);
    }

    public function search(PlayerId $id)
    {
        return $this->players->get($id->id());
    }
}
