<?php

namespace Oracle\Domain;

use Oracle\Domain\Handler\Resolver\QueryHandlerResolver;
use SimpleBus\Message\Bus;

class OracleSimple implements Oracle
{
    private $queryHandlerResolver;

    public function __construct(QueryHandlerResolver $queryHandlerResolver)
    {
        $this->queryHandlerResolver = $queryHandlerResolver;
    }

    public function ask(Query $query)
    {
        return $this->queryHandlerResolver->resolve($query)->handle($query);
    }
}
