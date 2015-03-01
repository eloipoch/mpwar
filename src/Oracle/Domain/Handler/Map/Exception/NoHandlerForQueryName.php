<?php

namespace Oracle\Domain\Handler\Map\Exception;

use LogicException;

class NoHandlerForQueryName extends LogicException
{
    public function __construct($queryName)
    {
        parent::__construct(
            sprintf('There is no query handler for query "%s"', $queryName)
        );
    }
}
