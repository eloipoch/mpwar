<?php

namespace MPWAR\Module\Player\Contract\Exception;

use InvalidArgumentException;

final class PlayerIdNotValidException extends InvalidArgumentException
{
    /**
     * @param string $id
     */
    public function __construct($id)
    {
        parent::__construct(sprintf('Invalid Player identifier value <%s>', $id));

        $this->code = 'player_identifier_not_valid';
    }
}
