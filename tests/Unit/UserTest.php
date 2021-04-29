<?php

namespace Sfneal\Users\Tests\Unit;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Collection;
use Sfneal\Address\Models\Address;
use Sfneal\Queries\RandomModelAttributeQuery;
use Sfneal\Testing\Utils\Interfaces\CrudModelTest;
use Sfneal\Testing\Utils\Interfaces\ModelBuilderTest;
use Sfneal\Testing\Utils\Interfaces\ModelFactoryTest;
use Sfneal\Testing\Utils\Interfaces\ModelRelationshipsTest;
use Sfneal\Users\Builders\UserBuilder;
use Sfneal\Users\Models\Role;
use Sfneal\Users\Models\Team;
use Sfneal\Users\Models\User;
use Sfneal\Users\Models\UserNotification;
use Sfneal\Users\Tests\TestCase;

class UserTest extends TestCase implements CrudModelTest, ModelBuilderTest, ModelFactoryTest, ModelRelationshipsTest
{
    /** @test */
    public function records_can_be_created()
    {
        $role_id = (new RandomModelAttributeQuery(Role::class, 'role_id'))->execute();
        $role = Role::query()->find($role_id);

        $user = User::factory()
            ->for($role)
            ->create();

        $this->assertNotNull($user);
        $this->assertInstanceOf(User::class, $user);
        $this->assertNotNull($user->role);
        $this->assertInstanceOf(Role::class, $user->role);
    }

    /** @test */
    public function records_can_be_updated()
    {
        $user_id = (new RandomModelAttributeQuery(User::class, 'id'))->execute();
        $user = User::query()->find($user_id);

        $role_id = 3;
        $names = [
            'first' => 'Louis',
            'middle' => 'J',
            'last' => 'Gomez',
        ];
        $user->update([
            'role_id' => $role_id,
            'first_name' => $names['first'],
            'middle_name' => $names['middle'],
            'last_name' => $names['last'],
            'nickname' => null,
            'nickname_preferred' => 0,
        ]);

        $updatedUser = User::query()->find($user_id);

        $this->assertNotNull($updatedUser);
        $this->assertInstanceOf(User::class, $updatedUser);
        $this->assertSame($user->getKey(), $updatedUser->getKey());
        $this->assertEquals($user->created_at, $updatedUser->created_at);
        $this->assertEquals($user->updated_at, $updatedUser->updated_at);
        $this->assertSame($names['first'], $updatedUser->first_name);
        $this->assertSame($names['middle'].'.', $updatedUser->middle_name);
        $this->assertSame($names['last'], $updatedUser->last_name);
        $this->assertSame('Louis J. Gomez', $updatedUser->name_full);
        $this->assertSame('LJG', $updatedUser->initials);

        $this->assertTrue($updatedUser->isRoleId($role_id));
        $this->assertTrue($updatedUser->isRole('Administrator'));
        $this->assertTrue($updatedUser->isAdmin());
        $this->assertFalse($updatedUser->isWebDeveloper());
        $this->assertFalse($updatedUser->isEmployee());
        $this->assertFalse($updatedUser->isContractor());
        $this->assertTrue($updatedUser->isActive());
        $this->assertFalse($updatedUser->isNicknamePreferred());
    }

    /** @test */
    public function records_can_be_deleted()
    {
        $user_id = (new RandomModelAttributeQuery(User::class, 'id'))->execute();
        $user = User::query()->find($user_id);

        $user->delete();

        $this->assertInstanceOf(User::class, $user);
        $this->assertTrue($user->wasDeleted());
        $this->assertNull(User::query()->find($user_id));
    }

    /** @test */
    public function builder_is_accessible()
    {
        $builder = User::query();

        $this->assertInstanceOf(UserBuilder::class, $builder);
        $this->assertIsString($builder->toSql());
    }

    /** @test */
    public function factory_is_accessible()
    {
        $factory = User::factory();

        $this->assertInstanceOf(UserFactory::class, $factory);
    }

    /** @test */
    public function relationships_are_accessible()
    {
        $user = User::query()
            ->whereHas('team')
            ->first();

        $this->assertInstanceOf(Role::class, $user->role);
        $this->assertInstanceOf(Team::class, $user->team);
        $this->assertInstanceOf(Address::class, $user->address);
        $this->assertInstanceOf(Collection::class, $user->notificationSubscriptions);
        $user->notificationSubscriptions->each(function ($notification) {
            $this->assertInstanceOf(UserNotification::class, $notification);
        });
    }
}
