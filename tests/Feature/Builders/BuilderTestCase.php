<?php

namespace Sfneal\Users\Tests\Feature\Builders;

use Sfneal\Models\Model;
use Sfneal\Users\Models\Role;
use Sfneal\Users\Models\User;
use Sfneal\Users\Tests\TestCase;

class BuilderTestCase extends TestCase
{
    /**
     * @var Model
     */
    protected $modelClass;

    /**
     * @var int
     */
    protected $count = 200;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        if (isset($this->modelClass)) {
            $factory = $this->modelClass::factory()->count($this->count);

            // Add related models for User models
            if ($this->modelClass == User::class) {
                Role::factory()
                    ->count(10)
                    ->create();
            }

            $factory->create();
        }
    }
}
