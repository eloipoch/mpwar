<?php

namespace Oracle\Domain;

interface Oracle
{
    /**
     * @param Query $query
     *
     * @return Response
     */
    public function ask(Query $query);
}
