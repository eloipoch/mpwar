<?php

namespace MPWAR\Module\Economy\Domain;

use MPWAR\Module\Economy\Contract\Exception\AccountOwnerNotValidException;
use Rhumsaa\Uuid\Uuid;

final class AccountOwner
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
            throw new AccountOwnerNotValidException($value);
        }
    }
}
