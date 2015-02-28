<?php

namespace MPWAR\Module\Player\Domain;

use DateTimeImmutable;
use SimpleBus\Message\Recorder\PrivateMessageRecorderCapabilities;
use SimpleBus\Message\Recorder\RecordsMessages;

final class Player implements RecordsMessages
{
    private $id;
    private $name;
    private $registrationDate;

    use PrivateMessageRecorderCapabilities;

    public function __construct(PlayerId $id, PlayerName $name, DateTimeImmutable $registrationDate = null)
    {
        $this->id               = $id;
        $this->name             = $name;
        $this->registrationDate = $registrationDate ?: new DateTimeImmutable();
    }

    public static function register(PlayerId $id, PlayerName $name)
    {
        return new Player($id, $name);
    }
}
