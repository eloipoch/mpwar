<?php

namespace MPWAR\Module\Economy\Domain;

use MPWAR\Module\Economy\Contract\Exception\VirtualMoneyNotValidException;
use MPWAR\Module\Economy\Contract\Exception\VirtualMoneyOperationWithDifferentCurrenciesNotAllowedException;

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

    public function add(VirtualMoney $other)
    {
        $this->guardCurrency($other->currency);

        return new self($this->amount + $other->amount, $this->currency);
    }

    private function guard($amount)
    {
        if (!is_int($amount) || 0 > $amount) {
            throw new VirtualMoneyNotValidException($amount);
        }
    }

    private function guardCurrency(VirtualCurrency $other)
    {
        if (!$this->currency->equals($other)) {
            throw new VirtualMoneyOperationWithDifferentCurrenciesNotAllowedException();
        }
    }
}
