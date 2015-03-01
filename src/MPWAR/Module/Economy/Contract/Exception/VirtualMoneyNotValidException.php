<?php

namespace MPWAR\Module\Economy\Contract\Exception;

use InvalidArgumentException;

final class VirtualMoneyNotValidException extends InvalidArgumentException
{
    public function __construct($id)
    {
        parent::__construct(sprintf('Invalid Virtual Money value <%s>', $id));

        $this->code = 'economy_virtual_money_not_valid';
    }
}
