<?php

namespace MPWAR\Module\Economy\Infrastructure\Persistence;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use MPWAR\Module\Economy\Domain\VirtualCurrency;

final class VirtualCurrencyType extends StringType
{
    const NAME = 'virtual_currency';

    public function convertToPhpValue($value, AbstractPlatform $platform)
    {
        return null !== $value ? new VirtualCurrency($value) : null;
    }

    /**
     * @param VirtualCurrency  $value
     * @param AbstractPlatform $platform
     *
     * @return null|string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return null !== $value ? $value->value() : null;
    }

    public function getName()
    {
        return self::NAME;
    }
}
