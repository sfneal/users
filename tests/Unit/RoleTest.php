<?php

namespace Sfneal\Users\Tests\Unit;

use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Collection;
use Sfneal\Queries\RandomModelAttributeQuery;
use Sfneal\Testing\Utils\Interfaces\CrudModelTest;
use Sfneal\Users\Builders\RoleBuilder;
use Sfneal\Users\Models\Role;
use Sfneal\Users\Models\User;
use Sfneal\Users\Tests\TestCase;

class RoleTest extends TestCase implements CrudModelTest
{
    /** @test */
    public function records_can_be_created()
    {
        $role = Role::factory()
            ->has(User::factory(), 'users')
            ->create();

        $this->assertNotNull($role);
        $this->assertInstanceOf(Role::class, $role);
        $this->assertInstanceOf(Collection::class, $role->users);
        $role->users->each(function ($user) {
            $this->assertInstanceOf(User::class, $user);
        });
    }

    /** @test */
    public function records_can_be_updated()
    {
        // Find a random Role
        $role_id = (new RandomModelAttributeQuery(Role::class, 'role_id'))->execute();
        $role = Role::query()->find($role_id);

        // Update the role
        $name = 'Director of Team Moral';
        $desc = 'Morale is not tangible thing';
        $role->update([
            'name' => $name,
            'description' => $desc
        ]);

        // Find the update Role
        $updatedRole = Role::query()->find($role_id);

        $this->assertInstanceOf(Role::class, $updatedRole);
        $this->assertInstanceOf(Collection::class, $updatedRole->users);
        $this->assertSame($role->getKey(), $updatedRole->getKey());
        $this->assertEquals($role->created_at, $updatedRole->created_at);
        $this->assertEquals($role->updated_at, $updatedRole->updated_at);
        $this->assertSame($name, $updatedRole->name);
        $this->assertSame($desc, $updatedRole->description);
    }

    /** @test */
    public function records_can_be_deleted()
    {
        // Find a random Role
        $role_id = (new RandomModelAttributeQuery(Role::class, 'role_id'))->execute();
        $role = Role::query()->find($role_id);

        // Delete the Role
        $role->delete();

        $this->assertInstanceOf(Role::class, $role);
        $this->assertTrue($role->wasDeleted());
        $this->assertNull(Role::query()->find($role_id));
    }

    /** @test */
    public function builder_is_accessible()
    {
        $builder = Role::query();

        $this->assertInstanceOf(RoleBuilder::class, $builder);
        $this->assertIsString($builder->toSql());
    }

    /** @test */
    public function factory_is_accessible()
    {
        $factory = Role::factory();

        $this->assertInstanceOf(RoleFactory::class, $factory);
    }

    /** @test */
    public function relationships_are_accessible()
    {
        $role_id = (new RandomModelAttributeQuery(Role::class, 'role_id'))->execute();
        $role = Role::query()->find($role_id);

        $this->assertInstanceOf(Collection::class, $role->users);
        $role->users->each(function ($user) {
            $this->assertInstanceOf(User::class, $user);
        });
    }
}
