<?php

namespace Sfneal\Users\Queries;

use Sfneal\Users\Models\User;
use Illuminate\Http\Request;
use Sfneal\Queries\AbstractQuery;

class UserListQuery extends AbstractQuery
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
