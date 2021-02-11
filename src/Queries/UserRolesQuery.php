<?php

namespace Sfneal\Users\Queries;

use Illuminate\Database\Eloquent\Collection;
use Sfneal\Caching\Traits\Cacheable;
use Sfneal\Queries\Query;
use Sfneal\Users\Models\Role;

class UserRolesQuery implements Query
{
    use Cacheable;

    /**
     * Execute the Query.
     *
     * @return Collection
     */
    public function execute()
    {
        return Role::query()->whereTypeUser()->get();
    }

    /**
     * Retrieve the Query cache key.
     *
     * @return string
     */
    public function cacheKey(): string
    {
        return Role::getTableName().':types#user';
    }
}
