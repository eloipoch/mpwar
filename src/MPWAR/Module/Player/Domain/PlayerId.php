<?php

namespace MPWAR\Module\Player\Domain;

use MPWAR\Module\Player\Contract\Exception\PlayerIdNotValidException;
use Rhumsaa\Uuid\Uuid;

final class PlayerId
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

    public function __toString()
    {
        return $this->value();
    }

    private function guard($value)
    {
        if (!Uuid::isValid($value)) {
            throw new PlayerIdNotValidException($value);
        }
    }
}
