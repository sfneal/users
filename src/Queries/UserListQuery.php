<?php

namespace Sfneal\Users\Queries;

use Sfneal\Queries\Query;
use Sfneal\Users\Builders\UserBuilder;
use Sfneal\Users\Models\User;

class UserListQuery extends Query
{
    /**
     * @var string Query string containing portions of a User's name
     */
    private $nameQuery;

    /**
     * TeamListQuery constructor.
     *
     * @param  string  $nameQuery
     */
    public function __construct(string $nameQuery)
    {
        $this->nameQuery = $nameQuery;
    }

    /**
     * Retrieve a Query builder.
     *
     * @return UserBuilder
     */
    protected function builder(): UserBuilder
    {
        return User::query();
    }

    /**
     * Execute a Team ajax search.
     *
     * @return array
     */
    public function execute(): array
    {
        return $this->builder()
            ->whereNameLike($this->nameQuery)
            ->whereActive()
            ->selectRawJson()
            ->countAndPaginate();
    }
}
