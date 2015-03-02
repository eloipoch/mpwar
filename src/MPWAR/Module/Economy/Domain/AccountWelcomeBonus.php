<?php

namespace MPWAR\Module\Economy\Domain;

final class AccountWelcomeBonus
{
    public static function coins()
    {
        return VirtualMoney::coins(100);
    }
}
