<?php

namespace MPWAR\Module\Economy\Contract\DomainEvent;

use DateTimeImmutable;
use SimpleBus\Message\Type\Event;

final class AccountOpened implements Event
{
    private $aggregateId;
    private $occurredOn;

    public function __construct($aggregateId, DateTimeImmutable $occurredOn)
    {
        $this->aggregateId = $aggregateId;
        $this->occurredOn  = $occurredOn;
    }

    public function aggregateId()
    {
        return $this->aggregateId;
    }

    public function occurredOn()
    {
        return $this->occurredOn;
    }
}
