<?php

namespace MPWAR\Module\Economy\Domain;

interface AccountRepository
{
    /**
     * @param Account $account
     *
     * @return void
     */
    public function add(Account $account);

    /**
     * @param AccountOwner $owner
     *
     * @return Account|null
     */
    public function search(AccountOwner $owner);

    /**
     * @param Account $account
     *
     * @return void
     */
    public function save(Account $account);
}
