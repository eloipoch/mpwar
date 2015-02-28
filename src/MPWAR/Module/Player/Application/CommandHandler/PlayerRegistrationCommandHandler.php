<?php

namespace MPWAR\Module\Player\Application\CommandHandler;

use MPWAR\Module\Player\Application\Service\PlayerRegistrar;
use MPWAR\Module\Player\Contract\Command\PlayerRegistration;
use MPWAR\Module\Player\Contract\Exception\PlayerIdNotValidException;
use MPWAR\Module\Player\Contract\Exception\PlayerNameNotValidException;
use MPWAR\Module\Player\Domain\PlayerId;
use MPWAR\Module\Player\Domain\PlayerName;
use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;

final class PlayerRegistrationCommandHandler implements MessageHandler
{
    private $registrar;

    public function __construct(PlayerRegistrar $registrar)
    {
        $this->registrar = $registrar;
    }

    /**
     * Handles the given message.
     *
     * @param PlayerRegistration|Message $message
     *
     * @throws PlayerIdNotValidException
     * @throws PlayerNameNotValidException
     *
     * @return void
     */
    public function handle(Message $message)
    {
        $id   = new PlayerId($message->id());
        $name = new PlayerName($message->name());

        $this->registrar->__invoke($id, $name);
    }
}
