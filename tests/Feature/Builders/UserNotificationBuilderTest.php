<?php

namespace Sfneal\Users\Tests\Feature\Builders;

use Sfneal\Queries\RandomModelAttributeQuery;
use Sfneal\Users\Models\UserNotification;

class UserNotificationBuilderTest extends BuilderTestCase
{
    /**
     * @var UserNotification
     */
    protected $modelClass = UserNotification::class;

    /**
     * @test
     * @dataProvider runTestFiveTimesProvider
     */
    public function whereType()
    {
        $attribute = 'type';
        $value = (new RandomModelAttributeQuery($this->modelClass, $attribute))->execute();
        $model = $this->modelClass::query()->whereType($value)->get();

        $this->assertContains($value, $model->pluck($attribute));
    }
}
