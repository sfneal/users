<?php

namespace Sfneal\Users\Tests\Feature\Queries;

use Sfneal\Queries\RandomModelAttributeQuery;
use Sfneal\Users\Models\User;
use Sfneal\Users\Queries\UserListQuery;
use Sfneal\Users\Tests\TestCase;

class UserListQueryTest extends TestCase
{
    /**
     * @var string
     */
    private $userName;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->userName = User::query()->find(
            (new RandomModelAttributeQuery(User::class, 'id'))->execute()
        )->name;
    }

    /**
     * @test
     * @dataProvider runTestFiveTimesProvider
     */
    public function query_returns_results()
    {
        $result = (new UserListQuery($this->userName))->execute();
        $items = $result['items'];
        $count = $result['total_count'];

        $this->assertIsArray($result);
        $this->assertIsArray($items);
        $this->assertCount(1, $items);

        $this->assertIsInt($count);
        $this->assertEquals(1, $count);

        foreach ($items as $item) {
            $this->assertIsInt($item['id']);
            $this->assertIsString($item['text']);

            $this->assertEquals($this->userName, $item['text']);
        }
    }
}
