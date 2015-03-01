<?php

namespace MPWAR\Module\Player\Domain;

use MPWAR\Module\Player\Contract\Exception\PlayerNameNotValidException;

final class PlayerName
{
    private $value;

    public function __construct($value)
    {
        $this->guard($value);

        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }

    private function guard($value)
    {
        if (empty($value) || !is_string($value)) {
            throw new PlayerNameNotValidException($value);
        }
    }
}
