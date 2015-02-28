<?php

namespace MPWAR\Module\Player\Contract\Command;

use SimpleBus\Message\Type\Command;

final class PlayerRegistration implements Command
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }
}
