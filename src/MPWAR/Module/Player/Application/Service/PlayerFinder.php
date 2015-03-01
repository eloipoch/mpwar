<?php

namespace MPWAR\Module\Player\Application\Service;

use MPWAR\Module\Player\Contract\Exception\PlayerNotExistsException;
use MPWAR\Module\Player\Contract\Response\PlayerResponse;
use MPWAR\Module\Player\Domain\PlayerId;
use MPWAR\Module\Player\Domain\PlayerRepository;

final class PlayerFinder
{
    private $repository;

    public function __construct(PlayerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(PlayerId $id)
    {
        $player = $this->repository->search($id);

        if (null === $player) {
            throw new PlayerNotExistsException($id);
        }

        $response = new PlayerResponse($player->id()->value(), $player->name()->value(), $player->registrationDate());

        return $response;
    }
}
