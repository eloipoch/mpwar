<?php

namespace MPWAR\Module\Economy\Contract\Exception;

use InvalidArgumentException;

final class AccountOwnerNotValidException extends InvalidArgumentException
{
    public function __construct($id)
    {
        parent::__construct(sprintf('Invalid Account Owner value <%s>', $id));

        $this->code = 'economy_account_owner_not_valid';
    }
}
