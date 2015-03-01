<?php

namespace MPWAR\Module\Player\Contract\Response;

use DateTimeImmutable;
use Oracle\Domain\Response;

final class PlayerResponse implements Response
{
    private $id;
    private $name;
    private $registrationDate;

    public function __construct($id, $name, DateTimeImmutable $registrationDate)
    {
        $this->id               = $id;
        $this->name             = $name;
        $this->registrationDate = $registrationDate;
    }

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }

    public function registrationDate()
    {
        return $this->registrationDate;
    }
}
