<?php

namespace Sfneal\Users\Queries;

use Illuminate\Database\Eloquent\Collection;
use Sfneal\Queries\Query;
use Sfneal\Users\Models\User;

class NonTeamUsersQuery implements Query
{
    /**
     * Retrieve a Collection of User's who are NOT team members.
     *
     * @return Collection
     */
    public function execute()
    {
        return User::query()
            ->withInactive()
            ->doesntHave('team')
            ->orderBy('last_name', 'asc')
            ->orderBy('first_name', 'asc')
            ->get();
    }
}
