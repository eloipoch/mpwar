<?php

namespace MPWAR\Module\Player\Contract\Exception;

use InvalidArgumentException;

final class PlayerIdNotValidException extends InvalidArgumentException
{
    public function __construct($value)
    {
        parent::__construct(sprintf('Invalid Player Identifier value <%s>', $value));

        $this->code = 'player_identifier_not_valid';
    }
}
