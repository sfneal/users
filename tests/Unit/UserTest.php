<?php

namespace Sfneal\Users\Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Sfneal\Address\Models\Address;
use Sfneal\Queries\RandomModelAttributeQuery;
use Sfneal\Testing\Utils\Interfaces\CrudModelTest;
use Sfneal\Testing\Utils\Interfaces\ModelBuilderTest;
use Sfneal\Testing\Utils\Interfaces\ModelFactoryTest;
use Sfneal\Testing\Utils\Interfaces\ModelRelationshipsTest;
use Sfneal\Users\Builders\UserBuilder;
use Sfneal\Users\Factories\UserFactory;
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

    /** @test */
    public function accessors_are_accessible()
    {
        // todo: add provider
        $user_id = (new RandomModelAttributeQuery(User::class, 'id'))->execute();
        $user = User::query()->find($user_id);

        $attributes = [
            'first_name' => true,
            'last_name' => true,
            'name' => false,
            'name_full' => false,
            'name_suffix' => false,
            'list_name' => false,

            'city_state' => false,
            'address_1' => false,
            'address_2' => false,
            'city' => false,
            'state' => false,
            'zip' => false,

            'email_link' => false,
            'phone_work_link' => false,
            'phone_mobile_link' => false,
        ];

        foreach ($attributes as $attribute => $override) {
            $parts = array_map(function (string $piece) {
                return ucfirst($piece);
            }, explode('_', $attribute));
            array_unshift($parts, 'get');
            array_push($parts, 'Attribute');
            $method = implode('', $parts);

            $this->assertNotNull($user->{$attribute}, "The attribute '{$attribute}' returned null.");
            $this->assertIsString($user->{$attribute}, "The attribute '{$attribute}' is not a string.");

            if ($override) {
                $this->assertNotNull($user->{$method}($user->{$attribute}), "The $method '{$method}()' returned null.");
                $this->assertIsString($user->{$method}($user->{$attribute}), "The $method '{$method}()' is not a string.");
                $this->assertEquals($user->{$attribute}, $user->{$method}($user->{$attribute}), "The attribute '{$attribute}' & the method '{$method}()' returned different values");
            } else {
                $this->assertNotNull($user->{$method}(), "The $method '{$method}()' returned null.");
                $this->assertIsString($user->{$method}(), "The $method '{$method}()' is not a string.");
                $this->assertEquals($user->{$attribute}, $user->{$method}(), "The attribute '{$attribute}' & the method '{$method}()' returned different values");
            }
        }
    }

    /** @test */
    public function name_can_be_retrieved()
    {
        $user_id = (new RandomModelAttributeQuery(User::class, 'id'))->execute();

        /** @var User $user */
        $user = User::query()->find($user_id);

        $this->assertIsString($user->name);

        if ($user->isNicknamePreferred()) {
            $this->assertStringContainsString($user->nickname, $user->name);
        } else {
            $this->assertStringContainsString($user->first_name, $user->name);
        }
    }
}
