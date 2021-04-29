<?php

namespace Sfneal\Users\Tests\Feature\Builders;

use Sfneal\Queries\RandomModelAttributeQuery;
use Sfneal\Users\Models\Role;

class RoleBuilderTest extends BuilderTestCase
{
    /**
     * @var Role
     */
    protected $modelClass = Role::class;

    /** @test */
    public function whereType()
    {
        $attribute = 'type';
        $value = (new RandomModelAttributeQuery($this->modelClass, $attribute))->execute();
        $model = $this->modelClass::query()->whereType($value)->get();

        $this->assertContains($value, $model->pluck($attribute));
    }

    /** @test */
    public function whereTypeUser()
    {
        $attribute = 'type';
        $value = 'user';
        $model = $this->modelClass::query()->whereTypeUser()->get();

        $this->assertContains($value, $model->pluck($attribute));
    }

    /** @test */
    public function whereName()
    {
        $attribute = 'name';
        $value = (new RandomModelAttributeQuery($this->modelClass, $attribute))->execute();
        $model = $this->modelClass::query()->whereName($value)->get();

        $this->assertContains($value, $model->pluck($attribute));
    }

    /** @test */
    public function whereNameNot()
    {
        $attribute = 'name';
        $value = (new RandomModelAttributeQuery($this->modelClass, $attribute))->execute();
        $model = $this->modelClass::query()->whereNameNot($value)->get();

        $this->assertNotContains($value, $model->pluck($attribute));
    }

    /** @test */
    public function whereNameIn()
    {
        $attribute = 'name';
        $values = (new RandomModelAttributeQuery($this->modelClass, $attribute, 2))->execute();
        $model = $this->modelClass::query()->whereNameIn($values)->get();

        collect($values)->each(function (string $value) use ($model, $attribute) {
            $this->assertContains($value, $model->pluck($attribute));
        });
    }

    /** @test */
    public function whereNameNotIn()
    {
        $attribute = 'name';
        $values = (new RandomModelAttributeQuery($this->modelClass, $attribute, 2))->execute();
        $model = $this->modelClass::query()->whereNameNotIn($values)->get();

        collect($values)->each(function (string $value) use ($model, $attribute) {
            $this->assertNotContains($value, $model->pluck($attribute));
        });
    }
}
