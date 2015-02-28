<?php

namespace MPWAR\Module\Player\Application\CommandHandler;

use MPWAR\Module\Player\Contract\Command\PlayerRegistration;
use MPWAR\Module\Player\Domain\PlayerId;
use MPWAR\Module\Player\Domain\PlayerName;
use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;

final class PlayerRegistrationCommandHandler implements MessageHandler
{
    /**
     * Handles the given message.
     *
     * @param PlayerRegistration|Message $message
     *
     * @return void
     */
    public function handle(Message $message)
    {
        $id   = new PlayerId($message->id());
        $name = new PlayerName($message->name());
    }
}
