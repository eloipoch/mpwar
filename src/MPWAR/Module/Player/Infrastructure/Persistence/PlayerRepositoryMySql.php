<?php

namespace MPWAR\Module\Player\Infrastructure\Persistence;

use Doctrine\ORM\EntityManager;
use MPWAR\Module\Player\Domain\Player;
use MPWAR\Module\Player\Domain\PlayerId;
use MPWAR\Module\Player\Domain\PlayerRepository;

final class PlayerRepositoryMySql implements PlayerRepository
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(Player $player)
    {
        $this->entityManager->persist($player);
        $this->entityManager->flush($player);
    }

    public function search(PlayerId $id)
    {
        return $this->repository()->find($id);
    }

    private function repository()
    {
        return $this->entityManager->getRepository(Player::class);
    }
}
