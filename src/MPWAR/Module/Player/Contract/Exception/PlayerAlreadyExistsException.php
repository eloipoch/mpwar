<?php

namespace MPWAR\Module\Player\Contract\Exception;

use DomainException;
use MPWAR\Module\Player\Domain\PlayerId;

final class PlayerAlreadyExistsException extends DomainException
{
    public function __construct(PlayerId $id)
    {
        parent::__construct(sprintf('Player <%s> already exists', $id));

        $this->code = 'player_already_exists';
    }
}
