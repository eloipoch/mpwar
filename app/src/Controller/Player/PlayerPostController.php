<?php

namespace MPWAR\Api\Controller\Player;

use FOS\RestBundle\View\View;
use MPWAR\Module\Player\Contract\Command\PlayerRegistration;
use MPWAR\Module\Player\Contract\Exception\PlayerIdNotValidException;
use MPWAR\Module\Player\Contract\Exception\PlayerNameNotValidException;
use SimpleBus\Message\Bus\MessageBus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PlayerPostController
{
    private $commandBus;

    public function __construct(MessageBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request)
    {
        $id   = $request->request->get('id');
        $name = $request->request->get('name');

        $command  = new PlayerRegistration($id, $name);
        $response = View::create(null, Response::HTTP_CREATED);

        try {
            $this->commandBus->handle($command);
        } catch (PlayerIdNotValidException $exception) {
            $response = View::create(
                [
                    'code'    => $exception->getCode(),
                    'message' => $exception->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        } catch (PlayerNameNotValidException $exception) {
            $response = View::create(
                [
                    'code'    => $exception->getCode(),
                    'message' => $exception->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        return $response;
    }
}
