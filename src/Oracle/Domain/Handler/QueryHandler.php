<?php

namespace Oracle\Domain\Handler;

use Oracle\Domain\Query;
use Oracle\Domain\Response;

interface QueryHandler
{
    /**
     * Handles the given query.
     *
     * @param Query $query
     *
     * @return Response
     */
    public function handle(Query $query);
}
