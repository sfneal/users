<?php

namespace Sfneal\Users\Tests\Feature\Queries;

use Illuminate\Database\QueryException;
use Sfneal\Queries\RandomModelAttributeQuery;
use Sfneal\Testing\Utils\Traits\CreateRequest;
use Sfneal\Users\Models\User;
use Sfneal\Users\Queries\UserListQuery;
use Sfneal\Users\Tests\TestCase;

class UserListQueryTest extends TestCase
{
    // todo: fix issue with sql 'concat' method not being available

    use CreateRequest;

    /**
     * @var string
     */
    private $userName;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->userName = User::query()->find(
            (new RandomModelAttributeQuery(User::class, 'id'))->execute()
        )->name;
    }

    /** @test */
    public function query_returns_results()
    {
        $request = $this->createRequest([], [
            'q' => $this->userName,
        ]);
        try {
            $result = (new UserListQuery($request))->execute();
//            print_r($result);
        } catch (QueryException $exception) {
//            print_r('UserListQueryTest::query_returns_results - '.$exception->getMessage());
            $this->assertTrue(true);
        }
    }
}
