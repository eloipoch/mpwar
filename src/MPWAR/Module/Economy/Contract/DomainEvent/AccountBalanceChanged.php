<?php

namespace MPWAR\Module\Economy\Contract\DomainEvent;

use DateTimeImmutable;
use SimpleBus\Message\Type\Event;

final class AccountBalanceChanged implements Event
{
    private $aggregateId;
    private $occurredOn;
    private $amount;
    private $currency;

    public function __construct($aggregateId, $amount, $currency)
    {
        $this->aggregateId = $aggregateId;
        $this->occurredOn  = new DateTimeImmutable();
        $this->amount      = $amount;
        $this->currency    = $currency;
    }
}
