<?php

namespace MPWAR\Module\Economy\Domain\VirtualMoney;

use MPWAR\Module\Economy\Contract\Exception\VirtualMoneyNotValidException;

final class VirtualMoney
{
    private $amount;
    private $currency;

    public function __construct($amount, VirtualCurrency $currency)
    {
        $this->guard($amount);

        $this->amount   = $amount;
        $this->currency = $currency;
    }

    public static function coins($amount)
    {
        return new self($amount, VirtualCurrency::coin());
    }

    private function guard($amount)
    {
        if (!is_int($amount) || 0 > $amount) {
            throw new VirtualMoneyNotValidException($amount);
        }
    }
}
