<?php

namespace MPWAR\Module\Player\Contract\Exception;

use InvalidArgumentException;

final class PlayerNameNotValidException extends InvalidArgumentException
{
    public function __construct($name)
    {
        parent::__construct(sprintf('Invalid Player name value <%s>', $name));

        $this->code = 'player_name_not_valid';
    }
}
