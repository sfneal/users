<?php

namespace Sfneal\Users\Tests\Unit;

use Sfneal\Models\AuthModel;
use Sfneal\Queries\RandomModelAttributeQuery;
use Sfneal\Users\Models\Role;
use Sfneal\Users\Models\User;
use Sfneal\Users\Tests\TestCase;

class HelpersTest extends TestCase
{
    /**
     * @var User
     */
    private $user;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::query()->find(
            (new RandomModelAttributeQuery(
                User::class,
                User::getPrimaryKeyName())
            )->execute()
        );

        $this->actingAs($this->user);
    }

    /** @test */
    public function activeUser()
    {
        $user = activeUser();

        $this->assertInstanceOf(User::class, $user);
        $this->assertInstanceOf(AuthModel::class, $user);
        $this->assertEquals($this->user, $user);
    }

    /** @test */
    public function activeUserID()
    {
        $user_id = activeUserID();

        $this->assertIsInt($user_id);
        $this->assertEquals($this->user->getKey(), $user_id);
    }

    /** @test */
    public function activeUserName()
    {
        $user_name = activeUserName();

        $this->assertIsString($user_name);
        $this->assertEquals($this->user->name, $user_name);
    }

    /** @test */
    public function activeUserRole()
    {
        $role = activeUserRole();

        $this->assertIsString($role);
        $this->assertEquals($this->user->role->name, $role);
        // todo: add test with $role param
    }

    /** @test */
    public function isAdminOrActiveUser()
    {
        // Active User
        $activeUser = isAdminOrActiveUser(activeUserID());
        $this->assertIsBool($activeUser);
        $this->assertTrue($activeUser);

        // Admin User
        $adminRoleId = Role::query()
            ->whereName('Administrator')
            ->pluck('role_id')
            ->first();
        $this->user->update([
            'role_id' => $adminRoleId,
        ]);
        $nonActiveUser = User::factory()->create([
            'role_id' => $adminRoleId,
        ]);

        $adminUser = isAdminOrActiveUser($this->user->getKey());
        $notActiveUser = isActiveUser($nonActiveUser->getKey());

        $this->assertIsBool($adminUser);
        $this->assertTrue($adminUser);
        $this->assertIsBool($notActiveUser);
        $this->assertFalse($notActiveUser);
    }

    /** @test */
    public function isActiveUser()
    {
        $activeUser = isActiveUser(activeUserID());

        $this->assertIsBool($activeUser);
        $this->assertTrue($activeUser);
    }
}
