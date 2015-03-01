<?php

namespace MPWAR\Module\Economy\Domain\Account;

interface AccountRepository
{
    /**
     * @param Account $account
     *
     * @return void
     */
    public function add(Account $account);
}
