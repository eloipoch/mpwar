<?php

namespace MPWAR\Module\Player\Domain;

use MPWAR\Module\Player\Contract\Exception\PlayerNameNotValidException;

final class PlayerName
{
    private $name;

    public function __construct($name)
    {
        $this->guard($name);

        $this->name = $name;
    }

    public function name()
    {
        return $this->name;
    }

    private function guard($name)
    {
        if (empty($name) || !is_string($name)) {
            throw new PlayerNameNotValidException($name);
        }
    }
}
