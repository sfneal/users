<?php

namespace Sfneal\Users\Tests\Feature\Builders;

use Sfneal\Queries\RandomModelAttributeQuery;
use Sfneal\Users\Models\User;

class UserBuilderTest extends BuilderTestCase
{
    /**
     * @var int
     */
    protected $count = 50;

    /**
     * @var User
     */
    protected $modelClass = User::class;

    /** @test */
    public function whereUser()
    {
        $attribute = 'id';
        $value = (new RandomModelAttributeQuery($this->modelClass, $attribute))->execute();
        $model = $this->modelClass::query()->whereUser($value)->get();

        $this->assertContains($value, $model->pluck($attribute));
    }

    /** @test */
    public function whereUserNot()
    {
        $attribute = 'id';
        $value = (new RandomModelAttributeQuery($this->modelClass, $attribute))->execute();
        $model = $this->modelClass::query()->whereUserNot($value)->get();

        $this->assertNotContains($value, $model->pluck($attribute));
    }

    /** @test */
    public function whereUserIn()
    {
        $attribute = 'id';
        $values = (new RandomModelAttributeQuery($this->modelClass, $attribute, 5))->execute();
        $models = $this->modelClass::query()->whereUserIn($values)->get();

        collect($values)->each(function (int $value) use ($models, $attribute) {
            $this->assertContains($value, $models->pluck($attribute));
        });
    }

    /** @test */
    public function whereUserNotIn()
    {
        $attribute = 'id';
        $values = (new RandomModelAttributeQuery($this->modelClass, $attribute, 5))->execute();
        $models = $this->modelClass::query()->whereUserNotIn($values)->get();

        collect($values)->each(function (int $value) use ($models, $attribute) {
            $this->assertNotContains($value, $models->pluck($attribute));
        });
    }

    /** @test */
    public function whereUsername()
    {
        $attribute = 'username';
        $value = (new RandomModelAttributeQuery($this->modelClass, $attribute))->execute();
        $model = $this->modelClass::query()->whereUsername($value)->get();

        $this->assertContains($value, $model->pluck($attribute));
    }

    /** @test */
    public function whereActive()
    {
        $attribute = 'status';
        $value = (new RandomModelAttributeQuery($this->modelClass, $attribute))->execute();
        $model = $this->modelClass::query()->whereActive($value)->get();

        $this->assertContains($value, $model->pluck($attribute));
    }

    /** @test */
    public function whereRole()
    {
        $attribute = 'role_id';
        $value = (new RandomModelAttributeQuery($this->modelClass, $attribute))->execute();
        $model = $this->modelClass::query()->whereRole($value)->get();

        $this->assertContains($value, $model->pluck($attribute));
    }

    /** @test */
    public function whereRoleNot()
    {
        $attribute = 'role_id';
        $value = (new RandomModelAttributeQuery($this->modelClass, $attribute))->execute();
        $model = $this->modelClass::query()->whereRoleNot($value)->get();

        $this->assertNotContains($value, $model->pluck($attribute));
    }

    /** @test */
    public function whereRoleIn()
    {
        $attribute = 'role_id';
        $values = (new RandomModelAttributeQuery($this->modelClass, $attribute, 5))->execute();
        $models = $this->modelClass::query()->whereRoleIn($values)->get();

        collect($values)->each(function (int $value) use ($models, $attribute) {
            $this->assertContains($value, $models->pluck($attribute));
        });
    }

    /** @test */
    public function whereRoleNotIn()
    {
        $attribute = 'role_id';
        $values = (new RandomModelAttributeQuery($this->modelClass, $attribute, 5))->execute();
        $models = $this->modelClass::query()->whereRoleNotIn($values)->get();

        collect($values)->each(function (int $value) use ($models, $attribute) {
            $this->assertNotContains($value, $models->pluck($attribute));
        });
    }

    /** @test */
    public function orWhereRole()
    {
        $attribute = 'role_id';
        $values = (new RandomModelAttributeQuery($this->modelClass, $attribute, 2))->execute();
        $query = $this->modelClass::query();
        foreach ($values as $value) {
            $query->orWhereRole($value);
        }
        $models = $query->get();

        collect($values)->each(function (int $value) use ($models, $attribute) {
            $this->assertContains($value, $models->pluck($attribute));
        });
    }
}
