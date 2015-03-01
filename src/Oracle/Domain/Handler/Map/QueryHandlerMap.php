<?php

namespace Oracle\Domain\Handler\Map;

use Oracle\Domain\Handler\Map\Exception\NoHandlerForQueryName;
use Oracle\Domain\Handler\QueryHandler;

interface QueryHandlerMap
{
    /**
     * @param string $queryName
     *
     * @throws NoHandlerForQueryName
     *
     * @return QueryHandler
     */
    public function handlerByQueryName($queryName);
}
