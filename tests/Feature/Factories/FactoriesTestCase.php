<?php


namespace Sfneal\Users\Tests\Feature\Factories;


use Sfneal\Models\Model;
use Sfneal\Users\Tests\TestCase;

class FactoriesTestCase extends TestCase
{
    /**
     * @var Model
     */
    public $modelClass = Model::class;

    /**
     * @var Model
     */
    public $model;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // Create models from the factory
        $this->model = $this->modelClass::factory()->create();
    }
}
