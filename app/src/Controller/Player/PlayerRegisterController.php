<?php

namespace MPWAR\Api\Controller\Player;

use Symfony\Component\HttpFoundation\Response;

final class PlayerRegisterController
{
    public function __invoke()
    {
        return Response::create(null, Response::HTTP_CREATED);
    }
}
