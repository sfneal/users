<?php

namespace Sfneal\Users\Tests\Unit;

use Database\Factories\TeamFactory;
use Sfneal\Builders\QueryBuilder;
use Sfneal\Queries\RandomModelAttributeQuery;
use Sfneal\Testing\Utils\Interfaces\CrudModelTest;
use Sfneal\Testing\Utils\Interfaces\ModelBuilderTest;
use Sfneal\Testing\Utils\Interfaces\ModelFactoryTest;
use Sfneal\Testing\Utils\Interfaces\ModelRelationshipsTest;
use Sfneal\Users\Models\Team;
use Sfneal\Users\Models\User;
use Sfneal\Users\Tests\TestCase;

class TeamTest extends TestCase implements CrudModelTest, ModelBuilderTest, ModelFactoryTest, ModelRelationshipsTest
{
    /** @test */
    public function records_can_be_created()
    {
        $user = User::query()
            ->doesntHave('team')
            ->first();

        $team = Team::factory()
            ->for($user)
            ->create();

        $this->assertNotNull($team);
        $this->assertInstanceOf(Team::class, $team);
        $this->assertNotNull($team->user);
        $this->assertInstanceOf(User::class, $team->user);
    }

    /** @test */
    public function records_can_be_updated()
    {
        $team_id = (new RandomModelAttributeQuery(Team::class, 'team_id'))->execute();
        $team = Team::query()->find($team_id);

        $order = 10;
        $team->update([
            'order' => $order,
        ]);

        $updatedTeam = Team::query()->find($team_id);

        $this->assertNotNull($updatedTeam);
        $this->assertInstanceOf(Team::class, $updatedTeam);
        $this->assertSame($team->getKey(), $updatedTeam->getKey());
        $this->assertEquals($team->created_at, $updatedTeam->created_at);
        $this->assertEquals($team->updated_at, $updatedTeam->updated_at);
        $this->assertSame($order, $updatedTeam->order);
    }

    /** @test */
    public function records_can_be_deleted()
    {
        $team_id = (new RandomModelAttributeQuery(Team::class, 'team_id'))->execute();
        $team = Team::query()->find($team_id);

        $team->delete();

        $this->assertInstanceOf(Team::class, $team);
        $this->assertTrue($team->wasDeleted());
        $this->assertNull(Team::query()->find($team_id));
    }

    /** @test */
    public function builder_is_accessible()
    {
        $builder = Team::query();

        $this->assertInstanceOf(QueryBuilder::class, $builder);
        $this->assertIsString($builder->toSql());
    }

    /** @test */
    public function factory_is_accessible()
    {
        $factory = Team::factory();

        $this->assertInstanceOf(TeamFactory::class, $factory);
    }

    /** @test */
    public function relationships_are_accessible()
    {
        $team_id = (new RandomModelAttributeQuery(Team::class, 'team_id'))->execute();
        $team = Team::query()->find($team_id);

        $this->assertInstanceOf(User::class, $team->user);
    }
}
