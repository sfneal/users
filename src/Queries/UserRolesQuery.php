<?php

namespace Sfneal\Users\Queries;

use Sfneal\Users\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Sfneal\Caching\Traits\Cacheable;
use Sfneal\Queries\AbstractQuery;

class UserRolesQuery extends AbstractQuery
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
