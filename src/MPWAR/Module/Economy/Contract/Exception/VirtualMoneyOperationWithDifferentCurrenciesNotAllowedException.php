<?php

namespace MPWAR\Module\Economy\Contract\Exception;

use DomainException;

final class VirtualMoneyOperationWithDifferentCurrenciesNotAllowedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Not allowed Virtual Money operation between different currencies');

        $this->code = 'economy_virtual_money_operation_not_valid';
    }
}
