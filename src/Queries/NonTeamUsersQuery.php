<?php

namespace Sfneal\Users\Queries;

use Illuminate\Database\Eloquent\Collection;
use Sfneal\Queries\Query;
use Sfneal\Users\Builders\UserBuilder;
use Sfneal\Users\Models\User;

class NonTeamUsersQuery extends Query
{
    /**
     * Retrieve a Query builder.
     *
     * @return UserBuilder
     */
    protected function builder(): UserBuilder
    {
        return User::query()->withInactive();
    }

    /**
     * Retrieve a Collection of User's who are NOT team members.
     *
     * @return Collection
     */
    public function execute()
    {
        // todo: improve type hinting
        return $this->builder()
            ->doesntHave('team')
            ->orderBy('last_name', 'asc')
            ->orderBy('first_name', 'asc')
            ->get();
    }
}
