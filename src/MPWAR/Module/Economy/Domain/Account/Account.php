<?php

namespace MPWAR\Module\Economy\Domain\Account;

use MPWAR\Module\Economy\Domain\VirtualMoney\VirtualMoney;
use SimpleBus\Message\Recorder\PrivateMessageRecorderCapabilities;
use SimpleBus\Message\Recorder\RecordsMessages;

final class Account implements RecordsMessages
{
    private $owner;
    private $balance;

    use PrivateMessageRecorderCapabilities;

    public function __construct(AccountOwner $owner, VirtualMoney $balance)
    {
        $this->owner   = $owner;
        $this->balance = $balance;
    }

    public function owner()
    {
        return $this->owner;
    }

    public static function open(AccountOwner $owner)
    {
        return new self($owner, VirtualMoney::coins(0));
    }
}
