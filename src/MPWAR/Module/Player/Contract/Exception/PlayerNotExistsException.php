<?php

namespace MPWAR\Module\Player\Contract\Exception;

use DomainException;
use MPWAR\Module\Player\Domain\PlayerId;

final class PlayerNotExistsException extends DomainException
{
    public function __construct(PlayerId $id)
    {
        parent::__construct(sprintf('Player <%s> not exists', $id));

        $this->code = 'player_not_exists';
    }
}
