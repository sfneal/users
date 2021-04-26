<?php

namespace Sfneal\Users\Tests\Feature\Builders;

use Sfneal\Models\Model;
use Sfneal\Users\Tests\TestCase;

class BuilderTestCase extends TestCase
{
    /**
     * @var Model
     */
    protected $modelClass;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        if (isset($this->modelClass)) {
            $this->modelClass::factory()
                ->count(200)
                ->create();
        }
    }
}
