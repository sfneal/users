<?php

namespace Sfneal\Users\Tests\Feature\Queries;

use Sfneal\Queries\RandomModelAttributeQuery;
use Sfneal\Testing\Utils\Traits\CreateRequest;
use Sfneal\Users\Models\User;
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
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
