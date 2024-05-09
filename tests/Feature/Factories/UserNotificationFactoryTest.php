<?php

namespace Sfneal\Users\Tests\Feature\Factories;

use Sfneal\Testing\Utils\Interfaces\Factory\FillablesTest;
use Sfneal\Users\Factories\UserNotificationFactory;
use Sfneal\Users\Models\User;
use Sfneal\Users\Models\UserNotification;

class UserNotificationFactoryTest extends FactoriesTestCase implements FillablesTest
{
    /**
     * @var UserNotification
     */
    public $modelClass = UserNotification::class;

    /**
     * @test
     *
     * @dataProvider runTestFiveTimesProvider
     */
    public function fillables_are_correct_types()
    {
        $this->assertIsInt($this->model->user_id);
        $user = User::query()->find($this->model->user_id);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($user, $this->model->user);

        $this->assertIsString($this->model->type);
        $this->assertContains($this->model->type, UserNotificationFactory::TYPES);
    }
}
