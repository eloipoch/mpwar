<?php

namespace MPWAR\Module\Economy\Domain;

use MPWAR\Module\Economy\Contract\Exception\VirtualCurrencyNotValidException;

final class VirtualCurrency
{
    private static $allowed = ['coin'];
    private $value;

    public function __construct($value)
    {
        $this->guard($value);

        $this->value = $value;
    }

    public static function coin()
    {
        return new self('coin');
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(VirtualCurrency $other)
    {
        return $this->value === $other->value;
    }

    private function guard($value)
    {
        if (!in_array($value, self::$allowed)) {
            throw new VirtualCurrencyNotValidException($value);
        }
    }
}
