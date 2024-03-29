<?php

namespace Sfneal\Users\Queries;

use Illuminate\Database\Eloquent\Collection;
use Sfneal\Caching\Traits\Cacheable;
use Sfneal\Queries\Query;
use Sfneal\Users\Builders\RoleBuilder;
use Sfneal\Users\Models\Role;

class UserRolesQuery extends Query
{
    use Cacheable;

    /**
     * Retrieve a Query builder.
     *
     * @return RoleBuilder
     */
    protected function builder(): RoleBuilder
    {
        return Role::query();
    }

    /**
     * Execute the Query.
     *
     * @return Collection
     */
    public function execute(): Collection
    {
        return $this->builder()->whereTypeUser()->get();
    }

    /**
     * Retrieve the Query cache key.
     *
     * @return string
     */
    public function cacheKey(): string
    {
        return Role::getTableName().':types:user';
    }
}
