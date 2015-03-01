<?php

namespace Oracle\Domain\Name;

use Oracle\Domain\Query;

class ClassBasedNameResolver implements QueryNameResolver
{
    public function resolve(Query $query)
    {
        return get_class($query);
    }
}
