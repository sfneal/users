<?php

namespace Sfneal\Users\Queries;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Sfneal\Queries\Query;
use Sfneal\Users\Builders\UserBuilder;
use Sfneal\Users\Models\User;

class UserListQuery extends Query
{
    /**
     * @var Request
     */
    private $request;

    /**
     * TeamListQuery constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
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
            ->whereNameLike($this->request->input('q'))
            ->whereActive()
            ->selectRawJson()
            ->countAndPaginate();
    }
}
