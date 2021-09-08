<?php

namespace Sfneal\Users\Tests\Feature\Factories;

use Sfneal\Testing\Utils\Interfaces\Factory\FillablesTest;
use Sfneal\Users\Models\Team;

class TeamFactoryTest extends FactoriesTestCase implements FillablesTest
{
    /**
     * @var Team
     */
    public $modelClass = Team::class;

    /**
     * @test
     * @dataProvider runTestFiveTimesProvider
     */
    public function fillables_are_correct_types()
    {
        $this->assertIsInt($this->model->user_id);
        $this->assertTrue(strlen((string) $this->model->user_id) <= 3);
        $this->assertIsInt($this->model->order);
        $this->assertTrue(strlen((string) $this->model->order) <= 2);
    }
}
