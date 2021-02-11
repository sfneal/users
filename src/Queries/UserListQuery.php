<?php

namespace Sfneal\Users\Queries;

use Illuminate\Http\Request;
use Sfneal\Queries\Query;
use Sfneal\Users\Models\User;

class UserListQuery implements Query
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
     * Execute a Team ajax search.
     *
     * @return array
     */
    public function execute(): array
    {
        return User::query()
            ->whereNameLike($this->request->input('q'))
            ->whereActive()
            ->selectRawJson()
            ->countAndPaginate();
    }
}
