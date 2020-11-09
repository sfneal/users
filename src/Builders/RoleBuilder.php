<?php

namespace Sfneal\Users\Builders;

use Sfneal\Builders\QueryBuilder;

class RoleBuilder extends QueryBuilder
{
    /**
     * Scope Role query to roles of a particular type.
     *
     * @param string $type
     * @param string $operator
     * @param string $boolean
     *
     * @return $this
     */
    public function whereType(string $type, string $operator = '=', string $boolean = 'and')
    {
        $this->where('type', $operator, $type, $boolean);

        return $this;
    }

    /**
     * Scope Role query to only 'user' type roles.
     *
     * @param string $operator
     * @param string $boolean
     *
     * @return $this
     */
    public function whereTypeUser(string $operator = '=', string $boolean = 'and')
    {
        $this->whereType('user', $operator, $boolean);

        return $this;
    }
}
