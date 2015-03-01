<?php

namespace MPWAR\Api\Controller\Player;

use FOS\RestBundle\View\View;
use MPWAR\Module\Player\Contract\Exception\PlayerIdNotValidException;
use MPWAR\Module\Player\Contract\Exception\PlayerNotExistsException;
use MPWAR\Module\Player\Contract\Query\PlayerFind;
use Oracle\Domain\Oracle;
use Symfony\Component\HttpFoundation\Response;

final class PlayerGetController
{
    private $oracle;

    public function __construct(Oracle $oracle)
    {
        $this->oracle = $oracle;
    }

    public function __invoke($playerId)
    {
        $query = new PlayerFind($playerId);

        try {
            $response = $this->oracle->ask($query);
        } catch (PlayerIdNotValidException $exception) {
            $response = View::create(
                [
                    'code'    => $exception->getCode(),
                    'message' => $exception->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        } catch (PlayerNotExistsException $exception) {
            $response = View::create(null, Response::HTTP_NOT_FOUND);
        }

        return $response;
    }
}
