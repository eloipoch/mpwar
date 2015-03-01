<?php

namespace MPWAR\Module\Player\Test\Stub;

use DateTimeImmutable;
use MPWAR\Module\Player\Contract\DomainEvent\PlayerRegistered;
use MPWAR\Module\Player\Domain\Player;

final class PlayerRegisteredStub
{
    public static function create($id, DateTimeImmutable $occurredOn, $name)
    {
        return new PlayerRegistered($id, $occurredOn, $name);
    }

    public static function from(Player $player)
    {
        return self::create($player->id()->id(), $player->registrationDate(), $player->name()->name());
    }
}
