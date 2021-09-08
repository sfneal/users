<?php

namespace Sfneal\Users\Builders;

use Sfneal\Builders\QueryBuilder;

class RoleBuilder extends QueryBuilder
{
    /**
     * Scope Role query to roles of a particular type.
     *
     * @param  string  $type
     * @param  string  $operator
     * @param  string  $boolean
     *
     * @return $this
     */
    public function whereType(string $type, string $operator = '=', string $boolean = 'and'): self
    {
        $this->where('type', $operator, $type, $boolean);

        return $this;
    }

    /**
     * Scope Role query to only 'user' type roles.
     *
     * @param  string  $operator
     * @param  string  $boolean
     *
     * @return $this
     */
    public function whereTypeUser(string $operator = '=', string $boolean = 'and'): self
    {
        $this->whereType('user', $operator, $boolean);

        return $this;
    }

    /**
     * Scope query results to Role's matching a role 'name'.
     *
     * @param  string  $name
     * @param  string  $operator
     * @param  string  $boolean
     * @return $this
     */
    public function whereName(string $name, string $operator = '=', string $boolean = 'and'): self
    {
        $this->where('name', $operator, ucwords($name), $boolean);

        return $this;
    }

    /**
     * Scope query results to Role's that do NOT have a particular role 'name'.
     *
     * @param  string  $name
     * @param  string  $boolean
     * @return $this
     */
    public function whereNameNot(string $name, string $boolean = 'and'): self
    {
        $this->whereName($name, '!=', $boolean);

        return $this;
    }

    /**
     * Scope query results to Role's with names that are in the array of $names.
     *
     * @param  array  $names
     * @param  string  $boolean
     * @param  bool  $not
     * @return $this
     */
    public function whereNameIn(array $names, string $boolean = 'and', bool $not = false): self
    {
        $this->whereIn('name', $names, $boolean, $not);

        return $this;
    }

    /**
     * Scope query results to Role's with names that are NOT in the array of $names.
     *
     * @param  array  $names
     * @param  string  $boolean
     * @return $this
     */
    public function whereNameNotIn(array $names, string $boolean = 'and'): self
    {
        $this->whereIn('name', $names, $boolean, true);

        return $this;
    }
}
