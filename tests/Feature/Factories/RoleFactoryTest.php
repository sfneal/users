<?php

namespace Sfneal\Users\Tests\Feature\Factories;

use Database\Factories\RoleFactory;
use Sfneal\Testing\Utils\Interfaces\Factory\FillablesTest;
use Sfneal\Users\Models\Role;

class RoleFactoryTest extends FactoriesTestCase implements FillablesTest
{
    /**
     * @var Role
     */
    public $modelClass = Role::class;

    /**
     * @test
     * @dataProvider runTestFiveTimesProvider
     */
    public function fillables_are_correct_types()
    {
        $this->assertIsString($this->model->type);
        $this->assertContains($this->model->type, RoleFactory::TYPES);
        $this->assertIsString($this->model->name);
        $this->assertContains($this->model->name, RoleFactory::NAMES);
        $this->assertIsString($this->model->description);
        $this->assertIsInt($this->model->order);
        $this->assertTrue(strlen((string) $this->model->order) <= 2);
    }
}
