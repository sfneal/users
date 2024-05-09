<?php

namespace Sfneal\Users\Tests\Unit;

use Sfneal\Queries\RandomModelAttributeQuery;
use Sfneal\Testing\Utils\Interfaces\CrudModelTest;
use Sfneal\Testing\Utils\Interfaces\ModelBuilderTest;
use Sfneal\Testing\Utils\Interfaces\ModelFactoryTest;
use Sfneal\Testing\Utils\Interfaces\ModelRelationshipsTest;
use Sfneal\Users\Builders\UserNotificationBuilder;
use Sfneal\Users\Factories\UserNotificationFactory;
use Sfneal\Users\Models\User;
use Sfneal\Users\Models\UserNotification;
use Sfneal\Users\Tests\TestCase;

class UserNotificationTest extends TestCase implements CrudModelTest, ModelBuilderTest, ModelFactoryTest, ModelRelationshipsTest
{
    /** @test */
    public function records_can_be_created()
    {
        $user_id = (new RandomModelAttributeQuery(User::class, 'id'))->execute();
        $user = User::query()->find($user_id);

        $notification = UserNotification::factory()
            ->for($user)
            ->create();

        $this->assertNotNull($notification);
        $this->assertInstanceOf(UserNotification::class, $notification);
        $this->assertNotNull($notification->user);
        $this->assertInstanceOf(User::class, $notification->user);
    }

    /** @test */
    public function records_can_be_updated()
    {
        $notification = UserNotification::query()
            ->whereType('Domain\Clients\Notifications\NewInquiryNotification')
            ->first();

        $type = 'Domain\Plans\Notifications\BucketChangedNotification';
        $notification->update([
            'type' => $type,
        ]);

        $updated = UserNotification::query()->find($notification->getKey());

        $this->assertInstanceOf(UserNotification::class, $updated);
        $this->assertInstanceOf(User::class, $updated->user);
        $this->assertSame($notification->getKey(), $updated->getKey());
        $this->assertEquals($notification->created_at, $updated->created_at);
        $this->assertEquals($notification->updated_at, $updated->updated_at);
        $this->assertSame($type, $updated->type);
    }

    /** @test */
    public function records_can_be_deleted()
    {
        $notification_id = (new RandomModelAttributeQuery(UserNotification::class, 'user_notification_id'))->execute();
        $notification = UserNotification::query()->find($notification_id);

        $notification->delete();

        $this->assertInstanceOf(UserNotification::class, $notification);
        $this->assertTrue($notification->wasDeleted());
        $this->assertNull(UserNotification::query()->find($notification_id));
    }

    /** @test */
    public function builder_is_accessible()
    {
        $builder = UserNotification::query();

        $this->assertInstanceOf(UserNotificationBuilder::class, $builder);
        $this->assertIsString($builder->toSql());
    }

    /** @test */
    public function factory_is_accessible()
    {
        $factory = UserNotification::factory();

        $this->assertInstanceOf(UserNotificationFactory::class, $factory);
    }

    /** @test */
    public function relationships_are_accessible()
    {
        $notification_id = (new RandomModelAttributeQuery(UserNotification::class, 'user_notification_id'))->execute();
        $notification = UserNotification::query()->find($notification_id);

        $this->assertInstanceOf(User::class, $notification->user);
    }
}
