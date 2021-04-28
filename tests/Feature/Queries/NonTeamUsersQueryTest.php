<?php

namespace Sfneal\Users\Tests\Feature\Queries;

use Illuminate\Database\Eloquent\Collection;
use Sfneal\Users\Models\User;
use Sfneal\Users\Queries\NonTeamUsersQuery;
use Sfneal\Users\Tests\TestCase;

class NonTeamUsersQueryTest extends TestCase
{
    /** @test */
    public function query_returns_non_team_users()
    {
        $expected = User::query()
            ->withInactive()
            ->doesntHave('team')
            ->orderBy('last_name', 'asc')
            ->orderBy('first_name', 'asc')
            ->get();

        $result = (new NonTeamUsersQuery())->execute();

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals($expected->count(), $result->count());
        $this->assertEquals($expected->pluck('id'), $result->pluck('id'));
        $this->assertEquals($expected, $result);
        $result->each(function (User $user) {
            $this->assertNull($user->team);
        });
    }
}
