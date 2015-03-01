<?php

namespace MPWAR\Test\PHPUnit\Comparator;

use DateInterval;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Exception;
use SebastianBergmann\Comparator\ComparisonFailure;
use SebastianBergmann\Comparator\ObjectComparator;

class DateTimeStringSimilarComparator extends ObjectComparator
{
    public function accepts($expected, $actual)
    {
        return (null !== $actual) && $this->isValidDateTimeString($expected) && $this->isValidDateTimeString($actual);
    }

    public function assertEquals($expected, $actual, $delta = 0.0, $canonicalize = false, $ignoreCase = false)
    {
        $expectedDate = new DateTimeImmutable($expected);
        $actualDate   = new DateTimeImmutable($actual);

        $delta = $delta === 0.0 ? 5 : $delta;
        $delta = new DateInterval(sprintf('PT%sS', abs($delta)));

        if ($actualDate < $expectedDate->sub($delta) || $actualDate > $expectedDate->add($delta)) {
            throw new ComparisonFailure(
                $expectedDate,
                $actualDate,
                $this->dateTimeToString($expectedDate),
                $this->dateTimeToString($actualDate),
                false,
                'Failed asserting that two DateTime strings are equal.'
            );
        }
    }

    protected function dateTimeToString(DateTimeInterface $datetime)
    {
        $string = $datetime->format(DateTime::ISO8601);

        return $string ? $string : 'Invalid DateTime object';
    }

    private function isValidDateTimeString($expected)
    {
        $isValid = true;

        try {
            new DateTimeImmutable($expected);
        } catch (Exception $exception) {
            $isValid = false;
        }

        return $isValid;
    }
}
