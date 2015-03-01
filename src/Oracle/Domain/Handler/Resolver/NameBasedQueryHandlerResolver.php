<?php

namespace Oracle\Domain\Handler\Resolver;

use Oracle\Domain\Handler\Map\QueryHandlerMap;
use Oracle\Domain\Name\QueryNameResolver;
use Oracle\Domain\Query;

class NameBasedQueryHandlerResolver implements QueryHandlerResolver
{
    private $queryNameResolver;
    private $queryHandlers;

    public function __construct(QueryNameResolver $queryNameResolver, QueryHandlerMap $queryHandlers)
    {
        $this->queryNameResolver = $queryNameResolver;
        $this->queryHandlers     = $queryHandlers;
    }

    public function resolve(Query $query)
    {
        $name = $this->queryNameResolver->resolve($query);

        return $this->queryHandlers->handlerByQueryName($name);
    }
}
