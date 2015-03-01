<?php

namespace Oracle\Domain\Handler\Resolver;

use Oracle\Domain\Handler\QueryHandler;
use Oracle\Domain\Query;

interface QueryHandlerResolver
{
    /**
     * Resolve the QueryHandler for the given Query.
     *
     * @param Query $query
     *
     * @return QueryHandler
     */
    public function resolve(Query $query);
}
