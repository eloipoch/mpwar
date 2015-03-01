<?php

namespace MPWAR\Module\Player\Contract\Query;

use Oracle\Domain\Query;

final class PlayerFind implements Query
{
    private $playerId;

    public function __construct($playerId)
    {
        $this->playerId = $playerId;
    }

    public function playerId()
    {
        return $this->playerId;
    }
}
