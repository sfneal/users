<?php

namespace Sfneal\Users\Tests\Feature\Factories;

use Sfneal\Testing\Utils\Interfaces\Factory\FillablesTest;
use Sfneal\Users\Models\Role;
use Sfneal\Users\Models\User;

class UserFactoryTest extends FactoriesTestCase implements FillablesTest
{
    /**
     * @var User
     */
    public $modelClass = User::class;

    /**
     * @test
     * @dataProvider runTestFiveTimesProvider
     */
    public function fillables_are_correct_types()
    {
        $this->assertIsInt($this->model->role_id);
        $role = Role::query()->find($this->model->role_id);
        $this->assertInstanceOf(Role::class, $role);

        $this->assertIsString($this->model->first_name);
        $this->assertIsString($this->model->last_name);
        $this->assertIsString($this->model->nickname);
        $this->assertIsInt($this->model->nickname_preferred);
        $this->assertIsString($this->model->title);

        $this->assertIsString($this->model->email);
        $this->assertStringContainsString('@', $this->model->email);

        $this->assertIsInt($this->model->rate);
        $this->assertIsString($this->model->phone_work);
        $this->assertIsString($this->model->phone_mobile);
        $this->assertIsString($this->model->fax);
        $this->assertIsString($this->model->website);
        $this->assertIsString($this->model->bio);
        $this->assertIsString($this->model->username);
        $this->assertIsString($this->model->password);
        $this->assertIsInt($this->model->status);
    }
}
