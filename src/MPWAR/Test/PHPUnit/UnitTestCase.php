<?php

namespace MPWAR\Test\PHPUnit;

use Mockery as m;
use Mockery\MockInterface;
use PHPUnit_Framework_TestCase;
use SimpleBus\Message\Bus\MessageBus;
use SimpleBus\Message\Message;
use SimpleBus\Message\Recorder\RecordsMessages;
use PHPUnit_Framework_Assert as Assertions;

abstract class UnitTestCase extends PHPUnit_Framework_TestCase
{
    private $eventBus;

    protected function mock($className)
    {
        return m::mock($className);
    }

    /** @return MessageBus|MockInterface */
    protected function eventBus()
    {
        return $this->eventBus = $this->eventBus ?: $this->mock(MessageBus::class);
    }

    protected function assertEqualAggregatedRoot(RecordsMessages $expected)
    {
        return m::on(
            function (RecordsMessages $actual) use ($expected) {
                $actual = clone($actual);
                $actual->eraseMessages();

                return Assertions::equalTo($expected)->evaluate($actual, '', true);
            }
        );
    }

    protected function shouldHandleEvent(Message $event)
    {
        $this->eventBus()
            ->shouldReceive('handle')
            ->once()
            ->with(m::mustBe($event))
            ->andReturnNull();
    }
}
