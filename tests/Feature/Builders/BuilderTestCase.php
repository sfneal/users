<?php


namespace Sfneal\Users\Tests\Feature\Builders;


use Sfneal\Models\Model;
use Sfneal\Users\Tests\TestCase;

class BuilderTestCase extends TestCase
{
    /**
     * @var Model
     */
    protected $modelClass = Model::class;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->modelClass::factory()
            ->count(200)
            ->create();
    }
}
