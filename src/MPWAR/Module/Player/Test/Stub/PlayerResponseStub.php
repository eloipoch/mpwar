<?php

namespace MPWAR\Module\Player\Test\Stub;

use DateTimeImmutable;
use MPWAR\Module\Player\Contract\Response\PlayerResponse;
use MPWAR\Module\Player\Domain\Player;

final class PlayerResponseStub
{
    public static function create($id, $name, DateTimeImmutable $registrationDate)
    {
        return new PlayerResponse($id, $name, $registrationDate);
    }

    public static function from(Player $player)
    {
        return self::create(
            $player->id()->value(),
            $player->name()->value(),
            $player->registrationDate()
        );
    }
}
