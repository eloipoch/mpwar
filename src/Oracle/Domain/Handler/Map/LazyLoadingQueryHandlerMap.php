<?php

namespace Oracle\Domain\Handler\Map;

use Assert\Assertion;
use Oracle\Domain\Handler\Map\Exception\NoHandlerForQueryName;
use Oracle\Domain\Handler\QueryHandler;

class LazyLoadingQueryHandlerMap implements QueryHandlerMap
{
    private $queryHandlerServiceIds;
    private $serviceLocator;

    public function __construct(array $queryHandlerServiceIds, callable $serviceLocator)
    {
        $this->queryHandlerServiceIds = $queryHandlerServiceIds;
        $this->serviceLocator         = $serviceLocator;
    }

    public function handlerByQueryName($queryName)
    {
        if (!isset($this->queryHandlerServiceIds[$queryName])) {
            throw new NoHandlerForQueryName($queryName);
        }

        return $this->loadHandlerService($this->queryHandlerServiceIds[$queryName]);
    }

    private function loadHandlerService($handlerServiceId)
    {
        $queryHandler = call_user_func($this->serviceLocator, $handlerServiceId);

        Assertion::isInstanceOf($queryHandler, QueryHandler::class);

        return $queryHandler;
    }
}
