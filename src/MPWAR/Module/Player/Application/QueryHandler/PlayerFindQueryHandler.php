<?php

namespace MPWAR\Module\Player\Application\QueryHandler;

use MPWAR\Module\Player\Application\Service\PlayerFinder;
use MPWAR\Module\Player\Contract\Exception\PlayerIdNotValidException;
use MPWAR\Module\Player\Contract\Exception\PlayerNotExistsException;
use MPWAR\Module\Player\Contract\Query\PlayerFind;
use MPWAR\Module\Player\Contract\Response\PlayerResponse;
use MPWAR\Module\Player\Domain\PlayerId;
use Oracle\Domain\Handler\QueryHandler;
use Oracle\Domain\Query;

final class PlayerFindQueryHandler implements QueryHandler
{
    private $finder;

    public function __construct(PlayerFinder $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @param PlayerFind|Query $query
     *
     * @throws PlayerIdNotValidException
     * @throws PlayerNotExistsException
     *
     * @return PlayerResponse
     */
    public function handle(Query $query)
    {
        $id = new PlayerId($query->playerId());

        return $this->finder->__invoke($id);
    }
}
