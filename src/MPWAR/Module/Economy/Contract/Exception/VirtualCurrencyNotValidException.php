<?php

namespace MPWAR\Module\Economy\Contract\Exception;

use InvalidArgumentException;

final class VirtualCurrencyNotValidException extends InvalidArgumentException
{
    public function __construct($id)
    {
        parent::__construct(sprintf('Invalid Virtual Currency value <%s>', $id));

        $this->code = 'economy_virtual_currency_not_valid';
    }
}
