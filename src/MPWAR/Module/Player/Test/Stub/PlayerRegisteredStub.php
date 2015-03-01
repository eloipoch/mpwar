<?php

namespace MPWAR\Module\Player\Test\Stub;

use DateTimeImmutable;
use MPWAR\Module\Player\Contract\DomainEvent\PlayerRegistered;
use MPWAR\Module\Player\Domain\Player;
use MPWAR\Test\Stub\DateTimeStub;

final class PlayerRegisteredStub
{
    public static function create($id, DateTimeImmutable $occurredOn, $name)
    {
        return new PlayerRegistered($id, $occurredOn, $name);
    }

    public static function random()
    {
        return self::create(PlayerIdStub::random()->value(), DateTimeStub::random(), PlayerNameStub::random()->value());
    }

    public static function from(Player $player)
    {
        return self::create($player->id()->value(), $player->registrationDate(), $player->name()->value());
    }

    public static function identified($id)
    {
        return self::create($id, DateTimeStub::random(), PlayerNameStub::random()->value());
    }
}
