<?php

namespace MPWAR\Module\Economy\Contract\Exception;

use InvalidArgumentException;
use MPWAR\Module\Economy\Domain\AccountOwner;

final class AccountOwnerAlreadyHasAnAccountException extends InvalidArgumentException
{
    public function __construct(AccountOwner $owner)
    {
        parent::__construct(sprintf('Account Owner <%s> already has an account', $owner));

        $this->code = 'economy_account_owner_already_has_an_account';
    }
}
